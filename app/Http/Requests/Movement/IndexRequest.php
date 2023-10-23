<?php

namespace App\Http\Requests\Movement;

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
            'product_id' => 'integer',
            'warehouse_id' => 'integer',
            'status' => 'string',
            'paginate' => 'integer',
            'created_at' => '',
            'updated_at' => '',
        ];
    }

//    protected function failedValidation(Validator $validator)
//    {
//        throw (new \Illuminate\Validation\ValidationException($validator))->errorBag($this->errorBag)->status(Response::HTTP_FORBIDDEN);
//    }
}
