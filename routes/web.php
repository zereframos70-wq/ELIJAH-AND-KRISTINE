<?php

use App\Http\Controllers\ProjectController;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Inertia\Inertia;

Route::get('/', function (Request $request) {
    $email = Str::lower($request->user()->email);
    $accounts = config('portfolios.accounts');

    foreach ($accounts as $portfolio => $account) {
        if ($email === $account['email']) {
            $projects = Project::query()
                ->whereIn('portfolio', [$portfolio, 'both'])
                ->orderBy('display_order')
                ->orderByDesc('id')
                ->get();

            return view($account['view'], compact('projects'));
        }
    }

    abort(403);
})->middleware('auth')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function (Request $request) {
        if ($request->user()->can('manage-projects')) {
            return to_route('home');
        }

        return Inertia::render('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth', 'can:manage-projects'])->group(function () {
    Route::resource('projects', ProjectController::class)->except('show');
});

require __DIR__.'/settings.php';
