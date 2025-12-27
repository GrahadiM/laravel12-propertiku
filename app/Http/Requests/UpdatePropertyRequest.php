<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePropertyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Mengambil ID properti saat ini agar validasi unique tidak bentrok dengan dirinya sendiri
        $propertyId = $this->route('property')->id;

        return [
            'name'          => 'required|string|max:255|unique:properties,name,' . $propertyId,
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
}
