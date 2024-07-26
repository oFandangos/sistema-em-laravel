<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function index(User $users){

        $users = User::all();

        return view('user.index', compact('users'));
    }

    //formulario de cadastro
    public function edit(Request $request, User $user){
        if(Gate::allows('create-user')){
            return view ('user.create', ['user' => $user]);
        }else{
            request()->session()->flash('alert-danger','Usuário sem permissão');
            return redirect('/');
        }
    }

    //atualização de adm
    public function update(UserRequest $request, User $user){

        $user = User::where('codpes', '=', $request->codpes)->first();
        $user->codpes = $request->codpes;
        $user->is_admin = true;
        $user->save();
        request()->session()->flash('alert-success','Usuário alterado com sucesso');
        return redirect('/user');
    }

    public function banir(Request $request, User $user){

        if(Gate::allows('create-user')){
            return view('user.banir', ['user' => $user]);
        }else{
            request()->session()->flash('alert-danger','Usuário sem permissão');
            return redirect('/');
        }

    }

    public function delete(UserRequest $request, User $user){
        $user = User::where('codpes', '=', $request->codpes)->first();
        $user->codpes = $request->codpes; //tirar o codpes para impedir o usuario de logar; mostrar mensagem de erro caso tente logar
        $user->justificativa = $request->justificativa;
        $user->is_banned = true;
        $user->is_admin = false;
        $user->save();
        return redirect('/user');
    }
}
