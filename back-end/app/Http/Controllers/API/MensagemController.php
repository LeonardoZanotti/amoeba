<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Storage;
use App\Mensagem;

class MensagemController extends BaseController
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',
            'email' => 'required|email',
            'assunto' => 'required',
            'mensagem' => 'required'
        ]);

        if($validator->fails())  
        {  
            return $this::enviarRespostaErro('Campo incorreto', $validator->errors());
        }

        $mensagem = Mensagem::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'assunto' => $request->assunto,
            'mensagem' => $request->mensagem
        ]);

        return $this::enviarRespostaSucesso($mensagem, 'Mensagem enviada com sucesso!', 201);
    }

    public function destroy(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer'
        ]);

        if($validator->fails()) {
            return $this::enviarRespostaErro('Erros de validação', $validator->errors());
        }

        $mensagem = Mensagem::find($request->id);
        if(!$mensagem) {
            return $this::enviarRespostaErro('Mensagem não encontrada');
        }

        $mensagem->delete();

        return $this::enviarRespostaSucesso(null, 'Mensagem apagada', 200);
    }

    public function busca(Request $request, $texto) {
        if(!$texto) {
            return $this::enviarRespostaErro('Nenhum texto passado como parâmetro');
        }
        
        $resultadosMensagens = Mensagem::orWhere('nome', 'like', '%'.$texto.'%')
        ->orWhere('email', 'like', '%'.$texto.'%')
        ->orWhere('assunto', 'like', '%'.$texto.'%')
        ->orWhere('mensagem', 'like', '%'.$texto.'%')
        ->get();

        if ($resultadosMensagens->count() == 0) {
            return $this::enviarRespostaErro('Nenhuma mensagem encontrada', null);
        }
        return $this::enviarRespostaSucesso($resultadosMensagens);
    }
    
    public function index() {
        $mensagens = Mensagem::all();
        return $this::enviarRespostaSucesso($mensagens, 'Mostrando todas as mensagens', 200);
    }
}
