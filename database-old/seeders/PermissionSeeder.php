<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Pengguna;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // reset cahced roles and permission
                app()[PermissionRegistrar::class]->forgetCachedPermissions();

                // create permissions
                Permission::create(['name' => 'lihat pertanyaan']);
                Permission::create(['name' => 'buat pertanyaan']);
                Permission::create(['name' => 'edit pertanyaan']);
                Permission::create(['name' => 'hapus pertanyaan']);

                //create roles and assign existing permissions
                $customerRole = Role::create(['name' => 'customer']);
                $customerRole->givePermissionTo('lihat pertanyaan');

                $marketingRole = Role::create(['name' => 'marketing']);
                $marketingRole->givePermissionTo('lihat pertanyaan');
                $marketingRole->givePermissionTo('buat pertanyaan');
                $marketingRole->givePermissionTo('edit pertanyaan');
                $marketingRole->givePermissionTo('hapus pertanyaan');

                $developerRole = Role::create(['name' => 'developer']);
                $adminRole = Role::create(['name' => 'admin']);

                // gets all permissions via Gate::before rule

                // create demo users
                $user = Pengguna::factory()->create([
                    'name' => 'Example user',
                    'email' => 'customer@mail.com',
                    'password' => Hash::make('123123123')
                ]);
                $user->assignRole($visitorRole);

                $user = Pengguna::factory()->create([
                    'name' => 'Example admin user',
                    'email' => 'sales@mail.com',
                    'password' => Hash::make('123123123')
                ]);
                $user->assignRole($salesRole);

                $user = Pengguna::factory()->create([
                    'name' => 'Example developer user',
                    'email' => 'developer@mail.com',
                    'password' => bcrypt('123123123')
                ]);
                $user->assignRole($developerRole);


                $user = Pengguna::factory()->create([
                    'name' => 'Example admin user',
                    'email' => 'admin@mail.com',
                    'password' => bcrypt('123123123')
                ]);
                $user->assignRole($adminRole);

    }
}
