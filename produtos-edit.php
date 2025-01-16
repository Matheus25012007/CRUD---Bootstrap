<?php
session_start();
require 'conexao.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <?php include('navbar.php'); ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Editar Produto
                            <a href="index_produtos.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['id'])) {
                            $produto_id = mysqli_real_escape_string($conexao, $_GET['id']);

                            $sqle = "SELECT * FROM fornecedor WHERE id_fornecedor='$produto_id'";
                            $sql = "SELECT * FROM produto_loja WHERE id_produto_loja='$produto_id'";

                            $query = mysqli_query($conexao, $sql);
                            $querye = mysqli_query($conexao, $sqle);

                            if (mysqli_num_rows($query) > 0 && mysqli_num_rows($querye) > 0) {
                                $produto = mysqli_fetch_array($query);
                                $fornecedor = mysqli_fetch_array($querye);
                        ?>
                        <form action="config.php" method="POST">

                        <input type="hidden" name="id_produto" value="<?=$produto['id_produto_loja']?>">

                            <div class="mb-3">
                                <label>Produto</label>
                                <p class="form-control"><?=$produto['produto'];?></p>
                            </div>             
                        
                            <div class="mb-3">
                                <label>Estoque</label>
                                <input type="text" name="estoque" value="<?=$produto['estoque']?>" class="form-control">
                            </div>                        
                        
                            <div class="mb-3">
                                <label>Preço</label>
                                <input type="text" name="preco" value="<?=$produto['preco_loja']?>" class="form-control">
                            </div>                      

                            <div class="mb-3">
                                <button type="submit" name="update_produto" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>

                        <?php
                        } else {
                            echo "<h5>Produto não encontrado</h5>";
                        }
                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>