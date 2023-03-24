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
        ]);

        //roles
        $roles = [
            ['name' => 'superadmin'],
            ['name' => 'webshop'],
            ['name' => 'packer'],
            ['name' => 'delivery_worker'],
            ['name' => 'delivery_company'],
            ['name' => 'receiver_customer'],
        ];
        DB::table('roles')->insert($roles);

        $superadmin_role = Role::where('name', 'superadmin')->first();
        DB::table('user_roles')->insert([
            'user_id' => $superadmin->id,
            'role_id' => $superadmin_role->id,
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

        $post_companies = [['name' => 'dhl'],
            ['name' => 'post_nl'],
            ['name' => 'ups'],
        ];
        Post_company::insert($post_companies);


        $reviews = [['stars' => 5, 'description' => 'hele fijne delivery, zal het zeker nog eens doen. via deze post bedrijf hihi']
        ];
        DB::table('reviews')->insert($reviews);


        $packages = [['name' => 'packet1', 'status_id' => '1', 'post_company_id' => '1', 'tracking_number' => '13789373', 'webshop_id' => '1', 'review_id' => '1',],
        ];

        DB::table('packages')->insert($packages);

    }
}
