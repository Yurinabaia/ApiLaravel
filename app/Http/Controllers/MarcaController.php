<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()//Aqui é GET da nossa aplicação
    {
        //
        $marca = Marca::all();//BUSCANDO VALORES QUE SE ENCONTRA NO BANCO DE DADOS
        return $marca;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)//Aqui é o POST da nossa aplicacao
    {
        //
       $marca = Marca::create($request->all());//Alimentado o banco de dados.
      //  dd($request->all());//Verificar se os dados estão chegando
        //o metodo all() isolar os parametros que estamos recebendo
        //esse faz com que visualizamos no Postman
        return $marca;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show(Marca $marca)//Aqui é o get com parametro da nossa aplicação
    {
        //
        return $marca;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marca $marca) //Aqui temos dois parametros,
    //request é o valor do usuario e $marca é o id do banco que vamos buscar
    {
        //Aqui podemos usar o PUT para atualizar tudo
        //Ou patch para atualizar por parte nossa API
        /*
        //Não esquece de colocar o ALL quando busca get no seu print_r
        print_r($request->all()); //valor do usuario passa
        echo "<hr>";
       

        print_r($marca->getAttributes());//valor no banco buscando pelos dados antigos
        //esse dados é buscado pelo id 
        //o getAttributes traz os valores do banco de dados
 */
        $marca->update($request->all());
        return  $marca;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marca $marca)//O $marca é o ID para localizar os dados no banco
    //o destroy é o delete
    {
        //NÃO SE ESQUEÇA DE USAR O ALL(), com ele podemos visulizar os dados 
        $marca->delete();//Deletando dados do banco
        return ['msg'=>'Foi deletado com suecesso '];
        
    }
}
