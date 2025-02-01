<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Party;
use App\Http\Controllers\PartyController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/parties', [PartyController::class, 'index'])->name('parties.index');

Route::get('/parties/{party}', [PartyController::class, 'show'])->name('parties.show');

Route::get('/parties/create', [PartyController::class, 'create'])->name('parties.create');

Route::post('/parties', [PartyController::class, 'store'])->name('parties.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
