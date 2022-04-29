<?php

namespace Database\Factories;

use App\Models\Serial;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Serial>
 */
class SerialFactory extends Factory
{
    /*
    * factory's model
    * @var string
    */
    protected $model = Serial::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => Str::random(20)
        ];
    }
}
