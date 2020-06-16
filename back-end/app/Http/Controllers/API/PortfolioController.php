<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use Illuminate\Support\Facades\Storage;
use App\Portfolio;
use App\Categoria;
use App\Imagem;

class PortfolioController extends BaseController
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'link' => 'required|active_url',
            'imagem_id' => 'required|integer',
            'categoria_id' => 'required|array'
        ]);

        if($validator->fails()) {
            return $this::enviarRespostaErro('Erros de validação', $validator->errors());
        }

        $imagem = Imagem::find($request->imagem_id);
        if(!$imagem) {
            return $this::enviarRespostaErro('Imagem não encontrada');
        }
        
        foreach($request->categoria_id as $categoria_id) 
        {
            $categoria = Categoria::find($categoria_id);
            if(!$categoria) 
            {
                return $this::enviarRespostaErro('Categoria não encontrada');
            }
        }
        
        $portfolio = new Portfolio;
        $portfolio->link = $request->link;
        $portfolio->imagem()->associate($imagem)->save();   // 1:N
        $portfolio->categorias()->attach($request->categoria_id);    // N:N
        $portfolio->save();
        $portfolio = Portfolio::find($portfolio->id);
        
        return $this::enviarRespostaSucesso($portfolio, 'Portfólio criado com sucesso', 201);
    }
    
    public function show(Request $request) {
        $validator = Validator::make($request->all(), [
            'portfolio_id' => 'required|integer'
        ]);

        if($validator->fails()) {
            return $this::enviarRespostaErro('Erros de validação', $validator->fails());
        }

        $portfolio = Portfolio::find($request->portfolio_id);
        if(!$portfolio) {
            return $this::enviarRespostaErro('Nenhum portfólio encontrado');
        }

        return $this::enviarRespostaSucesso($portfolio, 'Mostrando o portfólio', 200);
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'imagem_id' => 'required|integer',
            'categoria_id' => 'required|array',
            'link' => 'required|max:255'
        ]);

        if($validator->fails()) {
            return $this::enviarRespostaErro('Erros de validação', $validator->errors());
        }
        
        $portfolio = Portfolio::find($request->id);
        $imagem = Imagem::find($request->imagem_id);
        if(!$portfolio || !$imagem) {
            return $this::enviarRespostaErro('Portfólio ou imagem não encontrada');
        }

        foreach($request->categoria_id as $categoria_id) {
            $categoria = Categoria::find($categoria_id);
            if(!$categoria) {
                return $this::enviarRespostaErro('Categoria não encontrada');
            }
        }

        $portfolio->update($request->all());
        $portfolio->imagem()->associate($imagem)->save();
        $portfolio->categorias()->sync($request->categoria_id);
        $portfolio = Portfolio::find($request->id);

        return $this::enviarRespostaSucesso($portfolio, 'Portfólio atualizado com sucesso', 200);
    }

    public function removeCategoria(Request $request){
        $validator = Validator::make ($request->all(),[
            'portfolio_id' => 'required|integer',
            'categoria_id' => 'required|integer'
        ]);

        if ($validator->fails()){
            return $this::enviarRespostaErro('Erros de validação', $validator->errors());
        }

        $categoria = Categoria::find($request->categoria_id);
        $portfolio = Portfolio::find($request->portfolio_id);
        if(!$categoria || !$portfolio) {
            return $this::enviarRespostaErro('Categoria ou portfólio não encontrado', null);
        }
        
        if(!$portfolio->categorias->find($request->categoria_id)) {
            return $this::enviarRespostaErro('O portfólio não possui esta categoria');
        }

        $portfolio->categorias()->detach($categoria);
        $portfolio = Portfolio::find($request->portfolio_id);
        
        return $this::enviarRespostaSucesso($portfolio, 'Categoria não está mais relacionado ao portfólio', 200);
    }
    
    public function destroy(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',  
        ]);
        if ($validator->fails()){
            return $this::enviarRespostaErro('Erros de validação', $validator->errors());
        };

        $portfolio = Portfolio::find($request->id);
        if(!$portfolio){
            return $this::eviarRespostaErro('Portfólio não encontrado', null);
        };

        $portfolio->categorias()->detach();
        $portfolio->delete();

        return $this::enviarRespostaSucesso(null, 'Portfólio deletado com sucesso!', 200);
    }
    
    public function index()  
    {
        $portfolios = Portfolio::all();
        return $this::enviarRespostaSucesso($portfolios, 'Portfólios existentes', 200);
    }
}
