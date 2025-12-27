<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'          => 'required|string|max:255|unique:properties,name',
            'category_id'   => 'required|exists:categories,id',
            'location'      => 'required|string|max:255',
            'price'         => 'required|numeric|min:0',
            'bedroom'       => 'required|integer|min:0',
            'bathroom'      => 'required|integer|min:0',
            'surface_area'  => 'required|string|min:0',
            'building_area' => 'required|string|min:0',
            'certificate'   => 'nullable|string|max:100',
            'description'   => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'Nama properti ini sudah terdaftar.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
            'price.numeric' => 'Harga harus berupa angka.',
        ];
    }
}
