<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{

use AuthenticatesUsers;
    
    protected $redirectTo = '/';
    
    public function username(){

        //pegando o codpes do formulario via POST
        $cod = $_POST['codpes'];
        $user = User::where('codpes','=', $cod)->select('name')->first(); //selecionando o nome do usuário cujo codpes é igual ao inserido no formulário
        $items = explode(" ", $user->name); //metodo explode: está a separar o nome por espaços.
        $firstName = $items[0]; //pegando o primeiro item: o primeiro nome
        if($user != false){
        request()->session()->flash("alert-success","Bem-vindo, $firstName.");
    
        }
    return 'codpes';
    }

    public function index(User $users){
        return view('auth.login', ['users' => $users]);
    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }
}
