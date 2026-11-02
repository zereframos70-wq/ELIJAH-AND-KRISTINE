<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('projects/index', [
            'projects' => Project::query()
                ->orderBy('portfolio')
                ->orderBy('display_order')
                ->orderByDesc('id')
                ->paginate(12)
                ->through(fn (Project $project): array => [
                    'id' => $project->id,
                    'portfolio' => $project->portfolio,
                    'title' => $project->title,
                    'description' => $project->description,
                    'tech_stack' => $project->tech_stack,
                    'image_url' => $project->image_url,
                    'display_order' => $project->display_order,
                    'project_note' => $project->project_note,
                ])
                ->withQueryString(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('projects/create');
    }

    public function store(StoreProjectRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $image = $request->file('image');
        unset($data['image']);
        $data['image_path'] = $image?->store('projects', 'public');
        Project::query()->create($data);

        return to_route('projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project): Response
    {
        return Inertia::render('projects/edit', [
            'project' => [
                'id' => $project->id,
                'portfolio' => $project->portfolio,
                'title' => $project->title,
                'description' => $project->description,
                'tech_stack' => $project->tech_stack,
                'project_url' => $project->project_url,
                'repository_url' => $project->repository_url,
                'image_url' => $project->image_url,
                'completed_at' => $project->completed_at?->toDateString(),
                'display_order' => $project->display_order,
                'project_note' => $project->display_note,
            ],
        ]);
    }

    public function update(UpdateProjectRequest $request, Project $project): RedirectResponse
    {
        $data = $request->validated();
        $image = $request->file('image');
        unset($data['image']);

        $oldImage = $project->image_path;

        if ($image) {
            $data['image_path'] = $image->store('projects', 'public');
        }

        $project->update($data);

        if ($image && $oldImage && ! str_starts_with($oldImage, '/')) {
            Storage::disk('public')->delete($oldImage);
        }

        return to_route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $imagePath = $project->image_path;
        $project->delete();

        if ($imagePath && ! str_starts_with($imagePath, '/')) {
            Storage::disk('public')->delete($imagePath);
        }

        return to_route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
