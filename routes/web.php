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
Route::get('/communities', HiveCurator::class);
Route::get('/c/{community}', HiveCom::class)->name('goto.community');