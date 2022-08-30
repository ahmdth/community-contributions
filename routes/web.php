<?php

use App\Http\Controllers\ChannelController;
use App\Http\Controllers\CommunityLinkController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VoteController;
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

Route::redirect('/', '/community');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/community/{channel?}', [CommunityLinkController::class, 'index'])->name('links.index');
Route::post('/community', [CommunityLinkController::class, 'store'])->middleware('auth')->name('links.store');
Route::post('/community/{link}/votes', [VoteController::class, 'store'])->middleware('auth')->name('votes.store');
Auth::routes();
