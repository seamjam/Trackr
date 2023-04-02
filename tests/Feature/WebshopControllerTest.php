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
        // Create role with id 1 for superadmin and id 2 for webshop admin
        Role::factory()->create(['id' => 1]);
        Role::factory()->create(['id' => 2]);

        // Create a request object
        $request = Request::create('/dummy-route', 'POST', [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phonenumber' => $this->faker->phoneNumber,
            'webshop_name' => $this->faker->company,
        ]);

        // Call the store method
        $response = $this->actingAs($this->createSuperAdmin())->post('/dummy-route', $request->all());

        // Assert that a new webshop and user have been created
        $this->assertDatabaseCount('webshops', 1);
        $this->assertDatabaseCount('users', 2); // Including superadmin created for actingAs

        // Check if the created user is an admin user and has the correct webshop_id
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
            'is_admin' => true,
        ]);

        // Attach role with id 1 to the superadmin
        $superadmin->roles()->attach(Role::find(1));

        return $superadmin;
    }
}
