<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    // Isso provavelmente não está correto
    // _token teve que ser incluido no fillable para evitar MassAssignmentException | Lembrar de procurar um meio para resolver esse problema sem incluir o token, caso haja tempo

    protected $table = 'vendas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'valor_total',
        'cliente_id',
        'metodo_pagamento',
        'quantidade_produto',
        'quantidade_parcelas',
        '_token',
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
    
    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'produto_venda')
            ->withPivot('preco_produto', 'quantidade_produto')
            ->withTimestamps();
    }
}
