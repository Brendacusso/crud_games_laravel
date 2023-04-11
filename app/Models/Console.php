<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Console extends Model
{
    use HasFactory;

    public function games(){
        return $this->belongsToMany(Game::class, 'game_consoles');
    }

    protected $fillable = [
        'name', 'maker'
    ];
}
