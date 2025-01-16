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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php include('navbar.php'); ?>
    <div class="container mt-4">
        <?php include('mensagem.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4> RELATÓRIO 1 - Vendas
                            <a href="index.php" class="btn btn-primary float-end ms-2">Usuários</a>
                            <a href="index_produtos.php" class="btn btn-primary float-end ms-2">Produtos</a>
                            <a href="relatorios2.php" class="btn btn-primary float-end ms-2">Relatório 2</a>
                            <a href="loja.php" class="btn btn-primary float-end ms-2">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>N*</th>
                                    <th>Descrição</th>
                                    <th>Nome</th>
                                    <th>Total Vendido</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                function getProcedureResults($conexao, $procedure) {
                                    $conexao->next_result(); // Limpa os resultados anteriores
                                    $result = $conexao->query($procedure);
                                    if ($result) {
                                        return $result->fetch_assoc();
                                    }
                                    return null;
                                }

                                
                                $produtoMaisVendido = getProcedureResults($conexao, "CALL produto_mais_vendido()");
                                if ($produtoMaisVendido) {
                                    echo "<tr>
                                            <td>1</td>
                                            <td>Produto mais vendido</td>
                                            <td>{$produtoMaisVendido['produto']}</td>
                                            <td>{$produtoMaisVendido['total_vendido']}</td>
                                          </tr>";
                                }

                              
                                $produtoMenosVendido = getProcedureResults($conexao, "CALL produto_menos_vendido()");
                                if ($produtoMenosVendido) {
                                    echo "<tr>
                                            <td>2</td>
                                            <td>Produto menos vendido</td>
                                            <td>{$produtoMenosVendido['produto']}</td>
                                            <td>{$produtoMenosVendido['total_vendido']}</td>
                                          </tr>";
                                }

                                
                                $lucroTotal = getProcedureResults($conexao, "CALL lucro_total()");
                                if ($lucroTotal) {
                                    echo "<tr>
                                            <td>3</td>
                                            <td>Lucro Total</td>
                                            <td>-</td>
                                            <td>{$lucroTotal['lucro_total']}</td>
                                        </tr>";
                                }


                                
                                $fornecedorMaisVenda = getProcedureResults($conexao, "CALL fornecedor_mais_venda()");
                                if ($fornecedorMaisVenda) {
                                    echo "<tr>
                                            <td>4</td>
                                            <td>Fornecedor mais vendido</td>
                                            <td>{$fornecedorMaisVenda['fornecedor_nome']}</td>
                                            <td>{$fornecedorMaisVenda['total_vendido']}</td>
                                          </tr>";
                                }

                                
                                $fornecedorMenosVenda = getProcedureResults($conexao, "CALL fornecedor_menos_venda()");
                                if ($fornecedorMenosVenda) {
                                    echo "<tr>
                                            <td>5</td>
                                            <td>Fornecedor menos vendido</td>
                                            <td>{$fornecedorMenosVenda['fornecedor_nome']}</td>
                                            <td>{$fornecedorMenosVenda['total_vendido']}</td>
                                          </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
