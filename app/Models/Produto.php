<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    // Isso provavelmente não está correto
    // _token teve que ser incluido no fillable para evitar MassAssignmentException | Lembrar de procurar um meio para resolver esse problema sem incluir o token, caso haja tempo

    protected $table = 'produtos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nome_produto', 
        'preco_produto', 
        '_token'
    ];

    public function vendas()
    {
        return $this->belongsToMany(Venda::class, 'produto_venda')
            ->withPivot('preco_produto', 'quantidade_produto')
            ->withTimestamps();
    }
}
