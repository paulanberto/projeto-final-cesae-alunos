<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    protected $table = 'categorias';
    protected $fillable = ['name', 'descricao', 'icons'];
}
