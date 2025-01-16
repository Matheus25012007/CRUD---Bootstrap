<?php
define('HOST', 'Localhost');
define('USUARIO', 'root');
define('SENHA', '');
define('BANCO', 'Loja_db');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, BANCO) or die ('Não foi possível conectar');
?>