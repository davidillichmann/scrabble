<?php

use Illuminate\Database\Seeder;

class PlayersWithGamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        factory(\App\Player::class, 100)->create();

        factory(\App\Game::class, 1000)->create()->each(function ($game) use ($faker) {
            $game->players()->attach(\App\Player::all()->random(2), ['score' => $faker->numberBetween(0, 999)]);
        });
    }
}
