<?php

namespace App\Rules;

use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Gate;


class HighestBidRule implements Rule
{
    private Product $product;
    private int $currentMaxBid;
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
        $this->currentMaxBid = $this->product->bids()->max('price') ?? $this->product->start_price - 1;
        return (int)$value > $this->currentMaxBid;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The bid must be greater than $this->currentMaxBid";
    }
}
