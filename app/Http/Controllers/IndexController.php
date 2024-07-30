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
    public function index(Category $categories, User $users){

        $produtos = Produto::join('users','produtos.user_id', '=', 'users.id')->select('produtos.*','users.name')->where('status','LIKE',"%aprovado%")->get();
        $prodCount = Produto::where('status','like','%aprovado%')->count();

        $userAll = Auth::user();
        
        $avisos = Aviso::orderBy('created_at','desc')->paginate(2);

        return view('index', ['produtos' => $produtos, 'prodCount' => $prodCount, 'users' => $users, 'userAll' => $userAll, 'avisos' => $avisos]);

    }
}
