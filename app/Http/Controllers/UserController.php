<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function index(Request $request, User $users){
        if(Gate::allows('create-user')){
            // $users = User::all();
            // return view('user.index', compact('users'));
            if(isset($request->search)){
                $users = User::where('name','LIKE','%'.$request->search.'%')->get();
                $usersCount = User::where('name','LIKE','%'.$request->search.'%')->count();
            }else{
                $users = User::all();
                $admins = User::where('is_admin',TRUE)->get();
                $usersCount = User::count();
            }
        // return view('user.index', compact('users', 'usersCount'));
        return view('user.index', ['users' => $users, 'usersCount' => $usersCount, 'admins' => $admins]);

        }else{
            request()->session()->flash('alert-danger','Usuário sem permissão');
            return redirect('/');
        }
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
        if($user->is_banned == false){
            $user->codpes = $request->codpes;
            $user->is_admin = $request->is_admin;
            $user->save();
            if($user->is_admin == true){
                request()->session()->flash('alert-success','Usuario cadastrado como admin');
                return redirect('/user');
            }else{
                request()->session()->flash('alert-warning',"Administrador do usuário ".$user->name." - ".$user->codpes." removido");
                return redirect('/user');
            }       
        }else{
            request()->session()->flash('alert-warning','Não é possível cadastrar um usuário banido como admin');
            return redirect('/user');
        }
    }

    public function banir(Request $request, User $user){

        if(Gate::allows('create-user')){
            return view('user.banir', ['user' => $user]);
        }else{
            request()->session()->flash('alert-danger','Usuário sem permissão');
            return redirect('/');
        }

    }

    #funcao para banir um usuario
    public function delete(UserRequest $request, User $user){
        $user = User::where('codpes', '=', $request->codpes)->first();
            $user->codpes = $request->codpes; //tirar o codpes para impedir o usuario de logar; mostrar mensagem de erro caso tente logar
            $user->justificativa = $request->justificativa;
            $user->is_banned = $request->is_banned;
            $user->is_admin = false;
            $user->save();
            if($request->is_banned == true){
                request()->session()->flash('alert-success','User banido');
                return redirect('/user');
            }else{
                request()->session()->flash('alert-success','User desbanido');
                return redirect('/user');
            }
        
            // request()->session()->flash('alert-warnin','desbaniu');
            // return redirect('/user');
        
            // request()->session()->flash('alert-warning','usuario ja banido');
            // return redirect('/user');
    }
}
