<?php


namespace App\Http\Requests\Helpers;


trait HasPagination
{
    public function getLimit(): int
    {
        return (int)$this->get('limit', 20);
    }

    public function getOffset(): int
    {
        return (int)$this->get('offset', 0);
    }
}
