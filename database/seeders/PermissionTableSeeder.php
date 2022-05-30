<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
  
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'users.index',
           'users.show',
           'users.create',
           'users.edit',
           'users.delete',
           'roles.index',
           'roles.show',
           'roles.create',
           'roles.edit',
           'roles.delete',
           'products.index',
           'products.show',
           'products.create',
           'products.edit',
           'products.delete'
        ];
     
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}