<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto; //NÃO ESQUECER DE IMPORTAR O MODELO

class ProdutoController extends Controller
{
    //Instanciando o modelo através de um construtor
    protected $produto;

    public function __construct(){
        $this->produto = new Produto();
    }
    
    //Carrega os dados dentro de um Array, após pegar os dados relacionados ao modelo, exibe na view
    public function index()
    {
       $response['produtos'] = $this->produto->all();
       return view('produtos/index')->with($response);
    }
  
    //Armazenando todos os dados do formulário dentro do Store, para então usar todos os dados da requisição e salvar no banco 
    public function store(Request $request)
    {
        //Validação para evitar erro durante o cadastro
        $validatedData = $request->validate([
        'nome_produto' => 'required|string|max:100',
        'preco_produto' => 'required|numeric',
        ]);

        $this->produto->create($validatedData);
        return redirect()->back();
    }
   

    public function edit(string $id)
    {
        
        $response['produto'] = $this->produto->find($id);
        return view('produtos/edit')->with($response);

    }
        

    //Faz a request do formulário para atualizar, busca o ID do modelo, converte o modelo e a requisição para um Array, então atualiza o registro
    public function update(Request $request, string $id)
    {
        //Validação para evitar erro durante o update
        $validatedData = $request->validate([
            'nome_produto' => 'required|string|max:100',
            'preco_produto' => 'required|numeric',
        ]);

        $produto = $this->produto->find($id);
        $produto->update($validatedData);
        return redirect('produtos/produto');
    }

    
    //Busca o ID do modelo, para então excluir o registro com o ID correspondente
    public function destroy(string $id)
    {
        $produto = $this->produto->find($id);
        $produto->delete();
        return redirect('produtos/produto');
    }
}

