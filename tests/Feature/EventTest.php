<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Create an event.
     *
     * @return void
     */
    public function testCreateExample()
    {
        User::factory()->create();

        $title = $this->faker->words(3, true) . ' ' . $this->faker->emoji;

        $response = $this->postJson(
            '/api/events',
            ['name' => $title]
        );

        $response
            ->assertStatus(201)
            ->assertJsonFragment(['name' => $title]);
    }
}
