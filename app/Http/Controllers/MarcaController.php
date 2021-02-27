<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    //Construtor é obrigatorio quando trabalhamos com injecao de model
    public function __construct(Marca $marca)//Aqui temos o contrutor do metodo
    {
        $this->marca= $marca;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()//Aqui é GET da nossa aplicação
    {
        //
        //$marca = Marca::all();//BUSCANDO VALORES QUE SE ENCONTRA NO BANCO DE DADOS
        $marcas = $this->marca->all();//segunda forma de busca dados, usando o INJEÇÃO DE MODEL
        return response()->json($marcas, 200);
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
      // $marca = Marca::create($request->all());//Alimentado o banco de dados.
      //  dd($request->all());//Verificar se os dados estão chegando
        //o metodo all() isolar os parametros que estamos recebendo
        //esse faz com que visualizamos no Postman
        $marcas = $this->marca->create($request->all());//segunda forma de criar dados para o banco, usando o INJEÇÃO DE MODEL
        return response()->json($marcas, 201);
    }

    /* //podemos usar esse caso abaixo se não quisermos trabalhar com injecao de model
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
   /* 
    public function show(Marca $marca)//Aqui é o get com parametro da nossa aplicação
    {
        //
        return $marca;
    }
    */

   /**
     * Display the specified resource.
     *
     * @param  Interger  $id
     * @return \Illuminate\Http\Response
     */ 
    public function show($id)//Aqui é o get com parametro da nossa aplicação
    {
        //Podemos usar desta forma para buscar todos os dados
        //apenas temos que criar o construtor como acima foi criado
        $marcas = $this->marca->find($id);//Aqui estou buscando todos os dados
        //nesse caso usando ineção de model
        if(empty($marcas)) 
        {
            return response()->json(['erro' => 'recurso pesquisado não existe'],404);//Implementado os erros para o 
            //json verificar os erros
        }
        return response()->json($marcas,200);
    }
    
    /*//Podemos usar esse dados abaixo, se não quisermos usar injecao de model
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
    /*
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
 *//*
        $marca->update($request->all());
        return  $marca;
    }
    */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) //Aqui temos dois parametros,
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
//Usando injecao de idependecia no caso abaixo
        $marcas= $this->marca->find($id);
        //O erro tem que ficar antes do update
        if(empty($marcas)) 
        {
            return response()->json(['erro'=> 'impossivel atualizar a infomação, o requirimento solicitado não existe'],404);//Erro 404 para que o client
            //cliet == front end consigar tratar os dados e mostra uma tela do erro para cliente
        }

        $marcas-> update($request->all());

        return  response()->json($marcas,200);
    }

/*
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     
    public function destroy(Marca $marca)//O $marca é o ID para localizar os dados no banco
    //o destroy é o delete
    {
        //NÃO SE ESQUEÇA DE USAR O ALL(), com ele podemos visulizar os dados 
        $marca->delete();//Deletando dados do banco
        return ['msg'=>'Foi deletado com suecesso '];
        
    }
    */

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)//O $marca é o ID para localizar os dados no banco
    //o destroy é o delete
    {
        //NÃO SE ESQUEÇA DE USAR O ALL(), com ele podemos visulizar os dados 
        $marcas = $this->marca->find($id);
        if(empty($marcas)) {
            return response()->json(['erro', 'dados não existe, impossivel de deletar'], 404);//passando para o client o erro 404
            //o client é o front end da aplicação, com esse erro o front end consigar mostra a pagina para usuario
            //pagina de erro
        }
        $marcas->delete();//Deletando dados do banco
        return response()->json(['msg'=>'Foi deletado com suecesso '],200);
        
    }
}
