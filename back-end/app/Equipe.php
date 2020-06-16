<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Imagem;

class Equipe extends Model
{
    protected $fillable = [
        'imagem_id',
        'nome',
        'cargo',
        'descricao',
        'twitter',
        'facebook',
        'instagram',
        'linkedin'
    ];

    protected $with = ['imagem'];

    public function imagem() {
        return $this::belongsTo(Imagem::class);
    }
}
