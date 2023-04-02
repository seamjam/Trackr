<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AuthenticationTest extends DuskTestCase
{


//    /**
//     * @test
//     */
    public function superadmin_create_deliverycompany_and_user_createwebshop(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee('Email')
                ->assertSee('Password')
                ->type('email', 'superadmin@trackr.com')
                ->type('password', 'password')
                ->press('LOG IN')
                ->assertPathIs('/dashboard')
                ->assertAuthenticated()
                ->clicklink('Trackr users')
                ->assertSee('Registered Trackr users')
                ->clickLink('Add new delivery company')
                ->assertPathIs('/deliveryCompany/create')
                ->assertSee('Add new delivery company')
                ->type('name', 'sups owner')
                ->type('email', 'sups@trackr.com')
                ->type('phonenumber', '0684427785')
                ->type('delivercompany_name', 'sups')
                ->press('Add User')
                ->assertPathIs('/users')
                ->clicklink('Trackr webshops')
                ->assertPathIs('/webshops')
                ->assertSee('Registered Trackr webshops')
                ->clickLink('Add new Webshop')
                ->assertSee('Add new Webshop')
                ->type('webshop_name', 'Zara')
                ->type('name', 'Zahra')
                ->type('email', 'zahra@trackr.com')
                ->type('phonenumber', '0631342068')
                ->press('Add User and Webshop')
                ->assertPathIs('/webshops')
                ->press('Edit')
                ->type('name', 'bershka')
                ->press('Update User and Webshop')
                ->assertPathIs('/webshops')
                ->clicklink('Language')
                ->assertPathIs('/lang/change')
                ->select('locale', 'nl')
                ->clicklink('Trackr webwinkels');
//                ->click('@user-name-button'); // Gebruik click() in plaats van script()
//                ->click('@logout-link') // Gebruik click() met het dusk-attribuut
//                ->assertGuest();
        });
    }


    /**
     * @test
     */
    public function administrator_create(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee('Email')
                ->assertSee('Password')
                ->type('email', 'administrator1@trackr.com')
                ->type('password', 'password')
                ->press('LOG IN')
                ->assertPathIs('/dashboard')
                ->assertAuthenticated()
                ->clicklink('Registered Packages')
                ->assertSee('Registered Packages')
                ->clickLink('Register package(s)')
                ->assertPathIs('/label/create')
                ->type('label_count', '3')
                ->select('post_company_id', 'postnl')
                ->type('postal_code', '3785lp')
                ->type('house_number', '49')
                ->type('receiver_first_name', 'Henook')
                ->type('receiver_last_name', 'Jamaladin')
                ->press('Add')
                ->press('Delete')
                ->press('Create Label')
                ->assertPathIs('/labels')
        });
    }
}
