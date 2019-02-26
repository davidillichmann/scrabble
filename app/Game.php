<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Game
 *
 * @package App
 */
class Game extends Model
{
    protected $hidden = ['pivot'];

    /**
     * @var array
     */
    protected $fillable = ['location', 'date'];

    /**
     * Players that belongs to game
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function players()
    {
        return $this->belongsToMany('App\Player')->withPivot('score');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function scopeWinner()
    {
        return $this->players()
            ->where('game_id', '=', $this->id)
            ->orderBy('score', 'DESC')
            ->limit(1);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function scopeLooser()
    {
        return $this->players()
            ->where('game_id', '=', $this->id)
            ->orderBy('score', 'ASC')
            ->limit(1);
    }

    public function getEnemyByPlayerId($playerId)
    {
        return $this->players()
            ->where('game_id', '=', $this->id)
            ->where('player_id', '!=', $playerId)
            ->limit(1);
    }

}
