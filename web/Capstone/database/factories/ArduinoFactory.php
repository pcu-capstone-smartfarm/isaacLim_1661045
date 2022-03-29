<?php

namespace Database\Factories;

use App\Models\Arduino;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Arduino>
 */
class ArduinoFactory extends Factory
{
    /*
    * factory's model
    * @var string
    */
    protected $model = Arduino::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'humidity' => rand(0, 100),
            'temp' => rand(0, 100),
            'humidity_soil' => rand(0, 100),
            'illuminance' => rand(0, 100),
        ];
    }
}
