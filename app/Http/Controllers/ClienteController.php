<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente; //NÃO ESQUECER DE IMPORTAR O MODELO

class ClienteController extends Controller
{
    //Instanciando o modelo através de um construtor
    protected $cliente;

    public function __construct(){
        $this->cliente = new Cliente();
    }
    
    //Carrega os dados dentro de um Array, após pegar os dados relacionados ao modelo, exibe na view
    public function index()
    {
       $response['clientes'] = $this->cliente->all();
       return view('clientes/index')->with($response);
    }
  
    //Armazenando todos os dados do formulário dentro do Store, para então usar todos os dados da requisição e salvar no banco 
    public function store(Request $request)
    {
        //Validação para evitar erro durante o cadastro
        $validatedData = $request->validate([
        'nome_cliente' => 'required|string|max:100',
        'cpf_cliente' => 'required|string|max:14',
        ]);

        $this->cliente->create($validatedData);
        return redirect()->back();
    }
   

    public function edit(string $id)
    {
        
        $response['cliente'] = $this->cliente->find($id);
        return view('clientes/edit')->with($response);

    }
        

    //Faz a request do formulário para atualizar, busca o ID do modelo, converte o modelo e a requisição para um Array, então atualiza o registro
    public function update(Request $request, string $id)
    {
        //Validação para evitar erro durante o update
        $validatedData = $request->validate([
            'nome_cliente' => 'required|string|max:100',
            'cpf_cliente' => 'required|string|max:14',
        ]);

        $cliente = $this->cliente->find($id);
        $cliente->update($validatedData);
        return redirect('clientes/cliente');
    }

    
    //Busca o ID do modelo, para então excluir o registro com o ID correspondente
    public function destroy(string $id)
    {
        $cliente = $this->cliente->find($id);
        $cliente->delete();
        return redirect('clientes/cliente');
    }
}
