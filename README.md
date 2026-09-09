# Sistema de Controle de Estoque e PDV

## Objetivo do Projeto

Este projeto tem como finalidade o desenvolvimento de um sistema simples de Controle de Estoque e Ponto de Venda (PDV), com foco educacional e aprendizado de boas práticas de desenvolvimento de software utilizando PHP, MySQL, HTML e CSS.

O sistema foi concebido para demonstrar a aplicação dos conceitos de programação orientada a objetos (POO), arquitetura MVC (Model-View-Controller), modelagem de banco de dados relacional e operações CRUD (Create, Read, Update e Delete), permitindo a gestão de produtos, movimentações de estoque e registro de vendas.

## Funcionalidades Iniciais

- Cadastro de produtos
- Edição de produtos
- Exclusão de produtos
- Consulta e pesquisa de produtos
- Controle de estoque
- Registro de entradas e saídas de mercadorias
- Histórico de movimentações
- PDV simplificado para realização de vendas
- Baixa automática de estoque nas vendas
- Relatório básico de produtos e vendas
- Backup do banco de dados

## Tecnologias Utilizadas

### Backend
- PHP 8+
- Programação Orientada a Objetos (POO)
- Arquitetura MVC

### Banco de Dados
- MySQL

### Front-end
- HTML5
- CSS3
- JavaScript

## Objetivos de Aprendizagem

Durante o desenvolvimento deste projeto serão aplicados conceitos como:

- Estruturação de aplicações web em MVC
- Desenvolvimento orientado a objetos
- Relacionamento entre tabelas no MySQL
- Manipulação de formulários
- Persistência de dados
- Controle transacional de vendas
- Gerenciamento de estoque
- Separação de responsabilidades entre camadas
- Boas práticas de organização de código

## Escopo da Primeira Versão

A versão inicial contempla os módulos essenciais para operação básica de um pequeno comércio:

1. Gestão de Produtos
2. Controle de Estoque
3. Ponto de Venda (PDV)
4. Registro de Vendas
5. Movimentações de Estoque
6. Backup de Dados

## Arquitetura

O projeto segue o padrão MVC (Model-View-Controller), proporcionando uma estrutura organizada, escalável e de fácil manutenção.

# Arquitetura MVC

````
app/
├── controllers/
│   ├── ProdutoController.php
│   ├── VendaController.php
│   ├── EstoqueController.php
│   └── BackupController.php
│
├── models/
│   ├── Produto.php
│   ├── Venda.php
│   ├── ItemVenda.php
│   ├── MovimentoEstoque.php
│   └── Usuario.php
│
├── views/
│   ├── produtos/
│   ├── vendas/
│   ├── estoque/
│   └── layouts/
│
├── core/
│   ├── Controller.php
│   ├── Model.php
│   ├── Database.php
│   └── Router.php
│
public/
├── css/
├── js/
├── images/
└── index.php

config/
└── conexao.php
````

## Módulos iniciais

- Cadastro de Produtos
- Controle de Estoque
- PDV (Ponto de Venda)
- Histórico de Vendas
- Movimentações de Estoque
- Relatórios básicos



# Fluxo do Estoque

## Entrada Manual

````
Produto
 ↓
Quantidade
 ↓
Salvar
 ↓
Movimentação ENTRADA
 ↓
Atualiza estoque
````

## Saída por Venda
````
Venda realizada
 ↓
Itens venda
 ↓
Baixa automática
 ↓
Movimentação SAIDA
 ↓
Atualiza estoque
````
# CRUD de Produtos
## Tela de Cadastro

### Campos:
````
Código
Descrição
Custo
Preço Venda
Quantidade Inicial
Status
````
### Botões:
````
Salvar
Limpar
Cancelar
````
## Tela de Listagem
````
Pesquisar

ID
Código
Descrição
Preço
Estoque

[Editar]
[Excluir]
````

## Tela de Edição
````
Código
Descrição
Custo
Preço Venda

[Atualizar]
````

# Tela Básica do PDV

### Layout:
````
---------------------------------------------------
| CÓDIGO PRODUTO [_____________] [Adicionar]     |
---------------------------------------------------

| Produto         | Qtd | Valor | Subtotal      |
---------------------------------------------------
| Produto A       |  2  | 10,00 | 20,00         |
| Produto B       |  1  | 15,00 | 15,00         |
---------------------------------------------------

TOTAL: R$ 35,00

Forma Pagamento:

( ) Dinheiro
( ) Cartão
( ) Pix

[Finalizar Venda]
[Cancelar]
````

# Processo de Venda

### 1. Localiza Produto
````
SELECT *
FROM produtos
WHERE codigo = '123';
````

### 2. Adiciona Item
````
$subtotal = $quantidade * $produto['preco_venda'];
````

### 3. Finaliza Venda
````
Grava venda
 ↓
Grava itens
 ↓
Movimenta estoque
 ↓
Atualiza saldo
 ↓
Emite comprovante simples
````
# Controle de Estoque

### Tela
````
Produto
Saldo Atual
Entrada
Saída
Última Movimentação

[Movimentar]
````

### Consulta 
````
SELECT
p.descricao,
p.estoque,
m.tipo,
m.quantidade,
m.data_movimento
FROM produtos p
LEFT JOIN movimentacoes_estoque m
ON p.id = m.produto_id;
````

# Relatórios Educacionais

## Relatório de Produtos
````
SELECT *
FROM produtos;
````

## Produtos Sem Estoque
````
SELECT *
FROM produtos
WHERE estoque <= 0;
````

## Vendas por Período
````
SELECT
DATE(data_venda),
SUM(total)
FROM vendas
GROUP BY DATE(data_venda);
````

# Backup em PHP

## Comando Mysqldump
````
$arquivo = 'backup_' . date('YmdHis') . '.sql';

exec(
    "mysqldump -u root -pSENHA estoque_pdv > backup/$arquivo"
);
````

## Controller
````
class BackupController
{
    public function gerarBackup()
    {
        // execução do backup
    }
}
````

# Versão 1.0

- ✅ CRUD Produtos
- ✅ Controle Estoque
- ✅ PDV Simples
- ✅ Vendas
- ✅ Backup

# Estrutura das Rotas
````
/produtos
/produtos/novo
/produtos/editar/{id}
/produtos/excluir/{id}

/estoque
/estoque/movimentar

/pdv
/pdv/finalizar

/vendas
/vendas/detalhes/{id}

/backup
````
