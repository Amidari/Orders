<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
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
            'customer' => 'nullable|string',
            'warehouse_id' => 'nullable|integer',
            'status' => 'nullable|string',
            'paginate' => 'nullable|integer',
            'page' => 'required|integer',
        ];
    }

//    protected function failedValidation(Validator $validator)
//    {
//        throw (new \Illuminate\Validation\ValidationException($validator))->errorBag($this->errorBag)->status(Response::HTTP_FORBIDDEN);
//    }
}
