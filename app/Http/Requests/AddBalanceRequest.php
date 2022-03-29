<?php

namespace App\Http\Requests;

use App\Rules\MaximumBalanceRule;
use Illuminate\Foundation\Http\FormRequest;

class AddBalanceRequest extends FormRequest
{
    public $validator = null;

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $this->validator = $validator;
    }
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
            'balance' => [
                'required',
                'numeric',
                'integer',
                'min:1',
                new MaximumBalanceRule($this->balance)
            ],
        ];
    }
}
