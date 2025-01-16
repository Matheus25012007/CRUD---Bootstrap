-- Criação do banco de dados AV2
CREATE DATABASE Loja_db;

-- Seleciona o banco de dados para uso
USE Loja_db;

-- Criação das tabelas
CREATE TABLE Usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100),
    senha VARCHAR(100),
    cpf VARCHAR(11),
    rua VARCHAR(100),
    bairro VARCHAR(100),
    cidade VARCHAR(50),
    estado VARCHAR(2),
    cep VARCHAR(9)
);

CREATE TABLE Fornecedor (
    id_fornecedor INT AUTO_INCREMENT PRIMARY KEY,
    fornecedor_nome VARCHAR(100),
    produto_fornecedor VARCHAR(100),
    preco_fornecedor DECIMAL(10, 2)
);

CREATE TABLE Produto_Loja (
    id_produto_loja INT AUTO_INCREMENT PRIMARY KEY,
    produto VARCHAR(100),
    estoque INT,
    preco_loja DECIMAL(10, 2),
    quantidade_vendida INT DEFAULT 0,
    lucro DECIMAL(10, 2) DEFAULT 0.00
);

-- Inserção de dados em Fornecedor
INSERT INTO Fornecedor (fornecedor_nome, produto_fornecedor, preco_fornecedor) VALUES
('H.Stern', 'Colar de Pérolas Negras', 20.00),
('H.Stern', 'Colar de Coração', 90.00),
('Vivara', 'Brinco de Cristal Rosa', 57.00),
('Vivara', 'Brinco de Pluma Rosa', 15.00),
('Tiffany & Co.', 'Pulseira de Couro Preto', 9.00),
('Tiffany & Co.', 'Pulseira de Metal Rosa', 85.00),
('Pandora', 'Anel com Pedra Rosa', 150.00),
('Pandora', 'Anel de Noivado Preto', 250.00),
('Swarovski', 'Brinco de Argola Rosa', 70.00),
('Swarovski', 'Pulseira de Beads Rosa', 50.00),
('Mikimoto', 'Colar de Camadas', 130.00),
('Mikimoto', 'Anel Minimalista Preto', 100.00);

-- Inserção de dados em Produto_Loja (sem id_fornecedor)
INSERT INTO Produto_Loja (produto, estoque, preco_loja, quantidade_vendida) VALUES
('Colar de Pérolas Negras', 7, 150.00, 1),
('Colar de Coração', 7, 1200.00, 2),
('Brinco de Cristal Rosa', 7, 100.00, 3),
('Brinco de Pluma Rosa', 7, 62.75, 4),
('Pulseira de Couro Preto', 7, 28.10, 5),
('Pulseira de Metal Rosa', 7, 100.00, 6),
('Anel com Pedra Rosa', 7, 220.59, 7),
('Anel de Noivado Preto', 7, 350.70, 8),
('Brinco de Argola Rosa', 7, 97.27, 9),
('Pulseira de Beads Rosa', 7, 75.99, 10),
('Colar de Camadas', 7, 1650.00, 11),
('Anel Minimalista Preto', 7, 200.00, 12);

-- Procedure que atualiza estoque, quantidade_vendida e lucro da tabela produto_loja
CREATE PROCEDURE FinalizarCompra(IN produto_id INT, IN quantidade INT)
BEGIN
        UPDATE produto_loja, fornecedor 
        SET 

            produto_loja.estoque = produto_loja.estoque - quantidade, 

            produto_loja.quantidade_vendida = produto_loja.quantidade_vendida + quantidade,

						produto_loja.lucro = produto_loja.lucro+(produto_loja.preco_loja - fornecedor.preco_fornecedor)*quantidade
        WHERE produto_loja.id_produto_loja = produto_id AND produto_loja.produto = fornecedor.produto_fornecedor;
END;

-- PROCEDURES PARA RELATÓRIOS
-- Seleciona o banco para uso
USE Loja_db;

-- 1) Achar o produto mais vendido
DROP PROCEDURE IF EXISTS produto_mais_vendido;
CREATE PROCEDURE produto_mais_vendido()
BEGIN
	SELECT produto_loja.produto, SUM(produto_loja.quantidade_vendida) AS total_vendido
	FROM Produto_Loja AS produto_loja
	GROUP BY produto_loja.produto
	ORDER BY total_vendido DESC
	LIMIT 1;
END;


-- 2) Achar o produto menos vendido
DROP PROCEDURE IF EXISTS produto_menos_vendido;
CREATE PROCEDURE produto_menos_vendido()
BEGIN
	SELECT produto_loja.produto, SUM(produto_loja.quantidade_vendida) AS total_vendido
	FROM Produto_Loja AS produto_loja
	GROUP BY produto_loja.produto
	ORDER BY total_vendido ASC
	LIMIT 1;
END;


-- 3) Achar o lucro total
DROP PROCEDURE IF EXISTS lucro_total;
CREATE PROCEDURE lucro_total()
BEGIN
    SELECT SUM(lucro) AS lucro_total FROM Produto_Loja;
END;


-- 4) Fornecedor que mais vendeu
DROP PROCEDURE IF EXISTS fornecedor_mais_venda;
CREATE PROCEDURE fornecedor_mais_venda()
BEGIN
	SELECT fornecedor.fornecedor_nome, SUM(produto_loja.quantidade_vendida) AS total_vendido 
	FROM Fornecedor AS fornecedor
	JOIN Produto_Loja AS produto_loja ON fornecedor.produto_fornecedor = produto_loja.produto
	GROUP BY fornecedor.fornecedor_nome
	ORDER BY total_vendido DESC
	LIMIT 1;
END;


-- 5) Fornecedor que menos vendeu
DROP PROCEDURE IF EXISTS fornecedor_menos_venda;
CREATE PROCEDURE fornecedor_menos_venda()
BEGIN
	SELECT fornecedor.fornecedor_nome, SUM(produto_loja.quantidade_vendida) AS total_vendido 
	FROM Fornecedor AS fornecedor
	JOIN Produto_Loja AS produto_loja ON fornecedor.produto_fornecedor = produto_loja.produto
	GROUP BY fornecedor.fornecedor_nome
	ORDER BY total_vendido ASC
	LIMIT 1;
END;


-- 6) Produtos mais lucrativos
DROP PROCEDURE IF EXISTS produto_mais_lucrativo;
CREATE PROCEDURE produto_mais_lucrativo()
BEGIN
	SELECT 
		pl.produto AS Produto,
		SUM((pl.preco_loja - f.preco_fornecedor) * pl.quantidade_vendida) AS LucroTotal
	FROM 
		Produto_Loja AS pl
	JOIN 
		Fornecedor AS f ON pl.produto = f.produto_fornecedor
	GROUP BY 
		pl.id_produto_loja
	ORDER BY 
		LucroTotal DESC;
END;