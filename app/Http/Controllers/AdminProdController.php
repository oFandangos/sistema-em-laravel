<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Produto;

class AdminProdController extends Controller
{
    public function index(Produto $produtos, User $users){
        $produtos = Produto::join('users','produtos.user_id','=','users.id')
        ->select('produtos.*', 'users.email')
        ->where('status','like','%em_analise%')
        ->get();

        $produtosReprov = Produto::join('users','produtos.user_id','=','users.id')
        ->select('produtos.*','users.email')
        ->where('status','like','%reprov%')
        ->get();

        return view('user.adm.produtos', [
            'produtos' => $produtos,
            'produtosReprov' => $produtosReprov,
            'users' => $users
        ]);
    }

    public function update(Request $request, Produto $produto){
        
        $produto->status = $request->status;
        $produto->save();
        request()->session()->flash('alert-success','produto aprovado');
        return redirect('/adm/prod-listar');
    }

    public function reprovar(Request $request, Produto $produto){
        $produto->status = $request->status;
        $produto->justificativa_reprovado = $request->justificativa_reprovado;
        $produto->save();
        request()->session()->flash('alert-warning','produto reprovado');
        return redirect('/adm/prod-listar');
    }

}
