<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    // Isso provavelmente não está correto
    // _token teve que ser incluido no fillable para evitar MassAssignmentException | Lembrar de procurar um meio para resolver esse problema sem incluir o token, caso haja tempo

    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nome_usuario', 
        'email_usuario',
        'senha_usuario', 
        '_token'
    ];
}
