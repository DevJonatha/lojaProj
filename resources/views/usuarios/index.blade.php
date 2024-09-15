@extends('layouts.app')
@section('title', 'Gerenciar Usuarios')
@section('content')
    <div class="container">
        <h3 align="center" class="mt-5">Usuarios</h3>
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
            <div class="form-area">
                <form method="POST" action="{{ route('usuario.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label>Usuario:</label>
                            <input type="text" class="form-control" name="nome_usuario">
                        </div>
                        <div class="col-md-6">
                            <label>Email:</label>
                            <input type="string" class="form-control" name="email_usuario">
                        </div>
                        <div class="col-md-6">
                            <label>Senha:</label>
                            <input type="string" class="form-control" name="senha_usuario">
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
                        <th scope="col">Usuario</th>
                        <th scope="col">Email</th>
                        <th scope="col">Senha</th>
                        <th scope="col">Opções</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $key => $usuario)
                        <tr>
                            <td scope="col">{{ $usuario->id }}</td>
                            <td scope="col">{{ $usuario->nome_usuario }}</td>
                            <td scope="col">{{ $usuario->email_usuario }}</td>
                            <td scope="col">{{ $usuario->senha_usuario }}</td>
                            <td scope="col">
                            <a href="{{  route('usuario.edit', $usuario->id) }}">
                            <button class="btn btn-primary btn-sm">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                            </button>
                            </a>
                            
                            <form action="{{ route('usuario.destroy', $usuario->id) }}" method="POST" style ="display:inline">
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