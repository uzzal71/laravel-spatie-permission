# laravel-spatie-permission
Laravel Role &amp; Permission With Spatie Package

## Step 1 : Laravel 9 project create
```
composer create-project --prefer-dist laravel/laravel laravel-spatie-permission
```

#### Run your project
```
php artisan serve
```

#### Goto your fevarit browser
```
127.0.0.1:8000
```

## Step 2 : Laravel 9 Create Authentication

#### Now, we need to generate auth scaffolding in laravel 9 using the laravel UI command.
```
composer require laravel/ui
```

#### Install bootstrap auth using the below command.
```
php artisan ui bootstrap --auth
```

#### Now, install npm and run dev for better UI results. 
```
npm install
npm run dev
```

## Step 3 : Install Composer Packages

#### Now, we will install spatie package for ACL.
```
composer require spatie/laravel-permission
```

#### Also, install the form collection package using the below command.
```
composer require laravelcollective/html
```

#### Optional: The service provider will automatically get registered. Or you may manually add the service provider in your config/app.php file.
```
'providers' => [
	....
	Spatie\Permission\PermissionServiceProvider::class,
],
```

#### Now, publish this package as below.
```
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

#### Now you can see permission.php file and one migrations. So, we need to run migration using the following command.
```
php artisan migrate
```

## Step 4 : Create Product Migration

#### In this step, Create migration for the products table.
```
php artisan make:migration create_products_table
```

#### Edit products table as the below.
```
<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('detail');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
```

#### After that migrate the table using the below command. 
```
php artisan migrate
```

## Step 5 : Create Models

#### Now, create app/Models/User.php 
```
<?php
  
namespace App\Models;
  
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
  
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
  
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
  
    protected $hidden = [
        'password',
        'remember_token',
    ];
  
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
```

#### Create Product Model
```
php artisan make:model Product
```

#### After that create app/Models/Product.php
```
<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Product extends Model
{
    use HasFactory;
  
    protected $fillable = [
        'name', 'detail'
    ];
}
```

## Step 6 : Add Middleware

#### Spatie package provide it's in-built middleware, add middleware in Kernel.php file
```
protected $routeMiddleware = [
    ....
    'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
    'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
    'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,
]
```

## Step 7 : Create Routes

#### Now, add code in the routes/web.php file.
```
<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
  
  
Route::get('/', function () {
    return view('welcome');
});
  
Auth::routes();
  
Route::get('/home', [HomeController::class, 'index'])->name('home');
  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
});
```