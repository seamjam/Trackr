<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\User;
use App\Models\Role;
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
            ['name' => 'administrator'],
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

//        Package::create([
//            'name' => 'packet1',
//            'status_id' => '1',
//            'postbedrijf_id',
//            'track and trace_ nullable -> gerigstreerd dan wordt die track and trace aangemaakt',
//            'webshop_id'
//        ]);
//
//        WebShop::create([
//            'name',
//            'adres',
//            'emailadres',
//        ]);
//
//        ''
//
//        superadmin-> administrator ->shopnaam.
//        administrator -> gebruikers-> packer-> amndere functies binnend de shop
//    bepaald shop.
//
//    superadmin->
//
//    DeliveryCompany::create([
//        'id',
//        'name'
//    ]);

    }
}
