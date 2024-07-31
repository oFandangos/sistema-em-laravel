<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Category;
use App\Models\User;
use App\Models\Aviso;

class IndexController extends Controller
{
    public function index(Request $request, User $users, Produto $produtos, Category $categories){


        if($request->search != null && $request->nomecategoria != null){
            $produtos = Produto::join('users','produtos.user_id','=','users.id')
            ->select('produtos.*','users.name')
            ->join('categories','produtos.category_id','=','categories.id')
            ->where('nome_prod','LIKE','%'.$request->search.'%')
            ->where('status','LIKE','%aprovado%')
            ->where('nome_cat', $request->nomecategoria)
            ->get();
        }else if(isset($request->search)){
            $produtos = Produto::join('users','produtos.user_id','=','users.id')
            ->join('categories','produtos.category_id','=','categories.id')
            ->select('produtos.*','users.name')
            ->where('nome_prod','LIKE','%'.$request->search.'%')
            ->where('status','LIKE','%aprovado%')
            ->get();

        }else if(isset($request->nomecategoria)){
            if($request->nomecategoria != null){
                $produtos = Produto::join('users','produtos.user_id','=','users.id')
                ->join('categories','produtos.category_id','categories.id')
                ->select('produtos.*','users.name')
                ->where('nome_cat',$request->nomecategoria)
                ->where('status','LIKE','%aprovado%')
                ->get();
            }
        }else{
            $produtos = Produto::join('users','produtos.user_id','=','users.id')
            ->select('produtos.*','users.name')
            ->where('status','LIKE','%aprovado%')
            ->get();
        }

        $userAll = Auth::user();
        
        $avisos = Aviso::orderBy('created_at','desc')->paginate(2);

        return view('index', [
            'produtos' => $produtos,
            'users' => $users, 
            'userAll' => $userAll,
            'avisos' => $avisos,
            'categories' => $categories
            ]);

    }
}
