<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ConsolesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Game
Route::get('/', [GameController::class, 'listGames'])->name('listGames');
Route::post('/addGame', [GameController::class, 'addGame'])->name('addNewGame');
Route::post('/deleteGame', [GameController::class, 'deleteGame'])->name('deleteGame');
Route::post('/updateGame', [GameController::class, 'updateGame'])->name('updateGame');

// Consoles
Route::get('/consoles', [ConsolesController::class, 'listConsoles'])->name('listConsoles');
Route::post('/addConsole', [ConsolesController::class, 'addConsole'])->name('addConsole');
Route::post('/deleteConsole', [ConsolesController::class, 'deleteConsole'])->name('deleteConsole');
Route::post('/UpdateConsole', [ConsolesController::class, 'updateConsole'])->name('updateConsole');
