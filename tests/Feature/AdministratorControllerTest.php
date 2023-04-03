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
