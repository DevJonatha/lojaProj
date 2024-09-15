@extends('layouts.app')
@section('title', 'Gerenciar Produtos')
@section('content')
    <div class="container">
        <h3 align="center" class="mt-5">Produtos</h3>
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
            <div class="form-area">
                <form method="POST" action="{{ route('produto.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label>Nome Produto:</label>
                            <input type="text" class="form-control" name="nome_produto">
                        </div>
                        <div class="col-md-6">
                            <label>Preço Produto:</label>
                            <input type="string" class="form-control" name="preco_produto">
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
                        <th scope="col">Nome Produto</th>
                        <th scope="col">Preço Produto</th>
                        <th scope="col">Opções</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($produtos as $key => $produto)
                        <tr>
                            <td scope="col">{{ $produto->id }}</td>
                            <td scope="col">{{ $produto->nome_produto }}</td>
                            <td scope="col">R${{ $produto->preco_produto }}</td>
                            <td scope="col">
                            <a href="{{  route('produto.edit', $produto->id) }}">
                            <button class="btn btn-primary btn-sm">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                            </button>
                            </a>
                            
                            <form action="{{ route('produto.destroy', $produto->id) }}" method="POST" style ="display:inline">
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