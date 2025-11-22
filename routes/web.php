<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Bahan\Create;
use App\Livewire\Bahan\Edit;
use App\Livewire\Order\Index;
use App\Livewire\Production\OrderDetailCreate;
use App\Livewire\Production\OrderDetailList;
use App\Livewire\Production\ProductionList;
use App\Livewire\Production\ProductionMaterialForm;
use App\Livewire\Production\ProductionMaterialList;
use App\Models\ProductionMaterial;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', \App\Livewire\Dashboard::class)->name('dashboard');

    Route::prefix('bahan')->group(function () {
        Route::get('/', \App\Livewire\Bahan\Index::class)->name('bahan.index');
        Route::get('/create', Create::class)->name('bahan.create');
        Route::get('/edit/{id}', Edit::class)->name('bahan.edit');
    });

    Route::prefix('order')->group(function () {
        Route::get('/', Index::class)->name('order.index');
        Route::get('/create', \App\Livewire\Order\Create::class)->name('order.create');
        Route::get('/detail/{id}', \App\Livewire\Order\Detail::class)->name('order.detail');
    });

    Route::prefix('product')->group(function () {
        Route::get('/', \App\Livewire\Product\Index::class)->name('product.index');
        Route::get('/create', \App\Livewire\Product\Create::class)->name('product.create');
        Route::get('/edit/{id}', \App\Livewire\Product\Edit::class)->name('product.edit');
    });

    Route::prefix('vendor')->group(function(){
        Route::get('/', \App\Livewire\Vendor\Index::class)->name('vendor.product');
        Route::get('/create', \App\Livewire\Vendor\Create::class)->name('vendor.create');
        Route::get('/edit/{id}', \App\Livewire\Vendor\Edit::class)->name('vendor.edit');
    });

    Route::get('/produksi', ProductionList::class)->name('production.index');

    Route::get('/produksi/order-detail/{orderId}', OrderDetailList::class)
    ->name('production.order.detail.list');

    Route::get('/produksi/order-detail/{orderId}/create', OrderDetailCreate::class)
    ->name('production.order.detail.create');

    Route::get('/produksi/material/{orderId}', ProductionMaterialForm::class)
    ->name('production.material.form');

    Route::get('/produksi/material-list', ProductionMaterialList::class)->name('production.material.list');

    // Route::get('/produksi/orders/{order}/details', OrderDetailList::class)->name('details.index');
    // Route::get('/produksi/orders/{order}/details/create', OrderDetailCreate::class)->name('details.create');

    // Route::get('/bahan', \App\Livewire\Bahan\Index::class)->name('bahan.index');
    // Route::get('/bahan/create', \App\Livewire\Bahan\Create::class)->name('bahan.create');

    Route::post('/logout', function () {
        Auth::logout();
        return redirect('login');
    })->name('logout');
});
