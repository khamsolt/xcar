<?php


namespace App\Http\Requests\Helpers;


trait HasSort
{
    public function getSort(): ?string
    {
        return $this->get('sort', null);
    }
}
