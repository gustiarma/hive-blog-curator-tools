<?php

use App\Http\Controllers\CuratorController;
use App\Http\Livewire\HiveCom;
use App\Http\Livewire\HiveCurator;
use Illuminate\Support\Facades\Route;

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


// Route::prefix('/')->group(function () {
// });
Route::get('', [CuratorController::class, 'index'])->name('curator.select-community');
Route::get('/c/{community}', [CuratorController::class, 'community'])->name('goto.community');
