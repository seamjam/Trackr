<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Package;
use App\Models\Review;

class CustomerController extends Controller
{
    public function show(Request $request)
    {
        $user = Auth::user();
        $statuses = Status::all();
        $selectedStatus = $request->input('status', '');

        $packages = Package::where('receiver_postal_code', $user->receiver_postal_code)
            ->where('receiver_house_number', $user->receiver_house_number);

        if (!empty($selectedStatus)) {
            $packages = $packages->where('status_id', $selectedStatus);
        }

        if ($request->has('search')) {
            $search = $request->input('search');

            $packages = $packages->join('webshops', 'webshops.id', '=', 'packages.webshop_id')
                ->whereRaw("MATCH(packages.tracking_number) AGAINST(?)", [$search])
                ->orWhereRaw("MATCH(webshops.name) AGAINST(?)", [$search])
                ->select('packages.*');
        } else {
            $packages = $packages->join('webshops', 'webshops.id', '=', 'packages.webshop_id')
                ->select('packages.*');
        }

        $packages = $packages->paginate(10);

        return view('customer.show', [
            'user' => $user,
            'packages' => $packages,
            'statuses' => $statuses,
            'selectedStatus' => $selectedStatus,
        ]);
    }

    public function details(Package $package)
    {
        return view('customer.details', ['package' => $package]);
    }

    public function review(Request $request){
        $package_id = $request->input('package_id');
        $rating = $request->input('rating');
        $review = $request->input('review');

        $new_review = new Review([
            'stars' => $rating,
            'description' => $review
        ]);
        $new_review->save();

        $package = Package::find($package_id);
        $package->review_id = $new_review->id;
        $package->save();

        return redirect()->route('customer.show')->with('success', 'Thank you for your review.');
    }


}
