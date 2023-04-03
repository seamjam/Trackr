<?php

namespace Tests\Feature;

use App\Models\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;
use Picqer\Barcode\BarcodeGeneratorHTML;

class PackageControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */

    public function testGeneratePDFFunction()
    {
        // Faking 3 packages
        $packages = Package::factory()->count(3)->create();

        // Set up request data
        $requestData = [
            'selectedPackages' => implode(',', $packages->pluck('id')->toArray()),
        ];

        // Send a POST request to the generatePDF route
        $response = $this->post(route('administrator.labels.PDF'), $requestData);

        // Assert the response is a PDF download
        $response->assertHeader('content-disposition', 'attachment; filename=labels.pdf');
        $response->assertHeader('content-type', 'application/pdf');

        // Check if the barcode for each package is present in the PDF content
        $generator = new BarcodeGeneratorHTML();
        foreach ($packages as $package) {
            $barcode = $generator->getBarcode($package->id, $generator::TYPE_CODE_128, 2, 50, 'black', true);
            $this->assertStringContainsString($barcode, $response->getContent());
        }
    }
}
