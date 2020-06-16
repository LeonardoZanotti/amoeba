<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use Illuminate\Support\Facades\Storage;
use App\Servico;
use App\Imagem;

class ServicoController extends BaseController
{
    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'titulo' => 'required|max:255',
            'descricao' => 'required|max:500',
            'imagem_id' => 'required|integer'
        ]);

        if ($validator->fails()){
            return $this::enviarRespostaErro('Campo incorreto', $validator->errors());
        };

        // importante deixar isso antes do Servico::create
        // se não o mysql dá erro por tentar criar linha (imagem_id) com a chave
        // estrangeira na tabela filha que não referencia nada (id) da tabela pai 
        $imagem = Imagem::find($request->imagem_id);
        if(!$imagem) {
            return $this::enviarRespostaErro('Imagem não encontrada');
        }

        $servico = Servico::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'imagem_id' => $request->imagem_id
        ]);

        $servico->imagem()->associate($imagem)->save();
        
        return $this::enviarRespostaSucesso($servico, 'Serviço criado com sucesso', 201);
    }

    public function show(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer'
        ]);

        if($validator->fails()) {
            return $this::enviarRespostaErro('Erro de validação', $validator->errors());
        }

        $servico = Servico::find($request->id);
        if(!$servico) {
            return $this::enviarRespostaErro('Serviço não encontrado');
        }

        return $this::enviarRespostaSucesso($servico, 'Serviço encontrado', 200);
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'titulo' => 'required|max:255',
            'descricao' => 'required|max:500',
            'imagem_id' => 'required|integer'
        ]);

        if($validator->fails()) {
            return $this::enviarRespostaErro('Erro de validação', $validator->errors());
        }

        $servico = Servico::find($request->id);
        if(!$servico) {
            return $this::enviarRespostaErro('Nenhum serviço foi encontrado');
        }

        $imagem = Imagem::find($request->imagem_id);
        if(!$imagem) {
            return $this::enviarRespostaErro('Imagem não encontrada');
        }

        $servico->update($request->all());
        $servico->imagem()->associate($imagem)->save();

        return $this::enviarRespostaSucesso($servico, 'Serviço atualizado com sucesso', 201);
        
    }

    public function destroy(Request $request) {

        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);
        if ($validator->fails()){
            return $this::enviarRespostaErro('Erro de validação', $validator->errors());
        };

        $servico = Servico::find($request->id);
        if (!$servico){
            return $this::enviarRespostaErro('Serviço não encontrado', null); 
        };
        
        $servico->delete();

        return $this::enviarRespostaSucesso(null, 'Serviço deletado com sucesso', 200);  
    }
    
    public function index() {
        $servicos = Servico::all();
        return $this::enviarRespostaSucesso($servicos, 'Mostrando todos os serviços', 200);
    }
}