<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'name',
        'email',
        'password',
        'codpes',
        'is_admin'
    ];

    //pode ser usado para definir, por meio de um select, um admin 
    public static function usuarios(){
        $users = User::all();
        return $users;
    }

    public function products(){
        return $this->hasMany('App\Models\Produto');
    }

}
