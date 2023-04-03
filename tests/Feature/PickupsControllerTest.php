<?php

namespace Tests\Unit;

use App\Models\PickupRequest;
use App\Models\User;
use App\Models\Webshop;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PickupsControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_show_method_returns_pickup_requests_for_authenticated_webshop()
    {
        // Create a webshop admin owner
        $webshop = Webshop::factory()->create();
        $user = User::factory()->create(['webshop_id' => $webshop->id]);

        // creating other webshops to ensure that only the pickuprequest from that webshop shows
        $otherWebshop = Webshop::factory()->create();

        // Creatting pickup request for both webshops
        $pickupRequestCount = 3;
        PickupRequest::factory()->count($pickupRequestCount)->forPackage([
            'webshop_id' => $webshop->id,
        ])->create();
        PickupRequest::factory()->count($pickupRequestCount)->forPackage([
            'webshop_id' => $otherWebshop->id,
        ])->create();

        // going to the correct url
        $response = $this->actingAs($user)->get('/pickups');

        // Making sure that it loads correctly
        $response->assertStatus(200);
        $response->assertViewIs('administrator.pickups.show');
        $response->assertViewHas('pickupRequests');

        $pickupRequests = $response->viewData('pickupRequests');
        $this->assertCount($pickupRequestCount, $pickupRequests);

        foreach ($pickupRequests as $pickupRequest) {
            $this->assertEquals($webshop->id, $pickupRequest->package->webshop_id);
        }
    }
}
