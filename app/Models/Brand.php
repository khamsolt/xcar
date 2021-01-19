<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as ModelBase;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends ModelBase
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status'
    ];

    public function models(): HasMany
    {
        return $this->hasMany(Model::class);
    }
}
