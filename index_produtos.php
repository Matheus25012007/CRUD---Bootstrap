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
                    <h4> LISTA DE PRODUTOS
                        <a href="index.php" class="btn btn-primary float-end ms-2">Usuários</a>
                        <a href="relatorios.php" class="btn btn-primary float-end ms-2">Relatórios</a>
                        <a href="loja.php" class="btn btn-primary float-end ms-2">Voltar</a>
                    </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Produto</th>
                                    <th>Estoque</th>
                                    <th>Preço</th>
                                    <th>Ação</th>
                                    
                                </tr>
                            </thead>
                            <tbody>

                            <!--EXIBIÇÃO DO BANCO NO SITE -->
                            <?php 
                            $sql = 'SELECT * FROM produto_loja';
                            $produtos = mysqli_query($conexao, $sql);

                            if (mysqli_num_rows($produtos) > 0)
                            {
                                foreach($produtos as $produto)
                                {
                            ?>
                                <tr>
                                    <td>
                                        <?=$produto['id_produto_loja']?>
                                    </td>
                                    
                                    <td>
                                        <?=$produto['produto']?>
                                    </td>

                                    <td>
                                        <?=$produto['estoque']?>
                                    </td>

                                    <td>
                                        <?=$produto['preco_loja']?>
                                    </td>

                                    
                                    <td>
                                        <a href="produtos-edit.php?id=<?=$produto['id_produto_loja']?>" class="btn btn-success btn-sm">Editar</a>
                                    </td>
                                </tr>
                                <?php
                                }
                            }
                            else
                            {
                                echo'<h5>Ainda não tem Produtos!</h5>';
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