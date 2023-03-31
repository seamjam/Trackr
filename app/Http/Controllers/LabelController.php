<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Status;
use App\Models\Post_company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Csv\Reader;
use Picqer\Barcode\BarcodeGeneratorHTML;


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

    public function create()
    {
        $postCompanies = Post_company::all();

        return view('administrator.labels.create', [
            'post_companies' => $postCompanies,
        ]);
    }

    public function generatePDF(Request $request)
    {
        $selectedPackagesIds = explode(',', request('selectedPackages'));

        $selectedPackages = Package::whereIn('id', $selectedPackagesIds)->get();

        $pdf = app('dompdf.wrapper');
        $labelHTML = '';

        $generator = new BarcodeGeneratorHTML();

        foreach ($selectedPackages as $label) {
            $barcode = $generator->getBarcode($label->id, $generator::TYPE_CODE_128, 2, 50, 'black', true);

            $data = [
                'title' => $label->receiver_firstname . ' ' . $label->receiver_lastname,
                'date' => date('m/d/Y'),
                'label' => $label,
                'barcode' => $barcode
            ];

            $labelHTML .= view('administrator.labels.PDF', $data)->render();
        }
        $pdf->loadHTML($labelHTML);

        return $pdf->download('labels.pdf');
    }

    public function importCSV(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $csv_file = $request->file('csv_file');
        $csv = Reader::createFromPath($csv_file->path(), 'r');
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();

        foreach ($records as $record) {
            $cleanedRecord = [];

            foreach ($record as $key => $value) {
                $cleanedKey = trim(str_replace(';', '', $key));
                $cleanedValue = trim(str_replace(';', '', $value));
                $cleanedRecord[$cleanedKey] = $cleanedValue;
            }

            try {
                Package::create([
                    'status_id' => 1,
                    'tracking_number' => 'TN-' . uniqid(),
                    'webshop_id' => auth()->user()->webshop_id,
                    'post_company_id' => $cleanedRecord['post_company_id'],
                    'receiver_firstname' => $cleanedRecord['receiver_firstname'],
                    'receiver_lastname' => $cleanedRecord['receiver_lastname'],
                    'receiver_postal_code' => $cleanedRecord['receiver_postal_code'],
                    'receiver_house_number' => $cleanedRecord['receiver_house_number']
                ]);
            } catch (\Exception $e) {
                return redirect()->route('administrator.labels.show')->with('error', 'Labels were not noted correctly!');
            }
        }

        return redirect()->route('administrator.labels.show')->with('success', 'Labels imported successfully');
    }


}
