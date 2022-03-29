<?php

namespace App\Rules;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class BidExpiredRule implements Rule
{
    private Product $product;
    private string $validDate;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $productId)
    {
        $this->product = Product::findOrFail($productId);
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
        return !Carbon::parse($this->product->auction_ends)->isPast();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The auction has expired';
    }
}
