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
            'product_id' => 'nullable|integer',
            'warehouse_id' => 'nullable|integer',
            'status' => 'nullable|string',
            'paginate' => 'nullable|integer',
            'created_at' => '',
            'updated_at' => '',
            'page' => 'required|integer',
            'date' => 'nullable|string',
        ];
    }

}
