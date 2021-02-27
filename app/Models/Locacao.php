<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locacao extends Model
{
    use HasFactory;
    protected $table = 'locacoes';//Aqui é o nome dos migrations, pois o laravel criar errado o nome locacoes e o certo é locacoes
}
