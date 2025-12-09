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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->get('/login', Login::class)->name('login');
// Route::middleware('guest')->get('/register', Register::class)->name('register');

Route::post('/logout', function () {
    Auth::logout();

    session()->invalidate();
    session()->regenerateToken();

    return redirect('login');
})->name('logout');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', \App\Livewire\Dashboard\Admin::class)->name('dashboard.admin');

    Route::prefix('order')->group(function () {
        Route::get('/', Index::class)->name('order.index');
        Route::get('/create', \App\Livewire\Order\Create::class)->name('order.create');
        Route::get('/detail/{id}', \App\Livewire\Order\Detail::class)->name('order.detail');
        Route::get('/edit/{id}', \App\Livewire\Order\Edit::class)->name('order.edit');
    });

    Route::prefix('kategori')->group(function () {
        Route::get('/', \App\Livewire\Category\Index::class)->name('category.index');
        Route::get('/create', \App\Livewire\Category\Create::class)->name('category.create');
        Route::get('/edit/{id}', \App\Livewire\Category\Edit::class)->name('category.edit');
    });

    Route::prefix('product')->group(function () {
        Route::get('/', \App\Livewire\Product\Index::class)->name('product.index');
        Route::get('/create', \App\Livewire\Product\Create::class)->name('product.create');
        Route::get('/edit/{id}', \App\Livewire\Product\Edit::class)->name('product.edit');
    });

    Route::prefix('vendor')->group(function () {
        Route::get('/vendor', \App\Livewire\Vendor\Index::class)->name('vendor.index');
        Route::get('/create', \App\Livewire\Vendor\Create::class)->name('vendor.create');
        Route::get('/edit/{id}', \App\Livewire\Vendor\Edit::class)->name('vendor.edit');
    });
});

Route::middleware(['auth', 'role:produksi'])->group(function () {
    Route::get('/produksi/dashboard', \App\Livewire\Dashboard\Produksi::class)->name('dashboard.produksi');

    Route::prefix('bahan')->group(function () {
        Route::get('/', \App\Livewire\Bahan\Index::class)->name('bahan.index');
        Route::get('/create', Create::class)->name('bahan.create');
        Route::get('/edit/{id}', Edit::class)->name('bahan.edit');
    });

    Route::get('/vendor/list', \App\Livewire\Vendor\Listvendor::class)->name('vendor.list');

    Route::get('/produksi', ProductionList::class)->name('production.index');

    Route::get('/produksi/order-detail/{orderId}', OrderDetailList::class)
        ->name('production.order.detail.list');

    Route::get('/produksi/order-detail/{orderId}/create', OrderDetailCreate::class)
        ->name('production.order.detail.create');

    Route::get('/produksi/material/{orderId}', ProductionMaterialForm::class)
        ->name('production.material.form');

    Route::get('/produksi/material-list', ProductionMaterialList::class)->name('production.material.list');


});

Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/owner/dashboard', \App\Livewire\Owner\Dashboard::class)->name('dashboard.owner');
    Route::get('/owner/vendor', \App\Livewire\Owner\Vendor::class)->name('owner.vendor');
    Route::get('/owner/kategori', \App\Livewire\Owner\Kategori::class)->name('owner.kategori');
    Route::get('/owner/produk', \App\Livewire\Owner\Produk::class)->name('owner.produk');
    Route::get('/owner/order', \App\Livewire\Owner\OwnerOrder::class)->name('owner.order');
    Route::get('/owner/order/{id}', \App\Livewire\Owner\Detailorder::class)->name('owner.order.detail');

    Route::prefix('owner/user')->group(function () {
        Route::get('/users', \App\Livewire\Owner\User\Index::class)->name('owner.user.index');
        Route::get('/create', \App\Livewire\Owner\User\Create::class)->name('owner.user.create');
        Route::get('/edit/{id}', \App\Livewire\Owner\User\Edit::class)->name('owner.user.edit');
    });
});
