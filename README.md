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