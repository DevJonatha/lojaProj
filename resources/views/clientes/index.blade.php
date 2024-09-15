@extends('layouts.app')
@section('title', 'Gerenciar Clientes')
@section('content')
    <div class="container">
        <h3 align="center" class="mt-5">Cadastro Clientes</h3>
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
            <div class="form-area">
                <form method="POST" action="{{ route('cliente.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="nome_cliente">Nome Cliente:</label>
                            <input type="text" class="form-control" name="nome_cliente">
                        </div>
                        <div class="col-md-6">
                            <label for="cpf_cliente">CPF:</label>
                            <input type="string" class="form-control" name="cpf_cliente">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <input type="submit" class="btn btn-primary" value="Criar">
                        </div>
                    </div>
                </form>
            </div>
                <table class="table mt-5">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome Cliente</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Opções</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($clientes as $key => $cliente)
                        <tr>
                            <td scope="col">{{ $cliente->id }}</td>
                            <td scope="col">{{ $cliente->nome_cliente }}</td>
                            <td scope="col">{{ $cliente->cpf_cliente }}</td>
                            <td scope="col">
                            <a href="{{  route('cliente.edit', $cliente->id) }}">
                            <button class="btn btn-primary btn-sm">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                            </button>
                            </a>
                            
                            <form action="{{ route('cliente.destroy', $cliente->id) }}" method="POST" style ="display:inline">
                             @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Apagar</button>
                            </form>
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <style>
        .form-area{
            padding: 20px;
            margin-top: 20px;
            background-color:#b3e5fc;
        }
        .bi-trash-fill{
            color:red;
            font-size: 18px;
        }
        .bi-pencil{
            color:green;
            font-size: 18px;
            margin-left: 20px;
        }
    </style>
@endpush