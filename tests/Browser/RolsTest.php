<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RolsTest extends DuskTestCase
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
                ->clicklink('Trackr webwinkels')
                ->logout();
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
                ->press('Plan Pickup')
                ->assertPathIs('/labels')
                ->select('status', 'delivered')
                ->press('Filter')
                ->assertSee('Upload CSV')
                ->check('input[name="selectedObjects[]"][value="1"]')
                ->press('Plan Pickup')
                ->type('pickup_date', '2023-04-26')
                ->type('pickup_time', '18:00')
                ->type('postal_code', '3987DB')
                ->type('house_number', '50')
                ->press('Schedule Pick up')
                ->assertPathIs('/pickups')
                ->logout();
        });
    }

//    /**
//     * @test
//     */
    public function customer_set_review(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->assertSee('Name')
                ->assertSee('Email')
                ->assertSee('Password')
                ->type('name', 'Henook Jamaladin')
                ->type('email', 'henook@outlook.com')
                ->type('password', 'password')
                ->type('password_confirmation', 'password')
                ->type('postal_code', '3987DB')
                ->type('house_number', '50')
                ->press('REGISTER')
                ->assertPathIs('/dashboard')
                ->assertAuthenticated()
                ->clicklink('Order');


            $browser->visit('/details/2')
                ->select('rating', '3')
                ->type('review', 'Very fast delivery!')
                ->press('Send review')
                ->assertPathIs('/orders')
                ->logout();
        });
    }


}
