<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public function consoles() {
        return $this->belongsToMany(Console::class, 'game_consoles');
    }

    protected $fillable = [
        'name', 'description', 'maker', 'release_year', 'income', 'image'
    ];
}
