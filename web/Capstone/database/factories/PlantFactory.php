<?php

namespace Database\Factories;

use App\Models\Plant;
use App\Models\Serial;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plant>
 */
class PlantFactory extends Factory
{
    /*
    * factory's model
    * @var string
    */
    protected $model = Plant::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'serial_id' => Serial::factory(),
            'plantname' => $this->faker->userName(),
            'cropsCode' => Str::random(10),
            'device_verification' => null
        ];
    }
}
