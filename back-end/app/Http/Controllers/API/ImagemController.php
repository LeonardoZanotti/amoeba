<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use Illuminate\Support\Facades\Storage;
use App\Imagem;

class ImagemController extends BaseController
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|max:255', 
            'descricao' => 'required|max:500', 
            'imagem' => 'required|image', 
        ]);

        if($validator->fails()) {
            return $this->enviarRespostaErro('Campo incorreto', $validator->errors());
        }

        $caminho = Storage::putFile('imagens', $request->file('imagem'), 'public');

        $imagem = Imagem::Create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'caminho' => $caminho
        ]);

        return $this->enviarRespostaSucesso($imagem, 'Imagem criada com sucesso', 201);
    }


    public function show(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer'
        ]);

        if($validator->fails()) {
            return $this->enviarRespostaErro('Campo incorreto', $validator->errors());
        };

        $imagem = Imagem::find($request->id);
        if(!$imagem) {
            return $this->enviarRespostaErro('Imagem não encontrada', $validator->errors());
        }

        return $this::enviarRespostaSucesso($imagem, 'Imagem encontrada', 200);
    }


    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'titulo' => 'required|max:255',
            'descricao' => 'required|max:500',
            'imagem' => 'required|image'
        ]);

        if($validator->fails()) {
            return $this->enviarRespostaErro('Campo incorreto', $validator->errors());
        }

        $imagem = Imagem::find($request->id);
        if(!$imagem) {
            return $this->enviarRespostaErro('Imagem não encontrada', $validator->errors());
        }

        $disk = Storage::disk('local');
        $disk->delete($imagem->caminho);

        $caminho = Storage::putFile('imagens', $request->file('imagem'), 'public');
      
        $imagem->titulo = $request->titulo;
        $imagem->descricao = $request->descricao;
        $imagem->caminho = $caminho;
        $imagem->save();

        return $this->enviarRespostaSucesso($imagem, 'Imagem alterada com sucesso', 200);
    }


    public function destroy(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer'
        ]);

        if($validator->fails()) {
            return $this->enviarRespostaErro('Campo incorreto', $validator->errors());
        }

        $imagem = Imagem::find($request->id);
        if(!$imagem) {
            return $this->enviarRespostaErro('Imagem não encontrada', $validator->errors());
        }

        if($imagem->servicos()->first() /*|| $imagem->portfolios()->first() || $imagem->equipes()->first()*/) {
            return $this::enviarRespostaErro('Imagem está sendo utilizada');
        }

        $disk = Storage::disk('local');
        $disk->delete($imagem->caminho);

        $imagem->delete();

        return $this->enviarRespostaSucesso($imagem, 'Imagem deletada com sucesso', 200);
    }


    public function index() {
        $imagens = Imagem::all();
        return $this::enviarRespostaSucesso($imagens, 'Mostrando grupos cadastrados', 200);
    }
}