<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Lib\Roler;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        {
            // reset cahced roles and permission
            app()[PermissionRegistrar::class]->forgetCachedPermissions();

            // create permissions
            Permission::create(['name' => 'view posts']);
            Permission::create(['name' => 'create posts']);
            Permission::create(['name' => 'edit posts']);
            Permission::create(['name' => 'delete posts']);
            Permission::create(['name' => 'publish posts']);
            Permission::create(['name' => 'unpublish posts']);

            //create roles and assign existing permissions
            $writerRole = Role::create(['name' => 'writer']);
            $writerRole->givePermissionTo('view posts');
            $writerRole->givePermissionTo('create posts');
            $writerRole->givePermissionTo('edit posts');
            $writerRole->givePermissionTo('delete posts');

            $adminRole = Role::create(['name' => 'admin']);
            $adminRole->givePermissionTo('view posts');
            $adminRole->givePermissionTo('create posts');
            $adminRole->givePermissionTo('edit posts');
            $adminRole->givePermissionTo('delete posts');
            $adminRole->givePermissionTo('publish posts');
            $adminRole->givePermissionTo('unpublish posts');

            $superadminRole = Role::create(['name' => 'super-admin']);
            // gets all permissions via Gate::before rule

            // create demo users
            $user = User::factory()->create([
                'name' => 'Example user',
                'email' => 'writer@qadrlabs.com',
                'password' => bcrypt('12345678')
            ]);
            $user->assignRole($writerRole);

            $user = User::factory()->create([
                'name' => 'Example admin user',
                'email' => 'admin@qadrlabs.com',
                'password' => bcrypt('12345678')
            ]);
            $user->assignRole($adminRole);

            $user = User::factory()->create([
                'name' => 'Example superadmin user',
                'email' => 'superadmin@qadrlabs.com',
                'password' => bcrypt('12345678')
            ]);
            $user->assignRole($superadminRole);
        }

        // try {
        //     // $s_admin = User::create([
        //     //     "name" => "Aslan Asilon",
        //     //     'email' => 'aslanasilon@gmail.com',
        //     //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     // ]);
        //     // Roler::UserRole($s_admin, ["api", "developer"]);

        //     $s_admin = User::create([
        //         "name" => "ego oktafanda",
        //         'email' => 'super_admin@mail.com',
        //         'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     ]);
        //     Roler::UserRole($s_admin, ["api", "super-admin"]);

        //     $admin = User::create([
        //         "name" => "admin",
        //         'email' => 'admin@mail.com',
        //         'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     ]);
        //     Roler::UserRole($admin, ["api", "admin"]);

        // } catch (\Exception $e) {
        //     dd($e);
        // }

        // User::factory()->count(30)->create([
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'), // Menggunakan password default
        //     'remember_token' => Str::random(10),
        //     'profile_photo_path' => null,
        //     'current_company_id' => null,
        // ]);
    }
}
