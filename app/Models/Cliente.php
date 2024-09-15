<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    
    // Isso provavelmente não está correto
    // _token teve que ser incluido no fillable para evitar MassAssignmentException | Lembrar de procurar um meio para resolver esse problema sem incluir o token, caso haja tempo
    
    protected $table = 'clientes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nome_cliente',
        'cpf_cliente',
        '_token'
    ];
}
