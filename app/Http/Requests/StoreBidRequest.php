<?php

namespace App\Http\Requests;

use App\Rules\BidExpiredRule;
use App\Rules\CanAffordRule;
use App\Rules\HighestBidRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBidRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => 'required',
            'price' => [
                'required',
                'numeric',
                'integer',
                new HighestBidRule($this->product_id),
                new CanAffordRule,
                new BidExpiredRule($this->product_id)
            ]
        ];
    }
}
