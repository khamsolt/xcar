<?php


namespace App\Http\Requests\Helpers;


use Illuminate\Support\Arr;

trait HasFilters
{
    public function getFilters(array $except = ['limit', 'offset', 'sort']): array
    {
        return Arr::except($this->validated(), $except);
    }
}
