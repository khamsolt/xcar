<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Model;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::all()
            ->each(fn(Model $model) => Car::factory(rand(1, 5))
                ->make()
                ->each(fn(Car $car) => $car->model()
                    ->associate($model)
                    ->saveOrFail()));
    }
}
