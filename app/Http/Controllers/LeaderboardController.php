<?php

namespace App\Http\Controllers;

use App\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    public function index()
    {
        $topAverageScorePlayers = Player::TopPlayersByAverageScoreOrderedByScore(10, 10)->get();

        /*
         * TODO statistics
         * Below the leaderboard, statistics showing the current highest and lowest scores achieved,
         *  who scored them, against whom, and when.
         */

        return response()->json(['topAverageScorePlayers' => $topAverageScorePlayers], self::HTTP_STATUS_CODE_OK);
    }
}
