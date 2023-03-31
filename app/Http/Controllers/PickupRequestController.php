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
        $validatedData = $request->validate([
            'pickup_date' => ['required', 'date', new PickupDateRule()],
            'pickup_time' => ['required', 'date_format:H:i'],
            'postal_code' => ['required', 'regex:/^[1-9][0-9]{3}[\s]?[a-zA-Z]{2}$/'],
            'house_number' => ['required'],
            'selectedPackages' => ['required'],
        ]);

        if ($validatedData) {
            $pickupRequest = PickupRequest::create([
                'date' => $request->pickup_date,
                'time' => $request->pickup_time,
                'postal_code' => $request->postal_code,
                'house_number' => $request->house_number,
            ]);

            $selectedPackageIds = explode(',', $request->selectedPackages);
            Package::whereIn('id', $selectedPackageIds)->update([
                'pickupRequest_id' => $pickupRequest->id
            ]);
            return redirect()->route('pickups.show')->with('success', 'Pickup scheduled successfully.');
        } else {
            $errors = $request->errors();
            return redirect()->route('administrator.pickups.create')->with('error', $errors);
        }
    }


    public function show()
    {
        $webshopId = auth()->user()->webshop_id;
        $pickupRequests = PickupRequest::with('package')->whereHas('package', function ($query) use ($webshopId) {
            $query->where('webshop_id', $webshopId);
        })->get();
        return view('administrator.pickups.show', ['pickupRequests' => $pickupRequests]);
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
