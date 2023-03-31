<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PickupRequest;
use App\Models\Package;
use App\Rules\PickupDateRule;

class PickupRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'pickup_date' => ['required', 'date', new PickupDateRule()],
            'pickup_time' => ['required', 'date_format:H:i'],
            'selectedPackages' => ['required'],
        ]);

        return redirect()->route('pickups.show')->with('success', 'Pickup scheduled successfully.');

    }

    public function show()
    {
        $webshopId = auth()->user()->webshop_id;
        $packages = Package::where('webshop_id', $webshopId)->with('pickupRequest')->get();
        return view('administrator.pickups.show', ['packages' => $packages]);
    }


    public function create(Request $request)
    {
        $selectedPackageIds = $request->input('selectedPackages');
        $selectedPackages = [];

        if ($selectedPackageIds) {
            $selectedPackageIdsArray = explode(',', $selectedPackageIds);
            $selectedPackages = Package::whereIn('id', $selectedPackageIdsArray)->get();
        }
        if ($selectedPackages == null) {
            return redirect()->route('administrator.labels.show')->with('error', 'No packages selected.');
        }
        return view('administrator.pickups.create', ['selectedPackages' => $selectedPackages]);
    }

}
