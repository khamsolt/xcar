<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::factory()->make();
        $admin->name = 'khamsolt';
        $admin->email = 'khamsolt@xcar.lo';
        $admin->saveOrFail();
        User::factory(1000)->create();
    }
}
