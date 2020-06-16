<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use Illuminate\Support\Facades\Storage;
use App\Categoria;

class CategoriaController extends BaseController
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'categoria' => 'required|max:255'
        ]);
        
        if ($validator->fails()){
            return $this::enviarRespostaErro('Erro de Validação', $validator->errors());      
        };

        $categoria = Categoria::create([
            'categoria' => $request->categoria
        ]);

        $categoria->save();

        return $this::enviarRespostaSucesso($categoria, 'Categoria criada com sucesso!', 201);
    }

    public function show(Request $request) {
        $validator = Validator::make($request->all(), [
           'id' => 'required|integer',
        ]);

        if($validator->fails()) {
            return $this::enviarRespostaErro('Erros de Validação', $validator->errors());
        }
        
        $categoria = Categoria::find($request->id);
        if(!$categoria) {
            return $this::enviarRespostaErro('Categoria não encontrada');
        }

        return $this::enviarRespostaSucesso($categoria, 'Mostrando a categoria', 200);
    }
    
    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
           'id' => 'required|integer',
           'categoria' => 'required|max:255'
        ]);

        if($validator->fails()) {
            return $this::enviarRespostaErro('Erros de Validação', $validator->errors());
        }
        
        $categoria = Categoria::find($request->id);
        if(!$categoria) {
            return $this::enviarRespostaErro('Categoria não encontrada');
        }

        $categoria->update($request->all());
        $categoria->save();

        return $this::enviarRespostaSucesso($categoria, 'Categoria atualizada com sucesso', 200);
    }
    
    public function destroy(Request $request) {
        $validator = Validator::make ($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this::enviarRespostaErro('Erros de validação', $validator->errors());  
        };

        $categoria = Categoria::find($request->id);
        if(!$categoria){
            return $this::enviarRespostaErro('Categoria não encontrada', null);
        };

        if($categoria->portfolios()->first()) {
            return $this::enviarRespostaErro('Categoria está sendo utilizada');
        }

        $categoria->delete();
        return $this::enviarRespostaSucesso(null, 'Categoria deletada com sucesso!', 200);
    }
    
    public function index() {
        $categorias = Categoria::all();
        return $this::enviarRespostaSucesso($categorias, 'Categorias cadastradas', 200);
    }
}

