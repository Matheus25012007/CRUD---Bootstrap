<?php
session_start();  
require 'conexao.php';

if (isset($_POST['create_usuario']))
{
    //TABELA USUARIO
    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
    $email = mysqli_real_escape_string($conexao, trim($_POST['email']));
    $senha = mysqli_real_escape_string($conexao, trim($_POST['senha']));
    $cpf = mysqli_real_escape_string($conexao, trim($_POST['cpf']));
    $rua = mysqli_real_escape_string($conexao, trim($_POST['rua']));
    $bairro = mysqli_real_escape_string($conexao, trim($_POST['bairro']));
    $cidade = mysqli_real_escape_string($conexao, trim($_POST['cidade']));
    $estado = mysqli_real_escape_string($conexao, trim($_POST['estado']));
    $cep = mysqli_real_escape_string($conexao, trim($_POST['cep']));

    $sql = "INSERT INTO usuario (nome, email, senha, cpf, rua, bairro, cidade, estado, cep) VALUES ('$nome', '$email', '$senha', '$cpf', '$rua', '$bairro', '$cidade', '$estado', '$cep')";
    mysqli_query($conexao, $sql);
    $total = mysqli_affected_rows($conexao);

    if ($total > 0) {
        $_SESSION['mensagem'] = 'Usuário criado com sucesso ';
        header('Location: index.php');
        exit;
    }
    else {
        $_SESSION['mensagem'] = 'Usuário não foi criado: ';
        header('Location: index.php');
        exit;
    }
}

if (isset($_POST['update_usuario']))
{
    $usuario_id = mysqli_real_escape_string($conexao, $_POST['usuario_id']);
    //TABELA USUARIO
    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
    $email = mysqli_real_escape_string($conexao, trim($_POST['email']));
    $senha = mysqli_real_escape_string($conexao, trim($_POST['senha']));
    $cpf = mysqli_real_escape_string($conexao, trim($_POST['cpf']));
    $rua = mysqli_real_escape_string($conexao, trim($_POST['rua']));
    $bairro = mysqli_real_escape_string($conexao, trim($_POST['bairro']));
    $cidade = mysqli_real_escape_string($conexao, trim($_POST['cidade']));
    $estado = mysqli_real_escape_string($conexao, trim($_POST['estado']));
    $cep = mysqli_real_escape_string($conexao, trim($_POST['cep']));

    $sql = "UPDATE usuario SET nome = '$nome', email = '$email', senha = '$senha', cpf = '$cpf', rua = '$rua', bairro = '$bairro', cidade = '$cidade', estado = '$estado', cep = '$cep'";
    $sql .= "WHERE id_usuario = '$usuario_id'";
    mysqli_query($conexao, $sql);

    $total = mysqli_affected_rows($conexao);

    if ($total > 0) {
        $_SESSION['mensagem'] = 'Usuário atualizado com sucesso';
        header('Location: index.php');
        exit;
    }
    else {
        $_SESSION['mensagem'] = 'Usuário não foi atualizado';
        header('Location: index.php');
        exit;
    }
}

if (isset($_POST['delete_usuario']))
{
    $usuario_id = mysqli_real_escape_string($conexao, $_POST['delete_usuario']);
    
    $sql = "DELETE FROM usuario WHERE id_usuario = $usuario_id";
    mysqli_query($conexao, $sql);
    $total = mysqli_affected_rows($conexao);
    
    if ($total > 0) {
        $_SESSION['mensagem'] = 'Usuário deletado com sucesso';
        header('Location: index.php');
        exit;
    }
    else {
        $_SESSION['mensagem'] = 'Usuário não foi deletado';
        header('Location: index.php');
        exit;
    }
}


if (isset($_POST['update_produto']))
{
    $id_produto = mysqli_real_escape_string($conexao, trim($_POST['id_produto'])); 
    // TABELA PRODUTOS DA LOJA
    $quantidade = mysqli_real_escape_string($conexao, trim($_POST['estoque']));
    $preco = mysqli_real_escape_string($conexao, trim($_POST['preco']));

    // Atualização do produto na tabela Produto_Loja
    $sql = "UPDATE produto_loja SET estoque = '$quantidade', preco_loja = '$preco'";
    $sql .= "WHERE id_produto_loja = '$id_produto'";
    mysqli_query($conexao, $sql);
    $total = mysqli_affected_rows($conexao);

    if ($total > 0) {
        $_SESSION['mensagem'] = 'Produto atualizado com sucesso';
        header('Location: index_produtos.php');
        exit;
    }
    else {
        $_SESSION['mensagem'] = 'Produto não foi atualizado';
        header('Location: index_produtos.php');
        exit;
    } 
}

if (isset($_POST['finalizar_compra'])) {
    $compraBemSucedida = true;
    $mensagemErro = '';

    foreach ($_POST['id_produto'] as $index => $produto_id) {
        $produto_id = mysqli_real_escape_string($conexao, $produto_id);
        $quantidade = mysqli_real_escape_string($conexao, trim($_POST['quantidade'][$index]));

        // Verifica o estoque atual do produto
        $consultaEstoque = "SELECT estoque FROM produto_loja WHERE id_produto_loja = '$produto_id'";
        $nome_produto = "SELECT produto FROM produto_loja WHERE id_produto_loja = '$produto_id'";
        $resultadoEstoque = mysqli_query($conexao, $consultaEstoque);

        if ($resultadoEstoque && mysqli_num_rows($resultadoEstoque) > 0) {
            $produto = mysqli_fetch_assoc($resultadoEstoque);
            $estoqueDisponivel = $produto['estoque'];

            if ($estoqueDisponivel >= $quantidade) {
                // Chama a stored procedure para atualizar o estoque e a quantidade vendida
                $sql = "CALL FinalizarCompra('$produto_id', '$quantidade');";

                if (!mysqli_query($conexao, $sql)) {
                    $compraBemSucedida = false;
                    $mensagemErro = 'Erro ao finalizar a compra do produto ' . $produto_id;
                    break; // Sai do loop para evitar mais chamadas à procedure
                }
            } else {
                $compraBemSucedida = false;
                $mensagemErro = 'Estoque insuficiente para o produto ' . $produto_id;
                break; // Sai do loop para evitar mais verificações
            }
        }
    }

    if ($compraBemSucedida) {
        $_SESSION['mensagem'] = 'Compra realizada com sucesso';
    } else {
        $_SESSION['mensagem'] = $mensagemErro;
    }

    // Redireciona de volta para o carrinho
    header('Location: carrinho.php');
    exit;
}



?>