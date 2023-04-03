<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Webshop;
use App\Models\Role;
use Illuminate\Http\Request;

class WebshopControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     test
     */
    public function test_store_method_creates_webshop_and_admin_user()
    {
//creating 2 rols, one for superadmin and one for webshop with the id 2
        Role::factory()->create(['id' => 1]);
        Role::factory()->create(['id' => 2]);

        // Create a request object to create a fake post request
        $request = Request::create('/dummy-route', 'POST', [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phonenumber' => $this->faker->phoneNumber,
            'webshop_name' => $this->faker->company,
        ]);

        $response = $this->actingAs($this->createSuperAdmin())->post('/dummy-route', $request->all());

        // Assert that a new webshop and user have been created
        $this->assertDatabaseCount('webshops', 1);
        $this->assertDatabaseCount('users', 2);

        // Check with the emaiol it the user has been created
        $user = User::where('email', $request->input('email'))->first();
        $this->assertTrue($user->is_admin);
        $this->assertEquals($user->webshop_id, Webshop::first()->id);

        // Check if the user has the correct role
        $role = Role::find(2);
        $this->assertTrue($user->roles->contains($role));

        // Check if the user has the default password
        $this->assertTrue(\Hash::check('Welkom2023', $user->password));

        // Assert that the response is a redirect to the intended route
        $response->assertRedirect(route('superadmin.webshop.show'));
        $response->assertSessionHas('success', 'User and Webshop are succesfully created');
        $response->assertSessionHas('successDuration', 5);
    }

    /**
     * Helper function to create a superadmin user.
     *
     * @return User
     */
    private function createSuperAdmin()
    {
        $superadmin = User::factory()->create([
            'is_admin' => false,
        ]);

        // Attach role with id 1 to the superadmin
        $superadmin->roles()->attach(Role::find(1));
        return $superadmin;
    }
}
