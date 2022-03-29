<?php

namespace Database\Seeders;

use App\Models\Arduino;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArduinoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->has(
            Arduino::factory()->count(10)->state(
                function (array $attributes, User $user) {
                    return ['user_id'=>$user->id];
                }
            ),
            'arduinos'
        )->create();
    }
}
