<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Sem Autenticação
// Route::post('login', 'API\AuthController@login')->name('login');
// Route::post('registro', 'API\AuthController@registro')->name('registro');
// Route::get('users', 'API\UserController@index');

Route::get('arquivos/{arquivo}', 'ArquivoController@show');

// Autenticação
// Route::middleware(['auth:api'])->group(function () {

    Route::get('meu-perfil', 'API\AuthController@meuPerfil')->name('perfil');

    Route::apiResource('arquivos', 'ArquivoController')->except([
        'show'
    ]);

    // Crud de imagens
    Route::post('achaImagem', 'API\ImagemController@show');
    Route::get('todasImagem', 'API\ImagemController@index');

    // Crud de serviços
    Route::post('achaServico', 'API\ServicoController@show');
    Route::get('todosServico', 'API\ServicoController@index');

    // Crud de categorias
    Route::post('mostraCategoria', 'API\CategoriaController@show');
    Route::get('todasCategoria', 'API\CategoriaController@index');

    // Crud de portfólios
    Route::post('achaPortfolio', 'API\PortfolioController@show');
    Route::get('todosPortfolio', 'API\PortfolioController@index');

    // Crud de contatos
    Route::post('achaContato', 'API\ContatoController@show');
    Route::get('todosContato', 'API\ContatoController@index');

    // Crud de equipes
    Route::post('achaEquipe', 'API\EquipeController@show');
    Route::get('todasEquipe', 'API\EquipeController@index');

    // Módulo de mensagens
    Route::post('novaMensagem', 'API\MensagemController@store');

    // Apenas para admin
    // Route::middleware(['admin'])->group(function () {
        // Crud de imagens
        Route::post('novaImagem', 'API\ImagemController@store');
        Route::post('mudaImagem', 'API\ImagemController@update');
        Route::post('apagaImagem', 'API\ImagemController@destroy');

        // Crud de serviços
        Route::post('novoServico', 'API\ServicoController@store');
        Route::post('mudaServico', 'API\ServicoController@update');
        Route::post('apagaServico', 'API\ServicoController@destroy');

        // Crud de categorias
        Route::post('mudaCategoria', 'API\CategoriaController@update');
        Route::post('novaCategoria', 'API\CategoriaController@store');
        Route::post('apagaCategoria', 'API\CategoriaController@destroy');

        // Crud de portfólios
        Route::post('novoPortfolio', 'API\PortfolioController@store');
        Route::post('mudaPortfolio', 'API\PortfolioController@update');
        Route::post('removeCategoria', 'API\PortfolioController@removeCategoria');
        Route::post('apagaPortfolio', 'API\PortfolioController@destroy');

        // Crud de contatos
        Route::post('novoContato', 'API\ContatoController@store');
        Route::post('mudaContato', 'API\ContatoController@update');
        Route::post('apagaContato', 'API\ContatoController@destroy');

        // Crud de equipes
        Route::post('novaEquipe', 'API\EquipeController@store');
        Route::post('mudaEquipe', 'API\EquipeController@update');
        Route::post('apagaEquipe', 'API\EquipeController@destroy');

        // Módulo de mensagens
        Route::post('apagaMensagem', 'API\MensagemController@destroy');
        Route::get('buscaMensagem/{texto}', 'API\MensagemController@busca');
        Route::get('todasMensagem', 'API\MensagemController@index');
    // });
// });