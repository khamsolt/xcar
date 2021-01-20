<?php

namespace App\Http\Requests\Car;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'           => 'string',
            'model'          => 'integer|exists:models,id',
            'transmission'   => 'string|in:mechanic,automatic',
            'license_plate'  => 'string|uuid',
            'color'          => 'string',
            'date_creation'  => 'date',
            'rental_type'    => 'integer|in:24',
            'rental_price'   => 'integer|min:0',
            'status'         => 'integer|in:0'
        ];
    }
}
