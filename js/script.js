function logar(event) {
    event.preventDefault(); // Impede o envio padrão do formulário

    var login = document.getElementById('login').value;
    var senha = document.getElementById('senha').value;

    if (login === "admin" && senha === "admin") {
        window.location.href = "index_produtos.php";        
    } else if (login === "usuario" && senha === "usuario") {
        window.location.href = "loja.php"; // Redireciona para a loja
        alert("Credenciais Corretas!");
    } else {
        alert("Credenciais incorretas!"); // Mensagem de erro
    }
}