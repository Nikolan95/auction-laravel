<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class MaximumBalanceRule implements Rule
{
    private $addedBalance;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($addedBalance)
    {
        $this->addedBalance = $addedBalance;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Auth::user()->balance + $this->addedBalance < 1000000;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '$1 000 000  is limit';
    }
}
