@extends('layouts.app')
@section('title', 'Gerenciar Vendas')
@section('content')
<div class="container">
    <h3 align="center" class="mt-5">Vendas</h3>
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="form-area">
                <form id="produtos-form" method="POST" action="{{ route('venda.store') }}">
                    @csrf
                    <div>
                        <label>Cliente</label>

                        <select id="select-cliente" name="cliente_id" class="form-control" required>
                        <option>Selecionar Cliente</option>
                            @foreach($clientes as $cliente)                                
                                <option value="{{ $cliente->id }}">{{ $cliente->id }} - {{ $cliente->nome_cliente }}
                                </option>
                            @endforeach
                        </select required>

                    </div>
                    <div id="produtos-container">
                        <div class="produto">
                            <label>Produto</label>
                            <select name="produto_id" class="select-produto form-control" onchange="atualizarValores()">
                            <option>Selecionar Produto</option>
                                @foreach ($produtos as $produto)                                
                                    <option value="{{ $produto->id }}" data-preco="{{ $produto->preco_produto }}">
                                        {{ $produto->id }} - {{ $produto->nome_produto }} | R${{ $produto->preco_produto }}
                                    </option>
                                @endforeach
                            </select>

                            <label>Valor Unitário</label>
                            <input class="input-preco form-control" placeholder="0,00" onchange="atualizarValores()"
                                required>

                            <label>Quantidade</label>
                            <input type="number" class="input-quantidade form-control" name="quantidade_produto" value="1" min="1"
                                onchange="atualizarValores()" required>

                            <label>Subtotal</label>
                            <input type="number" class="input-subtotal form-control" step="0.01" placeholder="0,00"
                                name="valor_total" onchange="atualizarValores()" required>

                            <label>Método de Pagamento</label>
                            <select name="produto_metodo" class="select-metodo form-control"
                                onchange="atualizarValores()">                
                                <option>Selecionar Método de Pagamento</option>                
                                <option value="boleto">Boleto Bancário</option>
                                <option value="credito">Cartão de Crédito</option>
                                <option value="debito">Cartão de Débito</option>
                                <option value="pix">PIX</option>
                            </select>

                            <label>Quantidade de Parcelas</label>
                            <input type="number" class="input-parcelas form-control" name="quantidade_parcelas"
                                value="1" min="1" onchange="atualizarValores()" required>
                        </div>
                    </div>
                    <div>
                        <!--Procurar um meio para Implementar essa função para adicionarProduto-->
                        <button type="button" class="btn btn-primary" onclick="adicionarProduto()">Adicionar
                            Produto</button>
                        <input type="submit" class="btn btn-success" value="Realizar Venda">
                    </div>
                </form>
            </div>
            <table id="produtos-table" class="table mt-5">
                <thead>
                    <tr>
                        <th scope="col">Produto</th>
                        <th scope="col">Valor Unitário</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Opções</th>
                    </tr>
                <tbody>

                </tbody>
                <table class="table mt-5">
                    <thead>
                        <tr>
                            <th scope="col">VendaID</th>
                            <th scope="col">ClienteID</th>
                            <th scope="col">Produto</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Valor total</th>
                            <th scope="col">Metodo Pagamento</th>
                            <th scope="col">Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vendas as $key => $venda)
                            <tr>
                                <td scope="col">{{ $venda->id }}</td>
                                <td scope="col">{{ $venda->nome }}</td>
                                <td scope="col">{{ $venda->cpf }}</td>
                                <td scope="col">{{ $venda->senha }}</td>
                                <td scope="col">
                                    <a href="{{  route('venda.edit', $venda->id) }}">
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                        </button>
                                    </a>

                                    <form action="{{ route('venda.destroy', $venda->id) }}" method="POST"
                                        style="display:inline">
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
<script>
    let produtosAdicionados = []

    function atualizarValores() {
        let totalVenda = 0;
        const produtosQuery = document.querySelectorAll('.produto');
        const produtosTable = document.getElementById('produtos-table');

        produtosQuery.forEach(produto => {
            const selectProduto = produto.querySelector('.select-produto');
            const precoProduto = selectProduto.options[selectProduto.selectedIndex].getAttribute('data-preco');
            const quantidadeProduto = produto.querySelector('.input-quantidade').value;
            const quantidadeParcelas = produto.querySelector('.input-parcelas').value;

            if (quantidadeParcelas <= 0) {
                alert("Quantidade de parcelas deve ser maior que zero.");
                return; // Prevent further calculation
            }

            const subtotal = (precoProduto * quantidadeProduto) / quantidadeParcelas;

            document.querySelector('.input-preco').value = parseFloat(precoProduto).toFixed(2);
            document.querySelector('.input-subtotal').value = parseFloat(subtotal).toFixed(2);
            totalVenda += parseFloat(subtotal);
        });

        console.log("Verificando valor total: ", totalVenda);
    }

    function adicionarProduto() {
        const produtosTable = document.getElementById('produtos-table').getElementsByTagName('tbody')[0];
        const produtosQuery = document.querySelectorAll('.produto');
        let selectProduto2;
        let quantidadeProduto2;
        let quantidadeParcelas2;

        produtosQuery.forEach(produto => {
            selectProduto2 = produto.querySelector('.select-produto');
            precoProduto2 = selectProduto2.options[selectProduto2.selectedIndex].getAttribute('data-preco');
            quantidadeProduto2 = produto.querySelector('.input-quantidade').value;
            quantidadeParcelas2 = produto.querySelector('.input-parcelas').value;
        });

        const novoProduto = produtosTable.insertRow();
        const nomeProduto = novoProduto.insertCell(0);
        const valorProduto = novoProduto.insertCell(1);
        const quantidadeProduto = novoProduto.insertCell(2);
        const acaoProduto = novoProduto.insertCell(3);

        nomeProduto.textContent = "Produto"; // Buscar meio para passar o nome do produto 
        valorProduto.textContent = "R$" + parseFloat(precoProduto2).toFixed(2);
        quantidadeProduto.textContent = quantidadeProduto2;

        const botaoApagar = document.createElement('button');
        botaoApagar.textContent = "Apagar"
        botaoApagar.classList.add("btn")
        botaoApagar.classList.add("btn-sm")
        botaoApagar.classList.add("btn-danger")
        botaoApagar.onclick = function () {
            const linhaProduto = this.parentNode.parentNode
            linhaProduto.parentNode.removeChild(linhaProduto);
        }
        acaoProduto.appendChild(botaoApagar);

        document.getElementById('produtos-form').reset();
    }
</script>

@endsection

@push('css')
    <style>
        .form-area {
            padding: 20px;
            margin-top: 20px;
            background-color: #b3e5fc;
        }

        .bi-trash-fill {
            color: red;
            font-size: 18px;
        }

        .bi-pencil {
            color: green;
            font-size: 18px;
            margin-left: 20px;
        }
    </style>
@endpush