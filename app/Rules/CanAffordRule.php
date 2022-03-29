<?php

namespace App\Rules;

use App\Models\AutoBid;
use App\Models\Bid;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CanAffordRule implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $sumAllUserActiveBids = Bid::where('user_id', Auth::id())->where('is_active', true)->sum('price');
        return Auth::user()->balance >= (int)$value + $sumAllUserActiveBids;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Sorry, you don't have enough money to place this bid";
    }
}
