<?php
session_start();
require 'conexao.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Relatório de Produtos Lucrativos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php include('navbar.php'); ?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Relatório 2 - Produtos Mais Lucrativos</h4>
                            <a href="index.php" class="btn btn-primary float-end ms-2">Usuários</a>
                            <a href="index_produtos.php" class="btn btn-primary float-end ms-2">Produtos</a>
                            <a href="relatorios.php" class="btn btn-primary float-end ms-2">Relatório 1</a>
                            <a href="loja.php" class="btn btn-primary float-end ms-2">Voltar</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Lucro Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Função para executar a procedure e retornar os resultados
                                function getProcedureResults($conexao, $procedure) {
                                    $conexao->next_result(); // Limpa os resultados anteriores
                                    $result = $conexao->query($procedure);
                                    return $result ? $result : null;
                                }

                                // Chama a procedure para obter os produtos mais lucrativos
                                $resultadoProdutos = getProcedureResults($conexao, "CALL produto_mais_lucrativo()");

                                if ($resultadoProdutos) {
                                    // Exibe os resultados em uma tabela
                                    while ($row = $resultadoProdutos->fetch_assoc()) {
                                        echo "<tr>
                                                <td>{$row['Produto']}</td>
                                                <td>R$ " . number_format($row['LucroTotal'], 2, ',', '.') . "</td>
                                              </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='2'>Nenhum resultado encontrado.</td></tr>";
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
