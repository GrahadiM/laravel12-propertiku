<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTravelPackageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255|unique:travel_packages,name,' . $this->route('travel_package')->id,
            'duration' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
            'name.required' => 'Nama paket wajib diisi.',
            'name.unique' => 'Nama paket sudah digunakan.',
            'duration.required' => 'Durasi wajib diisi.',
            'location.required' => 'Lokasi wajib diisi.',
            'description.required' => 'Deskripsi wajib diisi.',
            'price.required' => 'Harga wajib diisi.',
            'price.integer' => 'Harga harus berupa angka.',
            'price.min' => 'Harga tidak boleh negatif.',
        ];
    }
}
