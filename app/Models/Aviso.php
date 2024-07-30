<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Aviso extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'texto',
        'user_id'
    ];

    public function users(){
        return $this->belongsTo('App\Models\User');
    }

}
