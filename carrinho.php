<?php
session_start();
require 'conexao.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('navbar_usuario.php'); ?>
    <div class="container mt-4">
        <?php include('mensagem.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>CARRINHO DE COMPRAS
                            <a href="loja.php" class="btn btn-primary float-end ms-2">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="config.php">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Produto</th>
                                        <th>Quantidade</th>
                                        <th>Preço</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $sql = 'SELECT * FROM produto_loja';
                                    $produtos = mysqli_query($conexao, $sql);

                                    if ($produtos && mysqli_num_rows($produtos) > 0) {
                                        foreach($produtos as $produto) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?=$produto['id_produto_loja']?>
                                            <input type="hidden" name="id_produto[]" value="<?=$produto['id_produto_loja']?>">
                                        </td>
                                        <td><?=$produto['produto']?></td>
                                        <td>
                                            <div class="input-group">
                                                <button type="button" class="btn btn-danger" onclick="alterarQuantidade(this, -1)">-</button>
                                                <input type="text" name="quantidade[]" value="0" class="form-control quantidade" onchange="atualizarTotal()">
                                                <button type="button" class="btn btn-success" onclick="alterarQuantidade(this, 1)">+</button>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="preco"><?=number_format($produto['preco_loja'], 2, ',', '.')?></span>
                                        </td>
                                        <td>
                                            <span class="total-produto">0,00</span>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    } else {
                                        echo '<h5>Ainda não tem Produtos!</h5>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <h5>Total da Compra: R$ <span id="total-compra">0,00</span></h5>
                            <button type="submit" name="finalizar_compra" class="btn btn-success float-end">Finalizar Compra</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function alterarQuantidade(button, increment) {
            const quantidadeInput = button.parentNode.querySelector('.quantidade');
            let quantidade = parseInt(quantidadeInput.value) || 0;
            quantidade = Math.max(0, quantidade + increment);
            quantidadeInput.value = quantidade;
            atualizarTotal();
        }

        function atualizarTotal() {
            let totalCompra = 0;
            document.querySelectorAll('tbody tr').forEach(row => {
                const quantidade = parseInt(row.querySelector('.quantidade').value) || 0;
                const preco = parseFloat(row.querySelector('.preco').textContent.replace(',', '.'));
                const totalProduto = quantidade * preco;
                
                row.querySelector('.total-produto').textContent = totalProduto.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
                totalCompra += totalProduto;
            });
            document.getElementById('total-compra').textContent = totalCompra.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>