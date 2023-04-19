<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Wedding\Create as WeddingCreate;
use App\Http\Livewire\Wedding\Show as WeddingShow;
use App\Http\Livewire\Wedding\Edit as WeddingEdit;
use App\Http\Livewire\Idea\Index as IdeaIndex;
use App\Http\Livewire\Budget\Index as BudgetIndex;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/wedding/create', WeddingCreate::class)->name('wedding.create');
    Route::get('/wedding/{wedding_id}', WeddingShow::class)->name('wedding.show');
    Route::get('/wedding/{wedding_id}/edit', WeddingEdit::class)->name('wedding.edit');

    Route::prefix('/wedding/{wedding_id}')->group(function () {
        Route::get('/ideas', IdeaIndex::class)->name('idea.index');
        Route::get('/budget', BudgetIndex::class)->name('budget.index');
        Route::get('/planning', WeddingShow::class)->name('planning.index');
        Route::get('/seating', WeddingShow::class)->name('seating.index');
    });
});

require __DIR__.'/auth.php';
