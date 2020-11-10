<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\EventDate;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventDateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EventDate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'starts_at' => $this->faker->dateTime(),
            'event_id' => Event::factory(),
        ];
    }
}
