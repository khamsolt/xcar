<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Model;
use Illuminate\Database\Seeder;

class ModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::latest()->get()->each(
            fn(Brand $brand) => Model::factory(rand(3, 5))->make()->each(
                fn(Model $model) => $model->brand()->associate($brand)->saveOrFail()
            )
        );
    }
}
