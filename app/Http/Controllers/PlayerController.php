<?php

namespace App\Http\Controllers;

use App\Game;
use App\Player;
use Illuminate\Http\Request;

/**
 * Class PlayerController
 *
 * @package App\Http\Controllers
 */
class PlayerController extends Controller
{
    /**
     * @return \App\Player[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Player::all();
    }

    /**
     * @param \App\Player $player
     *      injecting Player instance in method
     *
     * @return mixed
     */
    public function show(Player $player)
    {
        $highestScoreGame = $player->highestScoreGame()->select(['score', 'games.date', 'location'])->first();
        return response()->json([
            'totalWins' => $player->totalWins,
            'totalLosses' => $player->totalLosses,
            'averageScore' => $player->averageScore,
            'highestScore' => [
                'score' => $highestScoreGame->score,
                'date' => $highestScoreGame->date,
                'location' => $highestScoreGame->location,
                'enemy' => $player->highestScoreGame()->first()->getEnemyByPlayerId($player->id)->first(),
            ]
        ], self::HTTP_STATUS_CODE_OK);
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) //TODO  - validate input
    {
        $player = Player::create($request->all());

        return response()->json($player, self::HTTP_STATUS_CODE_CREATED);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Player              $player
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Player $player) //TODO  - validate input
    {
        $player->update($request->all());

        return response()->json($player, self::HTTP_STATUS_CODE_OK);
    }

    /**
     * @param \App\Player $player
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Player $player)
    {
        $player->delete();

        return response()->json(null, self::HTTP_STATUS_CODE_NO_CONTENT);
    }
}
