<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Imagem;

class Servico extends Model
{
    protected $fillable = ['titulo', 'descricao', 'imagem_id'];

    // com esse $with, a requisição vai retornar as informações da imagem também, não só
    // o $fillable (sem isso, no método store até é mostrado os dados da imagem,
    // mas no show e no index não)
    protected $with = ['imagem'];

    public function imagem() {
        return $this->belongsTo(Imagem::class);
    }
}
