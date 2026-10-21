
<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RestaurantTableController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryItemController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\BlogController as PublicBlogController;

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

    Route::view('/about', 'about')->name('about');

// Logged-in users: dashboard and basic order operations
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

    // Staff and admin can view and create orders
    Route::resource('orders', OrderController::class)
        ->only(['index', 'create', 'store', 'show']);

    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

        Route::get('/orders/{order}/invoice', [OrderController::class, 'invoice'])
    ->name('orders.invoice');

});


 // Admin-only pages and actions
Route::middleware(['auth', 'admin'])
    ->group(function () {

        Route::resource('menu-items', MenuItemController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('restaurant-tables', RestaurantTableController::class);
        Route::resource('inventory-items', InventoryItemController::class);

        // Only admin can edit, update or delete orders
        Route::resource('orders', OrderController::class)
            ->only(['edit', 'update', 'destroy']);

        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

      // User Management
    Route::resource('users', UserController::class)
        ->only(['index', 'create', 'store', 'destroy'])
        ->names([
            'index' => 'admin.users.index',
            'create' => 'admin.users.create',
            'store' => 'admin.users.store',
            'destroy' => 'admin.users.destroy',
        ]);

Route::resource('blogs', BlogController::class)
    ->except(['show'])
    ->names([
        'index' => 'admin.blogs.index',
        'create' => 'admin.blogs.create',
        'store' => 'admin.blogs.store',
        'edit' => 'admin.blogs.edit',
        'update' => 'admin.blogs.update',
        'destroy' => 'admin.blogs.destroy',
    ]);
    });

  Route::get('/blog', [PublicBlogController::class, 'index'])
    ->name('blogs.index');

Route::get('/blog/{slug}', [PublicBlogController::class, 'show'])
    ->name('blogs.show');

    Route::get('/our-menu', [HomeController::class, 'menu'])->name('menu.public');

require __DIR__.'/auth.php';
