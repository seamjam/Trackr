<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\Package;

class ReviewController extends Controller
{
    public function show(Request $request){
        $webshopId = auth()->user()->webshop_id;
        $search = $request->input('search', '');

        $packages = Package::with('review')
            ->where('webshop_id', $webshopId)
            ->where(function ($query) use ($search) {
                $query->where('receiver_firstname', 'like', '%' . $search . '%')
                    ->orWhere('receiver_lastname', 'like', '%' . $search . '%')
                    ->orWhereHas('review', function ($query) use ($search) {
                        $query->where('description', 'like', '%' . $search . '%');
                    });
            })
            ->paginate(10);

        return view('webshop.reviews.show', ['packages' => $packages]);
    }



}
