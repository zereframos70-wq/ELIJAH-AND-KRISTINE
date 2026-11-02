<?php

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

function validProjectPayload(array $overrides = []): array
{
    return array_merge([
        'portfolio' => 'fabia',
        'title' => 'Student Project',
        'description' => 'A meaningful project description that is long enough.',
        'tech_stack' => ['Laravel', 'React'],
        'project_url' => 'https://example.com/project',
        'repository_url' => 'https://github.com/example/project',
        'completed_at' => '2025-01-15',
        'display_order' => 1,
    ], $overrides);
}

function projectManager(): User
{
    return User::factory()->create([
        'email' => config('portfolios.accounts.ramos.email'),
    ]);
}

function validProjectImage(): UploadedFile
{
    return UploadedFile::fake()->createWithContent(
        'project.png',
        File::get(public_path('fabia-portfolio-assets/safedorm-logo.png')),
    );
}

test('only the configured portfolio accounts can manage projects', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('projects.index'))
        ->assertForbidden();
});

test('a project manager can create a project with an uploaded image', function () {
    Storage::fake('public');

    $this->actingAs(projectManager())
        ->post(route('projects.store'), validProjectPayload([
            'image' => validProjectImage(),
        ]))
        ->assertRedirect(route('projects.index'))
        ->assertSessionHas('success', 'Project created successfully.');

    $project = Project::query()->where('title', 'Student Project')->firstOrFail();

    expect($project->tech_stack)->toBe(['Laravel', 'React']);
    Storage::disk('public')->assertExists($project->image_path);
});

test('the project form reports errors when required fields are empty', function () {
    $this->actingAs(projectManager())
        ->post(route('projects.store'), [])
        ->assertSessionHasErrors([
            'portfolio',
            'title',
            'description',
            'tech_stack',
            'display_order',
        ]);
});

test('project titles must not exceed the maximum length', function () {
    $this->actingAs(projectManager())
        ->post(route('projects.store'), validProjectPayload([
            'title' => str_repeat('a', 121),
        ]))
        ->assertSessionHasErrors('title');
});

test('project URLs must use a valid HTTP or HTTPS URL', function () {
    $this->actingAs(projectManager())
        ->post(route('projects.store'), validProjectPayload([
            'project_url' => 'javascript:alert(1)',
        ]))
        ->assertSessionHasErrors('project_url');
});

test('project titles must be unique within the selected portfolio', function () {
    Project::factory()->create([
        'portfolio' => 'fabia',
        'title' => 'Student Project',
    ]);

    $this->actingAs(projectManager())
        ->post(route('projects.store'), validProjectPayload())
        ->assertSessionHasErrors([
            'title' => 'A project with this title already exists for the selected portfolio.',
        ]);
});

test('updating a project without changing its unique title succeeds', function () {
    $project = Project::factory()->create([
        'portfolio' => 'fabia',
        'title' => 'Student Project',
    ]);

    $this->actingAs(projectManager())
        ->put(route('projects.update', $project), validProjectPayload())
        ->assertRedirect(route('projects.index'))
        ->assertSessionHas('success', 'Project updated successfully.');

    expect($project->fresh()->title)->toBe('Student Project');
});

test('project images must be valid supported image files', function () {
    Storage::fake('public');

    $this->actingAs(projectManager())
        ->post(route('projects.store'), validProjectPayload([
            'image' => UploadedFile::fake()->createWithContent(
                'not-an-image.txt',
                'plain text is not an image',
            ),
        ]))
        ->assertSessionHasErrors('image');

    expect(Project::query()->count())->toBe(0);
    expect(Storage::disk('public')->allFiles())->toBe([]);
});

test('project images must not exceed the maximum file size', function () {
    Storage::fake('public');

    $largeImage = UploadedFile::fake()->createWithContent(
        'large-project.png',
        File::get(public_path('fabia-portfolio-assets/safedorm-logo.png'))
            .str_repeat('0', 2 * 1024 * 1024),
    );

    $this->actingAs(projectManager())
        ->post(route('projects.store'), validProjectPayload([
            'image' => $largeImage,
        ]))
        ->assertSessionHasErrors([
            'image' => 'The image field must not be greater than 2048 kilobytes.',
        ]);
});

test('updating a project replaces its uploaded image using the multipart route', function () {
    Storage::fake('public');

    $oldImage = validProjectImage()->store('projects', 'public');
    $project = Project::factory()->create(['image_path' => $oldImage]);

    $this->actingAs(projectManager())
        ->post(route('projects.update', $project).'?_method=PUT', validProjectPayload([
            'image' => validProjectImage(),
        ]))
        ->assertRedirect(route('projects.index'))
        ->assertSessionHas('success', 'Project updated successfully.');

    $newImage = $project->fresh()->image_path;

    expect($newImage)->not->toBe($oldImage);
    Storage::disk('public')->assertExists($newImage);
    Storage::disk('public')->assertMissing($oldImage);
});

test('projects marked for both portfolios appear on both public pages', function () {
    $project = Project::factory()->create([
        'portfolio' => 'both',
        'title' => 'Shared Dynamic Project',
    ]);

    $fabia = User::factory()->create([
        'email' => config('portfolios.accounts.fabia.email'),
    ]);
    $ramos = projectManager();

    $this->actingAs($fabia)
        ->get(route('home'))
        ->assertOk()
        ->assertSee($project->title);

    $this->actingAs($ramos)
        ->get(route('home'))
        ->assertOk()
        ->assertSee($project->title);
});

test('a project manager can delete a project and its uploaded image', function () {
    Storage::fake('public');

    $imagePath = UploadedFile::fake()
        ->createWithContent(
            'project.png',
            File::get(public_path('fabia-portfolio-assets/safedorm-logo.png')),
        )
        ->store('projects', 'public');
    $project = Project::factory()->create(['image_path' => $imagePath]);

    $this->actingAs(projectManager())
        ->delete(route('projects.destroy', $project))
        ->assertRedirect(route('projects.index'))
        ->assertSessionHas('success', 'Project deleted successfully.');

    $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    Storage::disk('public')->assertMissing($imagePath);
});
