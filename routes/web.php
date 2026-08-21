<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'));
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/projects/search', [ProjectController::class, 'search'])->name('projects.search');
    Route::resource('projects', ProjectController::class)->only(['index', 'store', 'show']);
    Route::post('/projects/{project}/notes', [ProjectController::class, 'addNote'])->name('projects.notes.store');
    Route::post('/projects/{project}/files', [ProjectController::class, 'upload'])->name('projects.files.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/team', [ProfileController::class, 'team'])->name('team');
});
Route::get('/api/status', [DashboardController::class, 'status']);
