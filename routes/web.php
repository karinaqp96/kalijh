<?php

use App\Http\Controllers\Admin\BoletaController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\CreditoController;
use App\Http\Controllers\Admin\detallebController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\admin\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Models\Credito;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home.index');
    Route::get('categoria', [CategoriaController::class, 'index'])->name('categoria.index');
    Route::post('categoria', [CategoriaController::class, 'store'])->name('categoria.store');
    Route::put('categoria/{id}', [CategoriaController::class, 'update'])->name('categoria.update');
    Route::delete('categoria/{id}', [CategoriaController::class, 'destroy'])->name('categoria.destroy');

    Route::get('producto', [ProductoController::class, 'index'])->name('producto.index');
    Route::post('producto', [ProductoController::class, 'store'])->name('producto.store');
    Route::put('producto/{id}', [ProductoController::class, 'update'])->name('producto.update');
    Route::delete('producto/{id}', [ProductoController::class, 'destroy'])->name('producto.destroy');

    Route::get('boleta', [BoletaController::class, 'index'])->name('boleta.index');

    Route::get('detalleb', [detallebController::class, 'index'])->name('detalleb.index');

    Route::get('credito', [CreditoController::class, 'index'])->name('credito.index');
    Route::post('credito', [CreditoController::class, 'store'])->name('credito.store');
    Route::put('credito/{id}', [CreditoController::class, 'update'])->name('credito.update');
    Route::delete('credito/{id}', [CreditoController::class, 'destroy'])->name('credito.destroy');

    Route::get('Cliente', [ClienteController::class, 'index'])->name('cliente.index');
    Route::post('Cliente', [ClienteController::class, 'store'])->name('cliente.store');
    Route::put('Cliente/{id}', [ClienteController::class, 'update'])->name('cliente.update');
    Route::delete('Cliente/{id}', [ClienteController::class, 'destroy'])->name('cliente.destroy');
});

require __DIR__.'/auth.php';
