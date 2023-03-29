<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Status;
use App\Models\Post_company;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;

class LabelController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:administrator']);
    }

    public function show(Request $request)
    {
        $webshopId = auth()->user()->webshop_id;
        $statuses = Status::all();

        $selectedStatus = $request->input('status', '');

        if ($selectedStatus) {
            $packages = Package::where('webshop_id', $webshopId)
                ->where('status_id', $selectedStatus)
                ->paginate(10);
        } else {
            $packages = Package::where('webshop_id', $webshopId)->paginate(10);
        }

        return view('administrator.labels.show', [
            'packages' => $packages,
            'statuses' => $statuses,
            'selectedStatus' => $selectedStatus,
        ]);
    }

    public function create()
    {
        $postCompanies = Post_company::all();

        return view('administrator.labels.create', [
            'post_companies' => $postCompanies,
        ]);
    }

    public function store(Request $request)
    {
        $labels = json_decode($request->input('labels'), true);

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
        }
        return redirect()->route('administrator.labels.show')->with('success', 'The labels have been created successfully!');
    }

    public function generatePDF(Request $request)
    {
        $labels = Package::all();
        $pdf = app('dompdf.wrapper');
        $labelHTML = '';

        foreach ($labels as $label) {
            $data = [
                'title' => 'Dit is een test label',
                'date' => date('m/d/Y'),
                'label' => $label
            ];

            $labelHTML .= view('administrator.labels.PDF', $data)->render();
        }

        $pdf->loadHTML($labelHTML);

        return $pdf->download('labels.pdf');
    }


}
