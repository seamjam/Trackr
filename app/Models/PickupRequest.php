<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupRequest extends Model
{
    use HasFactory;
    protected $table = 'pickup_requests';

    protected $fillable = [
        'date',
        'time',
        'status',
        'postal_code',
        'house_number',
    ];

    public function package()
    {
        return $this->hasOne(Package::class, 'pickupRequest_id');
    }


}
