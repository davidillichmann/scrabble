<?php

namespace Tests\Feature;

use App\Game;
use App\Player;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class LeaderboardTest
 *
 * @package Tests\Feature
 */
class LeaderboardTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_top_player()
    {
        /** @var Player $player */
        $player = factory(Player::class)->create();

        factory(Game::class, 10)->create()->each(function ($game) use ($player) {
            $game->players()->attach(Player::all()->random(1)->add($player), ['score' => 1000]);
        });

        $response = $this->json('GET', 'api/leaderboard');

        $response->assertJsonFragment($player->jsonSerialize());
    }

    /**
     * Tests if newPlayer with 1 higher average score replaces 10th player of the leaderboard
     */
    public function test_last_average_player_is_replaced()
    {
        $lastAveragePlayer = Player::TopPlayersByAverageScoreOrderedByScore(10, 10)->get()->last();

        $newPlayer = factory(Player::class)->create();
        factory(Game::class, 10)->create()->each(function ($game) use ($newPlayer, $lastAveragePlayer) {
            $game->players()->attach(Player::all()->random(1), ['score' => $lastAveragePlayer->averageScore]);
            $game->players()->attach($newPlayer, ['score' => $lastAveragePlayer->averageScore + 1]);
        });

        $response = $this->json('GET', 'api/leaderboard');

        $response->assertJsonFragment($newPlayer->jsonSerialize());
    }

    /**
     * Tests if lastAverageScorePlayer from leaderboard remains in leaderboard after new player with 10 games is added
     */
    public function test_last_average_player_remains_in_top()
    {
        $lastAveragePlayer = Player::TopPlayersByAverageScoreOrderedByScore(10, 10)->get()->last();

        $newPlayer = factory(Player::class)->create();
        factory(Game::class, 10)->create()->each(function ($game) use ($newPlayer) {
            $game->players()->attach(Player::all()->random(1)->add($newPlayer), ['score' => 0]);
        });

        $response = $this->json('GET', 'api/leaderboard');

        $response->assertJsonFragment($lastAveragePlayer->jsonSerialize());
    }

    /**
     *
     */
    public function test_response()
    {
        $response = $this->json('GET', 'api/leaderboard');

        $response->assertOk()->assertJsonCount(10, 'topAverageScorePlayers');
    }
}
