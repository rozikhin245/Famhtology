<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\aktifitasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\familyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\kelolauserController;
use App\Http\Controllers\user\Familycontroller2;
use App\Models\family;
use Google\Service\Adsense\Row;

// route untuk menampilkan data di welcome
Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
    Route::get('/album/{albumDashboard}', [DashboardController::class, 'photosDashboard'])->name('photos');

    Route::resource('family', Familycontroller2::class);
});



Route::get('/', [DashboardController::class, 'chart'])->name('welcome');
Route::get('/allmembersfamily', [DashboardController::class, 'allmembersfamily'])->name('allmembersfamily');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//login with google
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {


    //route untuk mengelola data keluarga
    Route::resource('admin/FamilyMembers', familyController::class);
    Route::patch('admin/FamilyMembers/{id}/approve', [familyController::class, 'approve'])->name('FamilyMembers.approve');
    Route::patch('admin/FamilyMembers/{id}/reject', [familyController::class, 'reject'])->name('FamilyMembers.reject');
    Route::post('admin/FamilyMembers/{id}/approve', [familyController::class, 'approve'])->name('FamilyMembers.approve');
    Route::post('admin/FamilyMembers/{id}/reject', [familyController::class, 'reject'])->name('FamilyMembers.reject');

    //route untuk menampilkan tree family
    Route::get('admin/chart', [familyController::class, 'chart'])->name('chart');

    //route untuk mengelola data di album
    Route::resource('admin/albums', AlbumController::class);

    //route untuk mengelola data photo yang ada di dalam album
    Route::get('admin/albums/{album}/photos/create', [PhotoController::class, 'create'])->name('photos.create');
    Route::post('admin/albums/{album}/photos', [PhotoController::class, 'store'])->name('photos.store');
    Route::get('admin/albums/{album}/photos', [PhotoController::class, 'index'])->name('photos.index');
    Route::delete('admin/albums/{album}/photos/{photo}', [PhotoController::class, 'destroy'])->name('photos.destroy');

    //mengelola activity
    Route::resource('admin/activity', aktifitasController::class);
    Route::get('admin/activity/{activity}/invitation', [aktifitasController::class, 'invitationView'])->name('activity.invitation');
    Route::get('admin/activity/{activity}/generate-image', [aktifitasController::class, 'generateImage']);

    Route::resource('users', UserController::class)->only(['index', 'edit', 'update', 'destroy']);
});










Route::middleware('auth')->group(function () {
});

require __DIR__ . '/auth.php';
