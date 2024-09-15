<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario; //NÃO ESQUECER DE IMPORTAR O MODELO

class UsuarioController extends Controller
{
    //Instanciando o modelo através de um construtor
    protected $usuario;

    public function __construct(){
        $this->usuario = new Usuario();
    }
    
    //Carrega os dados dentro de um Array, após pegar os dados relacionados ao modelo, exibe na view
    public function index()
    {
       $response['usuarios'] = $this->usuario->all();
       return view('usuarios/index')->with($response);
    }
  
    //Armazenando todos os dados do formulário dentro do Store, para então usar todos os dados da requisição e salvar no banco 
    public function store(Request $request)
    {
        
        //Validação para evitar erro durante o cadastro
        $validatedData = $request->validate([
            'nome_usuario' => 'required|string|max:100',
            'email_usuario' => 'required|string|unique:usuarios,email_usuario',
            'senha_usuario' => 'required|string',
            ]);

        $this->usuario->create($validatedData);
        return redirect()->back();
    }
   

    public function edit(string $id)
    {
        $response['usuario'] = $this->usuario->find($id);
        return view('usuarios/edit')->with($response);

    }
        

    //Faz a request do formulário para atualizar, busca o ID do modelo, converte o modelo e a requisição para um Array, então atualiza o registro
    public function update(Request $request, string $id)
    {
        //Validação para evitar erro durante o Update
        $validatedData = $request->validate([
            'nome_usuario' => 'required|string|max:100',
            'email_usuario' => 'required|string|unique:usuarios,email_usuario',
            'senha_usuario' => 'required|string',
        ]);

        $usuario = $this->usuario->find($id);
        $usuario->update($validatedData);
        return redirect('usuarios/usuario');
    }

    
    //Busca o ID do modelo, para então excluir o registro com o ID correspondente
    public function destroy(string $id)
    {
        $usuario = $this->usuario->find($id);
        $usuario->delete();
        return redirect('usuarios/usuario');
    }
}
