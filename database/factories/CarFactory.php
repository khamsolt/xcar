<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Car::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'transmission' => $this->faker->randomElement(['mechanic', 'automatic']),
            'license_plate' => $this->faker->uuid,
            'color' => $this->faker->colorName,
            'date_creation' => $this->faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d'),
            'rental_price' => $this->faker->numberBetween(500, 10000)
        ];
    }
}
