<?php
require 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja de Joias Elegantes</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/loja.css">
</head>
<body>
    <header class="bg-dark text-white text-center py-3">
        <div class="logo">
            <h1>Joias Elegantes</h1>
        </div>
        <nav>
            <ul class="nav justify-content-center mt-3">
                <li class="nav-item"><a class="nav-link text-white" href="loja.php">Início</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="sobre_nos.html">Sobre Nós</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="contato.html">Contato</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="carrinho.php">Carrinho</a></li>
                <li class="nav-item"><a class="nav-link btn btn-primary" href="Login1.html">Login</a></li>
            </ul>
        </nav>
    </header>
    
    <section class="banner">
        <video autoplay muted loop class="banner-video">
            <source src="img/crud.mp4" type="video/mp4"> 
            Seu navegador não suporta o vídeo.
        </video>
        <div class="banner-content">
            <h2>Descubra a Beleza das Joias</h2>
            <p>Joias exclusivas para todas as ocasiões.</p>
            <a href="#produtos" class="btn btn-danger">Ver Coleção</a>
        </div>
    </section>
    <?php

        // Consulta única para obter todos os produtos com id de 1 a 12
        $sql = "SELECT * FROM produto_loja WHERE id_produto_loja IN (1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12)";
        $query = mysqli_query($conexao, $sql);

        $produtos = [];
        $index = 1; // Índice para nomear as variáveis dinamicamente

        while ($produto = mysqli_fetch_array($query)) {
            $produtos["produto" . $index] = $produto; 
            $index++;
        }
        
        extract($produtos);

    ?>
    
    <section class="produtos py-5" id="produtos">
    <div class="container text-center">
        <h2>Nossas Joias</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="img/img1.jpg" class="card-img-top" alt="Anel de Ouro">
                    <div class="card-body">
                        <h3 class="card-title"><?=$produto1['produto'];?></h3>
                        <p class="card-text">R$ <?=$produto1['preco_loja'];?></p>
                        <a href="carrinho.php" class="btn btn-primary">Comprar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="img/img2.jpg" class="card-img-top" alt="Colar de Pérolas">
                    <div class="card-body">
                        <h3 class="card-title"><?=$produto2['produto'];?></h3>
                        <p class="card-text">R$ <?=$produto2['preco_loja'];?></p>
                        <a href="carrinho.php" class="btn btn-primary">Comprar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="img/img3.jpg" class="card-img-top" alt="Brincos de Diamante">
                    <div class="card-body">
                        <h3 class="card-title"><?=$produto3['produto'];?></h3>
                        <p class="card-text">R$ <?=$produto3['preco_loja'];?></p>
                        <a href="carrinho.php" class="btn btn-primary">Comprar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="img/img4.jpg" class="card-img-top" alt="Bracelete de Ouro">
                    <div class="card-body">
                        <h3 class="card-title"><?=$produto4['produto'];?></h3>
                        <p class="card-text">R$ <?=$produto4['preco_loja'];?></p>
                        <a href="carrinho.php" class="btn btn-primary">Comprar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="img/img5.jpg" class="card-img-top" alt="Pulseira de Prata">
                    <div class="card-body">
                        <h3 class="card-title"><?=$produto5['produto'];?></h3>
                        <p class="card-text">R$ <?=$produto5['preco_loja'];?></p>
                        <a href="carrinho.php" class="btn btn-primary">Comprar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="img/img6.jpg" class="card-img-top" alt="Pendente de Cristal">
                    <div class="card-body">
                        <h3 class="card-title"><?=$produto6['produto'];?></h3>
                        <p class="card-text">R$ <?=$produto6['preco_loja'];?></p>
                        <a href="carrinho.php" class="btn btn-primary">Comprar</a>
                    </div>
                </div>
            </div>

            <!-- Novos produtos adicionados -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="img/img7.jpg" class="card-img-top" alt="Anel de Prata">
                    <div class="card-body">
                        <h3 class="card-title"><?=$produto7['produto'];?></h3>
                        <p class="card-text">R$ <?=$produto7['preco_loja'];?></p>
                        <a href="carrinho.php" class="btn btn-primary">Comprar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="img/img8.jpg" class="card-img-top" alt="Colar de Ouro">
                    <div class="card-body">
                        <h3 class="card-title"><?=$produto8['produto'];?></h3>
                        <p class="card-text">R$ <?=$produto8['preco_loja'];?></p>
                        <a href="carrinho.php" class="btn btn-primary">Comprar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="img/img9.jpg" class="card-img-top" alt="Brincos de Pérola">
                    <div class="card-body">
                        <h3 class="card-title"><?=$produto9['produto'];?></h3>
                        <p class="card-text">R$ <?=$produto9['preco_loja'];?></p>
                        <a href="carrinho.php" class="btn btn-primary">Comprar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="img/img10.jpg" class="card-img-top" alt="Tornozeleira de Ouro">
                    <div class="card-body">
                        <h3 class="card-title"><?=$produto10['produto'];?></h3>
                        <p class="card-text">R$ <?=$produto10['preco_loja'];?></p>
                        <a href="carrinho.php" class="btn btn-primary">Comprar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="img/img11.jpg" class="card-img-top" alt="Anel com Esmeralda">
                    <div class="card-body">
                        <h3 class="card-title"><?=$produto11['produto'];?></h3>
                        <p class="card-text">R$ <?=$produto11['preco_loja'];?></p>
                        <a href="carrinho.php" class="btn btn-primary">Comprar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="img/img12.jpg" class="card-img-top" alt="Cordão de Ouro">
                    <div class="card-body">
                        <h3 class="card-title"><?=$produto12['produto'];?></h3>
                        <p class="card-text">R$ <?=$produto12['preco_loja'];?></p>
                        <a href="carrinho.php" class="btn btn-primary">Comprar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2025 Joias Elegantes - Todos os direitos reservados.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>