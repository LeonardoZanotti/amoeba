<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Storage;
use App\Contato;

class ContatoController extends BaseController
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'endereco' => 'required',
            'email' => 'required|email',
            'telefone' => 'required'
        ]);
        
        if ($validator->fails()){
            return $this::enviarRespostaErro('Campo Incorreto', $validator->errors());      
        };

        $contato = Contato::create([
            'endereco' => $request->endereco,
            'email' => $request->email,
            'telefone' => $request->telefone
        ]);

        $contato->save();

        return $this::enviarRespostaSucesso($contato, 'Contato criado com sucesso!', 201);
    }

    public function show(Request $request) {
        $validator = Validator::make($request->all(), [
           'id' => 'required|integer',
        ]);

        if($validator->fails()) {
            return $this::enviarRespostaErro('Erros de Validação', $validator->errors());
        }
        
        $contato = Contato::find($request->id);
        if(!$contato) {
            return $this::enviarRespostaErro('Contato não encontrado');
        }

        return $this::enviarRespostaSucesso($contato, 'Mostrando o contato', 200);
    }
    
    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
           'id' => 'required|integer',
           'endereco' => 'required',
           'email' => 'required|email',
           'telefone' => 'required'
        ]);

        if($validator->fails()) {
            return $this::enviarRespostaErro('Erros de Validação', $validator->errors());
        }
        
        $contato = Contato::find($request->id);
        if(!$contato) {
            return $this::enviarRespostaErro('Contato não encontrado');
        }

        $contato->update($request->all());
        $contato->save();

        return $this::enviarRespostaSucesso($contato, 'Contato atualizado com sucesso', 200);
    }
    
    public function destroy(Request $request) {
        $validator = Validator::make ($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this::enviarRespostaErro('Campo incorreto', $validator->errors());  
        };

        $contato = Contato::find($request->id);
        if(!$contato){
            return $this::enviarRespostaErro('Contato não encontrado', null);
        };

        $contato->delete();
        return $this::enviarRespostaSucesso(null, 'Contato deletado com sucesso!', 200);
    }
    
    public function index() {
        $contatos = Contato::all();
        return $this::enviarRespostaSucesso($contatos, 'Contatos cadastrados', 200);
    }
}
