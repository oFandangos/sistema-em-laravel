<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Category;
use App\Models\User;
use App\Http\Requests\ProdutoRequest;
use App\Http\Requests\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ProdutoController extends Controller
{
    public function show(Produto $produto){
        $autor = Auth::user();

        $user = User::where('id','=', $produto->user_id)
        ->select('users.email')
        ->first();

        return view('prod.show', ['produto' => $produto, 'autor' => $autor, 'user' => $user]);
    }
        
    public function create(Produto $produto, Category $categories, User $users){
        $userId = Auth::id();

        if(Gate::allows('create', $produto)){
            return view('prod.create')->with(['produto' => $produto, 'categories' => $categories, 'users' => $users, 'userId' => $userId]);
        }else{
            request()->session()->flash('alert-danger','Usuário sem permissão. Logue-se para poder cadastrar um produto');
            return redirect('/');
        };
    }

    public function store(ProdutoRequest $request, Produto $produto, Category $category, User $user){
        $produto = new Produto;
        $produto->nome_prod = $request->nome_prod;
        $produto->valor_prod = $request->valor_prod;
        $produto->category_id = $request->category_id;
        $produto->user_id = $request->user_id;
        $produto->save();
        request()->session()->flash('alert-success','Produto Cadastrado com sucesso! Esperando análise administrativa.');
        return redirect("/produto/show/{$produto->id}");
    }

    public function edit(Produto $produto, User $user, Category $categories){
        $userAll = Auth::user();

        if(Gate::allows('edit', $produto)){

        return view('prod.edit', ['produto' => $produto, 'categories' => $categories, 'userAll' => $userAll]);

        }else{
            request()->session()->flash('alert-danger','Usuário sem permissão');
            return redirect('/');
        }
    }

    public function update(ProdutoRequest $request, Produto $produto){
        $produto->nome_prod = $request->nome_prod;
        $produto->valor_prod = $request->valor_prod;
        $produto->category_id = $request->category_id;
        $produto->save();
        request()->session()->flash('alert-success','Produto alterado com sucesso!');
        return redirect("/produto/show/{$produto->id}");
    }

    public function destroy(Produto $produto){
        $produto->delete();
        request()->session()->flash('alert-success','Produto excluído!');
        return redirect("/");
    }
}
