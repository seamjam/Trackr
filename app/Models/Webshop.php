<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webshop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'postcode',
        'house_number',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

}


