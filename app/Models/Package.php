<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{

    use HasFactory;

    protected $fillable = [
        'status_id',
        'tracking_number',
        'webshop_id',
        'post_company_id',
        'review_id',
        'pickupRequest_id',
        'receiver_firstname',
        'receiver_lastname',
        'receiver_postal_code',
        'receiver_house_number'
    ];

    public function pickupRequest(){
        return $this->belongsTo(PickupRequest::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function post_company()
    {
        return $this->belongsTo(Post_company::class);
    }

    public function review()
    {
        return $this->belongsTo(Review::class);
    }

    public function webshop()
    {
        return $this->belongsTo(Webshop::class);
    }
}
