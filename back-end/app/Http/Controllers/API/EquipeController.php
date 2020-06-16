<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Storage;
use App\Equipe;
use App\Imagem;

class EquipeController extends BaseController
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'imagem_id' => 'required|integer',
            'nome' => 'required|max:255',
            'cargo' => 'required|max:255',
            'descricao' => 'required|max:500',
            'twitter' => 'required|active_url',
            'facebook' => 'required|active_url',
            'instagram' => 'required|active_url',
            'linkedin' => 'required|active_url'
        ]);

        if($validator->fails()) {
            return $this->enviarRespostaErro('Campo incorreto', $validator->errors());
        }

        $imagem = Imagem::find($request->imagem_id);
        if(!$imagem) {
            return $this::enviarRespostaErro('Imagem não encontrada');
        }

        $equipe = Equipe::create([
            'imagem_id' => $request->imagem_id,
            'nome' => $request->nome,
            'cargo' => $request->cargo,
            'descricao' => $request->descricao,
            'twitter' => $request->twitter,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'linkedin' => $request->linkedin
        ]);

        $equipe->imagem()->associate($imagem)->save(); 

        return $this::enviarRespostaSucesso($equipe, 'Equipe criada com sucesso!', 201);
    }

    public function show(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer'
        ]);

        if($validator->fails()) {
            return $this::enviarRespostaErro('Campo incorreto', $validator->errors());
        }

        $equipe = Equipe::find($request->id);
        if(!$equipe) {
            return $this::enviarRespostaErro('Equipe não encontrada');
        }

        return $this::enviarRespostaSucesso($equipe, 'Equipe encontrada', 200);
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'imagem_id' => 'required|integer',
            'nome' => 'required|max:255',
            'cargo' => 'required|max:255',
            'descricao' => 'required|max:500',
            'twitter' => 'required|active_url',
            'facebook' => 'required|active_url',
            'instagram' => 'required|active_url',
            'linkedin' => 'required|active_url'
        ]);

        if($validator->fails()) {
            return $this::enviarRespostaErro('Erro de validação', $validator->errors());
        };

        $equipe = Equipe::find($request->id);
        if(!$equipe) {
            return $this::enviarRespostaErro('Nenhuma equipe foi encontrada');
        };

        $imagem = Imagem::find($request->imagem_id);
        if(!$imagem) {
            return $this::enviarRespostaErro('Imagem não encontrada');
        };

        $equipe->update($request->all());
        $equipe->imagem()->associate($imagem)->save();

        return $this::enviarRespostaSucesso($equipe, 'Equipe atualizada com sucesso!', 201);
    }

    public function destroy(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer'
        ]);

        if($validator->fails()) {
            return $this::enviarRespostaErro('Erro de validação', $validator->errors());
        };

        $equipe = Equipe::find($request->id);
        if(!$equipe) {
            return $this::enviarRespostaErro('Equipe não encontrada', null);
        };

        $equipe->delete();

        return $this::enviarRespostaSucesso(null, 'Equipe deletada com sucesso!', 200);
    }

    public function index() {
        $equipes = Equipe::all();
        return $this::enviarRespostaSucesso($equipes, 'Mostrando todas as equipes', 200);
    }
}
