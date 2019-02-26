<?php

namespace Tests\Feature;

use App\Player;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class PlayerControllerTest
 *
 * @package Tests\Feature
 */
class PlayerControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests if player was created correctly by POST api route.
     *
     */
    public function test_player_created_correctly()
    {
        $faker = \Faker\Factory::create();

        $lastPlayerId = Player::all()->last()->id;

        $name = $faker->name;
        $phoneNumber = $faker->phoneNumber;
        $joinedAt = $faker->date();

        $player = [
            'name' => $name,
            'phone_number' => $phoneNumber,
            'joined_at' => $joinedAt
        ];

        $response = $this->json('POST', '/api/players', $player);

        $response->assertStatus(201)
            ->assertJson([
                'id' => $lastPlayerId+1,
                'name' => $name,
                'phone_number' => $phoneNumber,
                'joined_at' => $joinedAt,
            ]);
    }
}
