<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Package;
use App\Models\Status;
use App\Models\Post_company;

class CourierController extends Controller
{
    public function show(Request $request)
    {
        $nameDeliveryCompany = auth()->user()->name;
        $statuses = Status::all();
        $selectedStatus = $request->input('status', '');

        $delivery_company = Post_company::where('name', $nameDeliveryCompany)->first();

        $search = $request->input('search', '');

        $packages = Package::where('post_company_id', $delivery_company->id);

        if ($selectedStatus) {
            $packages = $packages->where('status_id', $selectedStatus);
        }

        if ($delivery_company) {
            $packages = $packages->when($search, function ($query) use ($search) {
                return $query->whereRaw("MATCH (packages.tracking_number) AGAINST (? IN BOOLEAN MODE)", [$search])
                    ->orWhereHas('webshop', function ($query) use ($search) {
                        $query->whereRaw("MATCH (name) AGAINST (? IN BOOLEAN MODE)", [$search]);
                    });
            })->paginate(10);
        }
        return view('courier.packages.show', ['packages' => $packages, 'search' => $search, 'statuses' => $statuses, 'selectedStatus' => $selectedStatus]);
    }
}
