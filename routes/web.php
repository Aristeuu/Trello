<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProjectosController;
use App\Http\Controllers\ListaController;

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
    /*return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);*/
    return redirect()->route('register');
});
/*
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/
Route::get('/dashboard',[ProjectosController::class,'index'] )->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/dashboard', [ProjectosController::class,'store'])->middleware(['auth'])->name('dashboard.store');

Route::get('/board/{id}', [ProjectosController::class,'show'])->middleware(['auth'])->name('board');

Route::post('/board', [ListaController::class,'store'])->middleware(['auth'])->name('board.store');

Route::post('/board_membro',[ProjectosController::class,'AdicionarMembro'])->middleware(['auth'])->name('board_membro.store');

/*Route::get('/board/{id}',function () {
    return Inertia::render('Home');
})->middleware(['auth', 'verified'])->name('board');
*/



require __DIR__.'/auth.php';
