<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Webshop;
use App\Models\PickupRequest;
use App\Models\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdministratorPickupsControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function it_displays_pickup_requests_for_authenticated_users_webshop()
    {
        // Create a webshop and a user
        $webshop = Webshop::factory()->create();
        $user = User::factory()->create(['webshop_id' => $webshop->id]);

        // Create another webshop to ensure we only retrieve data for the authenticated user's webshop
        $otherWebshop = Webshop::factory()->create();

        // Create some packages for each webshop
        $packages = Package::factory()->count(3)->create(['webshop_id' => $webshop->id]);
        $otherPackages = Package::factory()->count(2)->create(['webshop_id' => $otherWebshop->id]);

        // Create pickup requests for the packages
        $pickupRequests = $packages->map(function ($package) {
            return PickupRequest::factory()->create(['package_id' => $package->id]);
        });

        $otherPickupRequests = $otherPackages->map(function ($package) {
            return PickupRequest::factory()->create(['package_id' => $package->id]);
        });

        // Act as the user and call the show() method
        $response = $this->actingAs($user)->get('/administrator/pickups/show');

        // Assert the view is returned with the correct pickup requests
        $response->assertStatus(200)
            ->assertViewIs('administrator.pickups.show')
            ->assertViewHas('pickupRequests', $pickupRequests);
    }


    /** @test */
    public function it_displays_packages_with_filters_and_sorting()
    {
        $webshop = Webshop::factory()->create();
        $user = User::factory()->create(['webshop_id' => $webshop->id]);
        $statuses = Status::factory()->count(3)->create();
        $postCompany = PostCompany::factory()->create();

        $packages = Package::factory()->count(5)->create([
            'webshop_id' => $webshop->id,
            'status_id' => $statuses->random()->id,
            'post_company_id' => $postCompany->id,
        ]);

        $selectedStatus = $statuses->random()->id;
        $isSent = '1';
        $search = $packages->random()->tracking_number;
        $sort = 'tracking_number';
        $order = 'asc';

        $filters = [
            'status' => $selectedStatus,
            'is_sent' => $isSent,
            'search' => $search,
            'sort' => $sort,
            'order' => $order,
        ];

        $response = $this->actingAs($user)->get('/administrator/labels/show', $filters);

        $response->assertStatus(200)
            ->assertViewIs('administrator.labels.show')
            ->assertViewHas(['packages', 'statuses', 'selectedStatus', 'isSent', 'sort', 'order'])
            ->assertSeeTextInOrder($packages->sortBy($sort)->pluck('tracking_number')->toArray());
    }
}
