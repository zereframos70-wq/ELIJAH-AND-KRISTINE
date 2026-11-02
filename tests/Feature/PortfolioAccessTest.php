<?php

use App\Models\User;

test('guests are sent to the login page before choosing a portfolio', function () {
    $this->get(route('home'))->assertRedirect(route('login'));
});

test('the Ramos account sees the Ramos portfolio', function () {
    $user = User::factory()->create([
        'email' => config('portfolios.accounts.ramos.email'),
    ]);

    $this->actingAs($user)
        ->get(route('home'))
        ->assertOk()
        ->assertViewIs('ramos.index')
        ->assertSee('Elijah T. Ramos | Frontend Developer')
        ->assertSee('Manage Projects')
        ->assertSee(route('projects.index'), false)
        ->assertSee(route('logout'), false)
        ->assertSee('Log out');
});

test('the Fabia account sees the Fabia portfolio', function () {
    $user = User::factory()->create([
        'email' => config('portfolios.accounts.fabia.email'),
    ]);

    $this->actingAs($user)
        ->get(route('home'))
        ->assertOk()
        ->assertViewIs('fabia.index')
        ->assertSee('Kristine Irish A. Fabia | Aspiring IT Professional')
        ->assertSee('Manage Projects')
        ->assertSee(route('projects.index'), false)
        ->assertSee(route('logout'), false)
        ->assertSee('Log out');
});

test('other authenticated accounts cannot access either portfolio', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('home'))
        ->assertForbidden();
});
