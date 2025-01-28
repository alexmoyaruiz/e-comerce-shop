<?php

use App\Livewire\Category\CategoryComponent;
use App\Livewire\Category\CategoryShow;
use App\Livewire\Client\ClientComponent;
use App\Livewire\Client\ClientShow;
use App\Livewire\Product\ProductComponent;
use App\Livewire\Product\ProductShow;
use Illuminate\Support\Facades\Route;
use App\Livewire\Home\Incio;
use App\Livewire\Sale\SaleCreate;
use Illuminate\Support\Facades\Auth;
use App\Livewire\User\UserComponent;
use App\Livewire\User\UserShow;


Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', Incio::class)->name('inicio')->middleware(['auth']);

Route::get('/categorias', CategoryComponent::class)->name('categorias')->middleware(['auth']);

Route::get('/categorias/{category}', CategoryShow::class)->name('categorias.show')->middleware(['auth']);

Route::get('/productos', ProductComponent::class)->name('product')->middleware(['auth']);

Route::get('/productos/{product}', ProductShow::class)->name('product.show')->middleware(['auth']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth']);

Route::get('/usuarios', UserComponent::class)->name('users')->middleware(['auth']);

Route::get('/usuarios/{user}', UserShow::class)->name('user.show')->middleware(['auth']);

Route::get('/clientes', ClientComponent::class)->name('client')->middleware(['auth']);

Route::get('/ver_clientes/{client}', ClientShow::class)->name('client.show')->middleware(['auth']);

//Ventas
Route::get('/crearVentas', SaleCreate::class)->name('sale.create')->middleware(['auth']);
