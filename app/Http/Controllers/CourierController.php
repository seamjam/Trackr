<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Package;
use App\Models\Post_company;

class CourierController extends Controller
{
    public function show()
    {
        $nameDeliveryCompany = auth()->user()->name;
        $delivery_company = Post_company::where('name', $nameDeliveryCompany )->first();

        if ($delivery_company) {
            $packages = Package::where('post_company_id', $delivery_company->id)->paginate(10);
        }

        return view('courier.packages.show', ['packages' => $packages]);
    }

}
