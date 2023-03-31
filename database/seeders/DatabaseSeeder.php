<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\Post_company;
use App\Models\Review;
use App\Models\User;
use App\Models\Role;
use App\Models\Webshop;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //webshops
        Webshop::Create([
            'name' => 'Webshop 1',
            'postcode' => '3459AA',
            'house_number' => '1',
        ]);

        // superadmin user
        $superadmin = User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@trackr.com',
            'password' => Hash::make('password'),
            'phonenumber' => '067774567869',
            'is_admin' => false
        ]);

        $webshop_owner = User::create([
            'name' => 'webshopowner1',
            'email' => 'webshop1@trackr.com',
            'password' => Hash::make('password'),
            'phonenumber' => '067774567869',
            'is_admin' => true,
            'webshop_id' => 1
        ]);

        $administrator1 = User::create([
            'name' => 'administrator1',
            'email' => 'administrator1@trackr.com',
            'password' => Hash::make('password'),
            'phonenumber' => '067774567869',
            'is_admin' => false,
            'webshop_id' => 1
        ]);

        $dhl = User::create([
            'name' => 'dhl',
            'email' => 'dhl@trackr.com',
            'password' => Hash::make('password'),
            'phonenumber' => '067774567869',
            'is_admin' => false,
        ]);

        $postnl = User::create([
            'name' => 'postnl',
            'email' => 'postnl@trackr.com',
            'password' => Hash::make('password'),
            'phonenumber' => '067774567869',
            'is_admin' => false,
        ]);

        $ups = User::create([
            'name' => 'ups',
            'email' => 'ups@trackr.com',
            'password' => Hash::make('password'),
            'phonenumber' => '067774567869',
            'is_admin' => false,
        ]);

        //roles
        $roles = [
            ['name' => 'superadmin'],
            ['name' => 'webshop'],
            ['name' => 'administrator'],
            ['name' => 'packer'],
            ['name' => 'receiver_customer'],
            ['name' => 'courier'],
        ];
        DB::table('roles')->insert($roles);

        $superadmin_role = Role::where('name', 'superadmin')->first();
        DB::table('user_roles')->insert([
            'user_id' => $superadmin->id,
            'role_id' => $superadmin_role->id,
        ]);

        $webshop_owner_rol = Role::where('name', 'webshop')->first();
        DB::table('user_roles')->insert([
            'user_id' => $webshop_owner->id,
            'role_id' => $webshop_owner_rol->id,
        ]);

        $administrator_rol = Role::where('name', 'administrator')->first();
        DB::table('user_roles')->insert([
            'user_id' => $administrator1->id,
            'role_id' => $administrator_rol->id,
        ]);

        $courier_rol = Role::where('name', 'courier')->first();
        DB::table('user_roles')->insert([
            'user_id' => $postnl->id,
            'role_id' => $courier_rol->id,
        ]);

        $courier_rol = Role::where('name', 'courier')->first();
        DB::table('user_roles')->insert([
            'user_id' => $dhl->id,
            'role_id' => $courier_rol->id,
        ]);

        $courier_rol = Role::where('name', 'courier')->first();
        DB::table('user_roles')->insert([
            'user_id' => $ups->id,
            'role_id' => $courier_rol->id,
        ]);

        $status = [
            ['name' => 'registered'],
            ['name' => 'printed'],
            ['name' => 'delivered'],
            ['name' => 'sorting_center'],
            ['name' => 'in_transit'],
            ['name' => 'arrived'],
        ];
        DB::table('statuses')->insert($status);

        $post_companies = [
            ['name' => 'dhl'],
            ['name' => 'postnl'],
            ['name' => 'ups'],
        ];
        Post_company::insert($post_companies);

        $reviews = [
            ['stars' => 5,
             'description' => 'hele fijne delivery, zal het zeker nog eens doen. via deze post bedrijf hihi']
        ];
        DB::table('reviews')->insert($reviews);

        $packages = [
            ['status_id' => '1', 'post_company_id' => '1',
            'tracking_number' => '13789373',
            'webshop_id' => '1', 'review_id' => '1',
            ]
        ];
        DB::table('packages')->insert($packages);

    }
}
