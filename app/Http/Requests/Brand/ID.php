<?php

namespace App\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;

class ID extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:brands'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['id' => $this->route('brand')]);
    }
}
