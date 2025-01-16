<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <?php include('navbar.php'); ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Adicionar Usuário
                            <a href="index.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="config.php" method="POST">
                            <div class="mb-3">
                                <label>Nome</label>
                                <input type="text" name="nome" class="form-control">
                            </div>             
                        
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control">
                            </div>                        
                        
                            <div class="mb-3">
                                <label>Senha</label>
                                <input type="password" name="senha" class="form-control">
                            </div>                      
                        
                            <div class="mb-3">
                                <label>CPF</label>
                                <input type="text" name="cpf" class="form-control">
                            </div>                      
                        
                            <div class="mb-3">
                                <label>Rua</label>
                                <input type="text" name="rua" class="form-control">
                            </div>                     
                        
                            <div class="mb-3">
                                <label>Bairro</label>
                                <input type="text" name="bairro" class="form-control">
                            </div>                   
                        
                            <div class="mb-3">
                                <label>Cidade</label>
                                <input type="text" name="cidade" class="form-control">
                            </div>                       
                        
                            <div class="mb-3">
                                <label>Estado</label>
                                <input type="text" name="estado" class="form-control">
                            </div>                       
                        
                            <div class="mb-3">
                                <label>CEP</label>
                                <input type="text" name="cep" class="form-control">
                            </div>

                            <div class="mb-3">
                                <button type="submit" name="create_usuario" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>