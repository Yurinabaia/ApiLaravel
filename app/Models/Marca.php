<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'imagem', 'updated_at', 'created_at'];
    //O $fillable é obrigador ser assim
    
    public function regras () //Metodo serve para client determinar regras
    //dentro da API
    {
        return [
            'nome'=> 'required|unique:marcas,nome,'.$this->id.'|min:3',//Neste caso pode entra nomes com no minimo 3 caractes
            'imagem' =>'required'

            /* 
                O unique tem três parametros
                1º tabela == marcas
                2º nome da coluna que sera pesquisado na tabela == nome
                3º id do registro da coluna == this->id

                marcas,nome,id
                //esse id serve para dar uma exceção no valor que vai ser inserido,
                //para não gerar erro na hora de incluir dados
            */
        ];
    }
    public function feedBack() 
    //Metodo que serve para mostra os erros do metodo regras, sendo assim o usuario vai saber o motivo que errou
    {
        return [
            'required' => 'O campo :  atribuite é obrigaotorio',
            'nome.unique' => 'O nome da marca já existe',
            'nome.min' => 'O nome deve ter no minimo 3 caracteres'
        ];
    }
}
