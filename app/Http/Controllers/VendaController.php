<?php

namespace App\Http\Controllers;

//Primeiro Controller a carregar mais de um modelo, não esquecer de enviar os dados através do $response

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Venda; 

class VendaController extends Controller
{
    //Instanciando o modelo através de um construtor
    protected $venda;

    public function __construct(){
        $this->venda = new Venda();
    }
    
    //Carrega os dados dentro de um Array, após pegar os dados relacionados ao modelo, exibe na view
    public function index()
    {
       //Adicionando mais de uma requisição para o array $response, para utilizar os registros na view
       $response['vendas'] = $this->venda->all();
       $response['clientes'] = Cliente::all();
       $response['produtos'] = Produto::all();
       return view('vendas/index')->with($response);
    }
  
    //Armazenando todos os dados do formulário dentro do Store, para então usar todos os dados da requisição e salvar no banco 
    public function store(Request $request)
    {
        
        //Validação para evitar erro durante o cadastro
        $validatedData = $request->validate([
            'valor_total' => 'required|decimal|',
            'cliente_id' => 'required|integer|',
            'metodo_pagamento' => 'required|string',
            'quantidade_produto' => 'required|integer|min:1',
            'quantidade_parcelas' => 'required|integer|min:1',
            ]);

        $this->venda->create($validatedData);
        return redirect()->back();
    }
   

    public function edit(string $id)
    {
        $response['venda'] = $this->venda->find($id);
        return view('vendas/edit')->with($response);

    }
        

    //Faz a request do formulário para atualizar, busca o ID do modelo, converte o modelo e a requisição para um Array, então atualiza o registro
    public function update(Request $request, string $id)
    {
        //Validação para evitar erro durante o Update
        $validatedData = $request->validate([
        ]);

        $venda = $this->venda->find($id);
        $venda->update($validatedData);
        return redirect('vendas/venda');
    }

    
    //Busca o ID do modelo, para então excluir o registro com o ID correspondente
    public function destroy(string $id)
    {
        $venda = $this->venda->find($id);
        $venda->delete();
        return redirect('vendas/venda');
    }
}
