--Cria banco
CREATE DATABASE projeto_titan;
USE projeto_titan;

-- Criar tableas

CREATE TABLE Produtos (
	IDPROD int auto_increment primary key,
    NOME varchar(50) not null,
    COR varchar(12) not null
);

CREATE TABLE Preco (
	IDPRECO int auto_increment primary key,
    PRECO float(10,2) not null,
    IDPROD int not null unique
);

--Insete constraint
ALTER TABLE Preco ADD CONSTRAINT fk_produto FOREIGN KEY ( IDPROD ) REFERENCES PProdutosrodutos ( IDPROD );


--Popula para testes
INSERT INTO Produtos (nome, cor) VALUES ('Produto Teste 1', 'Azul');
INSERT INTO Produtos (nome, cor) VALUES ('Produto Teste 2', 'Amarelo'); 
INSERT INTO Produtos (nome, cor) VALUES ('Produto Teste 3', 'Vermelho');

INSERT INTO Preco (PRECO, IDPROD) VALUES (2000.85, 1);
INSERT INTO Preco (PRECO, IDPROD) VALUES (3000.85, 2);
INSERT INTO Preco (PRECO, IDPROD) VALUES (4000.85, 3);

  