<?php

namespace App\View\Components\Input;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Select extends Component
{
    public Collection $collection;
    public ?string $name;
    public ?int $id;

    public function __construct(Collection $collection, ?string $name, ?int $id)
    {
        $this->collection = $collection;
        $this->name = $name;
        $this->id = $id;
    }

    public function render(): View
    {
        return view('components.input.select');
    }
}
