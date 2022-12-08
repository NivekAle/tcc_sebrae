create database innovament;

use innovament;

create table Usuarios(
	id INT PRIMARY KEY AUTO_INCREMENT,
    nome_completo VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(20) NOT NULL,
    cpf VARCHAR(11) NOT NULL,

    data_nascimento DATE NOT NULL,
	-- endereco VARCHAR(255) NOT NULL,
    cidade VARCHAR(255) NOT NULL,
    estado VARCHAR(255) NOT NULL,
    pais VARCHAR(255) NOT NULL,
    telefone VARCHAR(11) NOT NULL UNIQUE,
    criado_em  timestamp
);

create table Vendedores (
	id INT PRIMARY KEY AUTO_INCREMENT,
	nome_completo VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(20) NOT NULL,
    cpf VARCHAR(11) NULL UNIQUE,
    cnpj VARCHAR(14) NULL UNIQUE,
    cidade VARCHAR(255) NOT NULL,
    pais VARCHAR(255) NOT NULL,
    estado VARCHAR(255) NOT NULL,
    criado_em  timestamp
);

create table Categorias (
	id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL
);


create table Produtos (
	id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2),
    likes INT DEFAULT 0 ,
    criado_em timestamp,

    -- FK
    id_vendedor INT,
    CONSTRAINT FK_Produto_Vendedor FOREIGN KEY (id_vendedor) REFERENCES Vendedores(id),
    id_categoria INT,
    CONSTRAINT FK_Produto_Categoria FOREIGN KEY (id_categoria) REFERENCES Categorias(id)
);

create table Tags(
	id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL
);

create table Tags_Produtos (
	id INT PRIMARY KEY AUTO_INCREMENT,

	id_produto INT,
    CONSTRAINT FK_Produto_Tag FOREIGN KEY (id_produto) REFERENCES Produtos(id),
    id_tag INT,
    CONSTRAINT FK_Tag_Produto FOREIGN KEY (id_tag) REFERENCES Tags(id)
);

create table Imagens (
	id INT PRIMARY KEY AUTO_INCREMENT,
    caminho VARCHAR(255) NOT NULL,
    criado_em timestamp,

    id_produto INT,
    CONSTRAINT FK_Produto_Imagem FOREIGN KEY (id_produto) REFERENCES Produtos(id)
);

create table Vendas (
	id INT PRIMARY KEY AUTO_INCREMENT,
    valor DECIMAL,
    data_compra timestamp,

    -- FK
    id_produto INT,
    CONSTRAINT FK_Venda_Produto FOREIGN KEY (id_produto) REFERENCES Produtos(id),
    id_usuario INT,
    CONSTRAINT FK_Venda_Usuario FOREIGN KEY (id_usuario) REFERENCES Usuarios(id)
);

-- 29/10/2022

create table Produto_Venda (
	id INT PRIMARY KEY AUTO_INCREMENT,
    id_produto INT,
    CONSTRAINT FK_ProdutoVenda_Produto FOREIGN KEY (id_produto) REFERENCES Produtos(id),
    id_venda INT,
    CONSTRAINT FK_ProdutoVenda_Venda FOREIGN KEY (id_venda) REFERENCES Vendas(id)
);

create table Comentarios (
	id INT PRIMARY KEY AUTO_INCREMENT,
    conteudo TEXT NOT NULL,
    criado_em timestamp,

    -- FK
    id_produto INT,
    CONSTRAINT FK_Comentario_Produto FOREIGN KEY (id_produto) REFERENCES Produtos(id),
    id_usuario INT,
    CONSTRAINT FK_Comentario_Usuario FOREIGN KEY (id_usuario) REFERENCES Usuarios(id)
);

-- 24/11 [21:42]
CREATE TABLE Atributos_Produtos (
	id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    valor VARCHAR(255) NOT NULL,
    criado_em timestamp,
    -- FK
    id_produto INT,
    CONSTRAINT FK_Produto_Atributo FOREIGN KEY (id_produto) REFERENCES Produtos(id)
);

-- updates
ALTER TABLE `innovament`.`produtos`
ADD COLUMN `status` INT NOT NULL DEFAULT 1 AFTER `likes`;

INSERT INTO `usuarios` (`id`, `nome_completo`, `email`, `senha`, `cpf`, `data_nascimento`, `cidade`, `estado﻿`, `pais`, `telefone`, `criado_em`) VALUES (NULL, 'Alex Rodrigo Flores Condori', 'alex@gmail.com', '12345', '50128473', '2000-01-17', 'São Paulo', 'São Paulo', 'Brasil', '12140123', current_timestamp());


select Vendedores.nome_completo from Produtos join Vendedores on Vendedores.id  = Produtos.id_vendedor where Produtos.id = 1;
select Categorias.nome from Produtos join Categorias on Categorias.id = Produtos.id_categoria where Produtos.id = 3;
select * from produtos where id = 2 and status = 4;

-- pegar todos os comentario pelo id_produto
select Comentarios.criado_em, Comentarios.conteudo, Usuarios.nome_completo from Comentarios left join Produtos on Produtos.id = Comentarios.id_produto join Usuarios on Usuarios.id = Comentarios.id_usuario where Produtos.id = 1;
select Comentarios.criado_em, Comentarios.conteudo, Usuarios.nome_completo from Comentarios left join Produtos on Produtos.id = Comentarios.id_produto join Usuarios on Usuarios.id = Comentarios.id_usuario where Produtos.id = 2;

select * from produtos;

-- pegando todas as imagens de todos os produtos
select Imagens.id, Imagens.caminho, Imagens.id_produto from Imagens join Produtos on Produtos.id = Imagens.id_produto;

-- pegando imagens somente de um produto
select Imagens.id, Imagens.caminho from Imagens join Produtos on Produtos.id = Imagens.id_produto where Produtos.id = 28;

-- todos os produtos com imagens
SELECT Produtos.nome AS NomeProduto, Imagens.caminho AS ImagemProduto FROM Produtos JOIN Imagens ON Produtos.id = Imagens.id_produto GROUP BY Produtos.id;

-- pagina index
SELECT Produtos.id, Vendedores.nome_completo , Produtos.nome, Produtos.preco, Produtos.likes, Imagens.caminho
FROM Produtos, Imagens, Vendedores
WHERE Produtos.id = Imagens.id_produto GROUP BY Imagens.caminho ORDER BY Imagens.id_produto;

-- pegando a imagen, vendedor e dados do produto;
SELECT Produtos.id, Vendedores.nome_completo , Produtos.nome, Produtos.preco, Produtos.likes, Imagens.caminho
FROM Produtos JOIN Imagens ON Produtos.id = Imagens.id_produto JOIN Vendedores ON Produtos.id_vendedor = Vendedores.id GROUP BY Imagens.id_produto;

-- pegando a imagem, e dados do produto de acordo com o id do vendedor
SELECT Produtos.id, Vendedores.nome_completo , Produtos.nome, Produtos.preco, Produtos.likes, Imagens.caminho
FROM Produtos JOIN Imagens ON Produtos.id = Imagens.id_produto JOIN Vendedores ON Produtos.id_vendedor = Vendedores.id WHERE Produtos.id_vendedor = 2 GROUP BY Imagens.id_produto;

select * from Imagens;

use tech_solutions;

SELECT
	Produtos.id AS 'ID Produto',
    Vendedores.nome_completo AS 'NOME VENDEDOR',
    Produtos.nome AS 'NOME PRODUTO',
    Produtos.preco AS 'PRECO',
    Produtos.likes AS 'LIKES',
    Produtos.status AS 'STATUS' ,
    Imagens.caminho AS 'IMAGENS'
FROM Produtos
JOIN Vendedores ON Produtos.id_vendedor = Vendedores.id
LEFT JOIN Imagens ON Produtos.id = Imagens.id_produto
WHERE Produtos.id_vendedor = 1;

-- ---------------
SELECT
	Produtos.id,
    Vendedores.nome_completo ,
    Produtos.nome,
    Produtos.preco,
    Produtos.likes,
    Produtos.status ,
    Imagens.caminho
FROM Produtos
JOIN Vendedores ON Produtos.id_vendedor = Vendedores.id
LEFT JOIN Imagens ON Produtos.id = Imagens.id_produto
WHERE Produtos.id_vendedor = 2;

-- Insert de Categorias ----------
INSERT INTO `innovament`.`categorias` (`nome`) VALUES ('Admin Templates');
INSERT INTO `innovament`.`categorias` (`nome`) VALUES ('Corporate');
INSERT INTO `innovament`.`categorias` (`nome`) VALUES ('Creative');
INSERT INTO `innovament`.`categorias` (`nome`) VALUES ('Entertainment');
INSERT INTO `innovament`.`categorias` (`nome`) VALUES ('Mobile');
INSERT INTO `innovament`.`categorias` (`nome`) VALUES ('Personal');
INSERT INTO `innovament`.`categorias` (`nome`) VALUES ('Retail');
INSERT INTO `innovament`.`categorias` (`nome`) VALUES ('Tecnologias');
INSERT INTO `innovament`.`categorias` (`nome`) VALUES ('Shopping');
INSERT INTO `innovament`.`categorias` (`nome`) VALUES ('Dashboards');
