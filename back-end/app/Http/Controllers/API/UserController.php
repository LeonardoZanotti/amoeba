<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\User;

class UserController extends BaseController
{
    public function index() {
        $users = User::all();
        return $this::enviarRespostaSucesso($users, 'Mostrando usuários', 200);
    }
}
