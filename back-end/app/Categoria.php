<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Portfolio;

class Categoria extends Model
{
    protected $fillable = ['categoria'];

    // infelizmente não dá pra deixar isso aq pq se n vira um loop, mas categorias tava
    // bonitinho com isso
    //protected $with = ['portfolios']; 

    public function portfolios() {
        return $this::belongsToMany(Portfolio::class);
    }
}
