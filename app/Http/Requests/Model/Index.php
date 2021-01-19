<?php

namespace App\Http\Requests\Model;

use App\Http\Requests\Helpers\HasFilters;
use App\Http\Requests\Helpers\HasPagination;
use App\Http\Requests\Helpers\HasSort;
use Illuminate\Foundation\Http\FormRequest;

class Index extends FormRequest
{
    use HasFilters, HasSort, HasPagination;

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
            'sort' => 'string',
            'limit' => 'integer|in:10,30,50,100',
            'offset' => 'integer',
            'filters' => 'string',
            'name' => 'string',
            'brand' => 'string',
            'status' => 'integer',
            'created_at' => 'date'
        ];
    }
}
