<?php

namespace App\Http\Requests\Car;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class Create extends FormRequest
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
            'name' => 'required|string',
            'model' => 'required|integer|exists:models,id',
            'transmission' => 'required|string|in:mechanic,automatic',
            'license_plate' => 'string|nullable|uuid',
            'color' => 'required|string',
            'date_creation' => 'required|date',
            'rental_type' => 'required|integer|in:24',
            'rental_price' => 'required|integer|min:0',
            'status' => 'required|integer|in:0',
            'photo' => 'file|nullable|max:1024|dimensions:ratio:1/1|mimes:jpeg,jpg,png'
        ];
    }

    public function getFile(): UploadedFile
    {
        return $this->file('photo');
    }
}
