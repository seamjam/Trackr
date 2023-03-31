<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class PickupDateRule implements Rule
{
    public function passes($attribute, $value)
    {
        $pickupDateTime = Carbon::createFromFormat('Y-m-d', $value);
        $now = Carbon::now();
        $diffInDays = $now->diffInDays($pickupDateTime, false);
        $currentHour = $now->hour;

        return ($diffInDays >= 2 ||$diffInDays >= 1 && $currentHour < 15);
    }

    public function message()
    {
        return 'The pickup date must be scheduled at least 2 days in advance before 15:00.';
    }
}
