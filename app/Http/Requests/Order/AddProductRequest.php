<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'order_id' => 'required|integer',
            'product_id' => 'required|integer',
            'count' => 'required|integer',
            'warehouse_id' => 'required|integer',
        ];
    }

//    protected function failedValidation(Validator $validator)
//    {
//        throw (new \Illuminate\Validation\ValidationException($validator))->errorBag($this->errorBag)->status(Response::HTTP_FORBIDDEN);
//    }
}
