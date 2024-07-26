<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Category;
use App\Models\User;

class IndexController extends Controller
{
    public function index(Category $categories, User $users){

        $produtos = Produto::join('users','produtos.user_id', '=', 'users.id')->select('produtos.*','users.name')->get();

        $prodCount = Produto::all()->count();

        $userAll = Auth::user();
        
        return view('index', ['produtos' => $produtos, 'prodCount' => $prodCount, 'users' => $users, 'userAll' => $userAll]);

    }
}
