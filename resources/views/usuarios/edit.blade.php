@extends('layouts.app')
@section('content')
    <div class="container">
        <h3 align="center" class="mt-5">Editar Usuario</h3>
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
            <div class="form-area">
                <form method="POST" action="{{ route('usuario.update', $usuario->id) }}">
                {!! csrf_field() !!}
                  @method("PATCH")
                    <div class="row">
                        <div class="col-md-6">
                            <label>Usuario:</label>
                            <input type="text" class="form-control" name="nome_usuario" value="{{ $usuario->nome_usuario }}">
                        </div>
                        <div class="col-md-6">
                            <label>Email:</label>
                            <input type="string" class="form-control" name="email_usuario" value="{{ $usuario->email_usuario }}">
                        </div>
                        <div class="col-md-6">
                            <label>Senha:</label>
                            <input type="string" class="form-control" name="senha_usuario" value="{{ $usuario->senha_usuario }}">
                        </div>
                    </div>
                    <div class="row">
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <input type="submit" class="btn btn-primary" value="Atualizar">
                        </div>
                    </div>
                </form>
            </div>
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