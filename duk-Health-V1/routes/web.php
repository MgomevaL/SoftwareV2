<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;



Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

// Gestion de Usuarios
Route::middleware(['auth', 'can:usuarios'])->group(function () {
    Volt::route('usuarios', 'usuarios.index')->name('usuarios.index');
    Volt::route('usuarios/create', 'usuarios.create')->name('usuarios.create');
    Volt::route('usuarios/store', 'usuarios.store')->name('usuarios.store');
    Volt::route('usuarios/{user}/edit', 'usuarios.edit')->name('usuarios.edit');
});

// Gestion de Especialistas
Route::middleware(['auth', 'can:especialistas'])->group(function () {
    Volt::route('especialistas', 'especialistas.index')->name('especialistas.index');
    Volt::route('especialistas/create', 'especialistas.create')->name('especialistas.create');
    Volt::route('especialistas/store', 'especialistas.store')->name('especialistas.store');
    Volt::route('especialistas/{user}/edit', 'especialistas.edit')->name('especialistas.edit');
});


require __DIR__.'/auth.php';
