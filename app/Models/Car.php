<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Car extends \Illuminate\Database\Eloquent\Model
{
    use HasFactory;

    protected $fillable = [
        'model_id',
        'name',
        'transmission',
        'license_plate',
        'color',
        'rental_type',
        'status',
    ];

    protected $casts = [
        'date_creation' => 'date',
    ];

    public function model(): BelongsTo
    {
        return $this->belongsTo(Model::class);
    }

    public function setDateCreation(string $value): void
    {
        $this->date_creation = Carbon::make($value)->format('Y-m-d');
    }

    public function getDateCreation(): string
    {
        return $this->date_creation->format('d.m.Y');
    }

    public function setRentalPrice(int $value): void
    {
        $this->rental_price = $value * 100;
    }

    public function getRentalPrice(): float
    {
        return $this->rental_price / 100;
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y H:i:s');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y H:i:s');
    }
}
