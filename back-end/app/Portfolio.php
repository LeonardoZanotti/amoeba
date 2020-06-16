<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Categoria;
use App\Imagem;

class Portfolio extends Model
{
    protected $fillable = ['link', 'imagem_id'];

    // com esse $with, a requisição vai retornar as informações da imagem também, não só
    // o $fillable (sem isso, no método store até é mostrado os dados da imagem,
    // mas no show e no index não)
    protected $with = ['imagem', 'categorias'];

    public function imagem() {
        return $this::belongsTo(Imagem::class);
    }

    public function categorias() {
        return $this::belongsToMany(Categoria::class);
    }
}
