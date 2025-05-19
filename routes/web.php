<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;

use App\Livewire\Admin\Dashboard\ListDashboard;
use App\Http\Controllers\LanguageController;


// Route::get('/', function () {
// });




Route::get('/', App\Livewire\Auth\Login::class)->name('login');





Route::get('/posts',  App\Livewire\Post\PostList::class)->name('post-list');
Route::get('/posts/create',  App\Livewire\Post\PostCrud::class)->name('post-crud');
Route::get('/posts/edit/{id}',  App\Livewire\Post\PostCrud::class)->name('post-crud');

Route::get('/users',  App\Livewire\User1\UserList::class)->name('user-list');
Route::get('/users/create',  App\Livewire\User1\UserCrud::class)->name('user-crud');
Route::get('/users/edit/{id}',  App\Livewire\User1\UserCrud::class)->name('user-crud');


Route::get('/images',  App\Livewire\Image\ImageList::class)->name('image-list');
Route::get('/images/create',  App\Livewire\Image\ImageCrud::class)->name('image-crud');
Route::get('/images/edit/{id}',  App\Livewire\Image\ImageCrud::class)->name('image-crud');



Route::get('/videos',  App\Livewire\Video\VideoList::class)->name('video-list');
Route::get('/videos/create',  App\Livewire\Video\VideoCrud::class)->name('video-crud');
Route::get('/videos/edit/{id}',  App\Livewire\Video\VideoCrud::class)->name('video-crud');


Route::get('/comments',  App\Livewire\Comment\CommentList::class)->name('video-list');
Route::get('/comments/create',  App\Livewire\Comment\CommentCrud::class)->name('video-crud');
Route::get('/comments/edit/{id}',  App\Livewire\Comment\CommentCrud::class)->name('video-crud');


Route::get('/tags',  App\Livewire\Tag\TagList::class)->name('video-list');
Route::get('/tags/create',  App\Livewire\Tag\TagCrud::class)->name('video-crud');
Route::get('/tags/edit/{id}',  App\Livewire\Tag\TagCrud::class)->name('video-crud');



// Route::middleware('auth:sanctum')->group(function () {
Route::get('/timer-component', App\Livewire\TimerComponent::class)->name('timer-component');

Route::get('/role', App\Livewire\Admin\Role\RoleList::class)->name('role');
Route::get('/role/create', App\Livewire\Admin\Role\RoleCrud::class)->name('role-create');
Route::get('/role/edit/{id}', App\Livewire\Admin\Role\RoleCrud::class)->name('role-edit');

Route::get('/permission', App\Livewire\Admin\Permission\PermissionList::class)->name('permission');
Route::get('/permission/create', App\Livewire\Admin\Permission\PermissionCrud::class)->name('permission-crud');
Route::get('/permission/edit/{id}', App\Livewire\Admin\Permission\PermissionCrud::class)->name('permission-crud');

Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'en|id|jp'], 'middleware' => 'language'], function () {
    Route::get('/set-language', [LanguageController::class, 'setLanguage'])->name('set-language');
    // Route::get('/dashboard', ListDashboard::class)->name('dashboard');
});






Route::prefix('/accounting')->group(function () {

    Route::get('/dashboard',  App\Livewire\Admin\Accounting\Dashboard\DashboardList::class)->name('dashboard-list');
    Route::get('/dashboard-analytic',  App\Livewire\Admin\Accounting\Dashboard\DashboardAnalyticList::class)->name('dashboard-analytic-list');

    Route::get('/accounts',  App\Livewire\Admin\Accounting\Account\AccountList::class)->name('account-list');
    Route::get('/accounts/create',  App\Livewire\Admin\Accounting\Account\AccountCrud::class)->name('account-crud');
    Route::get('/accounts/edit/{id}',  App\Livewire\Admin\Accounting\Account\AccountCrud::class)->name('account-crud');
});

Route::prefix('/human-resource')->group(function () {
    Route::get('/dashboard',  App\Livewire\Admin\Accounting\Dashboard\DashboardList::class)->name('dashboard-list');

    Route::get('/companies',  App\Livewire\Admin\Company\CompanyList::class)->name('company-list');
    Route::get('/companies/create',  App\Livewire\Admin\Company\CompanyCrud::class)->name('company-crud');
    Route::get('/companies/edit/{id}',  App\Livewire\Admin\Company\CompanyCrud::class)->name('company-crud');
});

Route::prefix('/warehouse')->group(function () {
    Route::get('/dashboard',  App\Livewire\Admin\Warehouse\Dashboard\DashboardList::class)->name('dashboard-list');

    Route::get('/products',  App\Livewire\Product\ProductList::class)->name('product-list');
    Route::get('/products/create',  App\Livewire\Product\ProductCrud::class)->name('product-crud');
    Route::get('/products/edit/{id}',  App\Livewire\Product\ProductCrud::class)->name('product-crud');
});


// Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
// Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
// Route::post('/users', [UserController::class, 'store'])->name('users.store');
// Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
// Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
// Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
// Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
Route::get('/roles/{role}', [RoleController::class, 'show'])->name('roles.show');
Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

// Route::get('/products', [ProductController::class, 'index'])->name('products.index');
// Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
// Route::post('/products', [ProductController::class, 'store'])->name('products.store');
// Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
// Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
// Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
// Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');


Route::get('/post', App\Livewire\Post\PostList::class)->name('posts.index');



// });

require __DIR__ . '/auth.php';
