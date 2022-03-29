<?php

namespace App\Http\Requests;

use App\Rules\BidExpiredRule;
use App\Rules\CanAffordRule;
use App\Rules\HighestBidRule;
use Illuminate\Foundation\Http\FormRequest;

class AutoBidRequest extends FormRequest
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
            'max_value' => [
                'required',
                'numeric',
                'integer',
                new CanAffordRule,
                new HighestBidRule($this->product_id),
                new BidExpiredRule($this->product_id)
            ]
        ];
    }
}
