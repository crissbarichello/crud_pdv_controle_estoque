CREATE DATABASE `db_pdv` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;


## Tabela produtos

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(50) UNIQUE,
    descricao VARCHAR(255),
    custo DECIMAL(10,2),
    preco_venda DECIMAL(10,2),
    estoque INT DEFAULT 0,
    ativo TINYINT DEFAULT 1,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP);

## Tabela vendas

CREATE TABLE vendas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    data_venda DATETIME DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10,2),
    forma_pagamento VARCHAR(50)
);

## Tabela itens_venda

CREATE TABLE itens_venda (
    id INT AUTO_INCREMENT PRIMARY KEY,
    venda_id INT,
    produto_id INT,
    quantidade INT,
    valor_unitario DECIMAL(10,2),
    subtotal DECIMAL(10,2),

    FOREIGN KEY(venda_id)
        REFERENCES vendas(id),

    FOREIGN KEY(produto_id)
        REFERENCES produtos(id)
);

## Tabela movimentacoes_estoque

CREATE TABLE movimentacoes_estoque (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto_id INT,
    tipo ENUM(
        'ENTRADA',
        'SAIDA',
        'AJUSTE'
    ),
    quantidade INT,
    observacao VARCHAR(255),
    data_movimento DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY(produto_id)
        REFERENCES produtos(id)
);

## Tabela usuários

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    usuario VARCHAR(50),
    senha VARCHAR(255),
    perfil ENUM(
        'ADMIN',
        'OPERADOR'
    )
);

##  Insert Iniciais 

INSERT INTO usuarios (
    nome,
    usuario,
    senha,
    perfil
) VALUES
(
    'Administrador',
    'admin',
    '$2y$10$abcdefghijklmnopqrstuv',
    'ADMIN'
),
(
    'Operador Caixa',
    'caixa',
    '$2y$10$abcdefghijklmnopqrstuv',
    'OPERADOR'
);

## Produtos

INSERT INTO produtos (
    codigo,
    descricao,
    custo,
    preco_venda,
    estoque,
    ativo
) VALUES
(
    '789000001',
    'Coca-Cola 2L',
    6.50,
    10.00,
    50,
    1
),
(
    '789000002',
    'Água Mineral 500ml',
    1.20,
    2.50,
    100,
    1
),
(
    '789000003',
    'Chocolate Barra 90g',
    3.00,
    5.50,
    80,
    1
),
(
    '789000004',
    'Biscoito Recheado',
    2.50,
    4.99,
    60,
    1
),
(
    '789000005',
    'Café 500g',
    12.00,
    18.90,
    30,
    1
);
``

## Movimentações de estoque 

INSERT INTO movimentacoes_estoque (
    produto_id,
    tipo,
    quantidade,
    observacao
) VALUES
(1,'ENTRADA',50,'Carga inicial'),
(2,'ENTRADA',100,'Carga inicial'),
(3,'ENTRADA',80,'Carga inicial'),
(4,'ENTRADA',60,'Carga inicial'),
(5,'ENTRADA',30,'Carga inicial');

## Venda Exemplo

INSERT INTO vendas (
    total,
    forma_pagamento
) VALUES
(
    24.99,
    'PIX'
);


## Itens da Venda

INSERT INTO itens_venda (
    venda_id,
    produto_id,
    quantidade,
    valor_unitario,
    subtotal
) VALUES
(
    1,
    1,
    2,
    10.00,
    20.00
),
(
    1,
    4,
    1,
    4.99,
    4.99
);

## Atualização do Estoque após a Venda

UPDATE produtos
SET estoque = estoque - 2
WHERE id = 1;

UPDATE produtos
SET estoque = estoque - 1
WHERE id = 4;
``
## Registrar Saída da Venda	

INSERT INTO movimentacoes_estoque (
    produto_id,
    tipo,
    quantidade,
    observacao
) VALUES
(
    1,
    'SAIDA',
    2,
    'Venda #1'
),
(
    4,
    'SAIDA',
    1,
    'Venda #1'
);
``

#######  Teste select   #######

## Consulta Produto
SELECT *
FROM produtos
WHERE codigo  ;

## Consulta estoque
SELECT
p.descricao,
p.estoque,
m.tipo,
m.quantidade,
m.data_movimento
FROM produtos p
LEFT JOIN movimentacoes_estoque m
ON p.id = m.produto_id;


## Vendas por periodo

SELECT
DATE(data_venda),
SUM(total)
FROM vendas
GROUP BY DATE(data_venda);