<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Player
 *
 * @package App
 */
class Player extends Model
{

    protected $hidden = ['pivot'];

    /**
     * @var array
     */
    protected $fillable = ['name', 'phone_number', 'joined_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function games()
    {
        return $this->belongsToMany('App\Game')->withPivot('score');
    }

    /**
     * @return mixed
     */
    public function getTotalWinsAttribute()
    {
        return $this->games->filter(function (Game $game) {
            return $game->winner()->first()->id === $this->id;
        })->count();
    }

    /**
     * @return mixed
     */
    public function getTotalLossesAttribute()
    {
        return $this->games->filter(function (Game $game) {
            return $game->looser()->first()->id === $this->id;
        })->count();
    }

    /**
     * Scope a query to TOP (int)$limit players by average score having played (int)$games or more games.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int                                   $games
     * @param int                                   $limit
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTopPlayersByAverageScoreOrderedByScore($query, int $games, int $limit)
    {
        return $query
            ->selectRaw('`players`.*, AVG(`score`) as averageScore')
            ->rightJoin('game_player', 'game_player.player_id', '=', 'players.id')
            ->groupBy('game_player.player_id')
            ->orderByRaw('averageScore desc')
            ->havingRaw('count(game_id) >= ' . $games)
            ->limit($limit);
    }

    public function scopeHighestScoreGame()
    {
        return $this->games()
            ->orderBy('score', 'DESC')
            ->limit(1);
    }

    /**
     * @return mixed
     */
    public function getAverageScoreAttribute()
    {
        return $this->games()->average('score');
    }
}
