<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post_company;
use App\Models\Package;
use Carbon\Carbon;

class ApiController extends Controller
{
    public function generateApiToken(){
        auth()->user()->tokens()->delete();
        $token = auth()->user()->createToken('api', ['exp' => Carbon::now()->addMonths(6)->timestamp])->plainTextToken;
        return ['api_token' => $token];
    }

    public function apiStore(Request $request)
    {
        $request->validate([
            'labels' => 'required|array',
            'labels.*.post_company' => 'required|string',
            'labels.*.receiver_first_name' => 'required|string',
            'labels.*.receiver_last_name' => 'required|string',
            'labels.*.postal_code' => 'required|string',
            'labels.*.house_number' => 'required|string',
        ]);

        $labels = $request->input('labels');

        foreach ($labels as $label) {
            $trackingNumber = 'TN-' . uniqid();
            $post_company = Post_company::where('name', $label['post_company'])->first();

            $newLabel = new Package;
            $newLabel->status_id = 1;
            $newLabel->tracking_number = $trackingNumber;
            $newLabel->webshop_id = auth()->user()->webshop_id;
            $newLabel->post_company_id = $post_company->id;
            $newLabel->receiver_firstname = $label['receiver_first_name'];
            $newLabel->receiver_lastname = $label['receiver_last_name'];
            $newLabel->receiver_postal_code = $label['postal_code'];
            $newLabel->receiver_house_number = $label['house_number'];
            $newLabel->save();

            if (!$newLabel->save()) {
                return response()->json(['error' => 'An error occurred while saving the label'], 500);
            }
        }
        return response()->json(['message' => 'The labels have been created successfully!'], 201);
    }

}
