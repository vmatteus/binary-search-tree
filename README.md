# Binary Search Tree (BST)

Este projeto implementa uma Árvore Binária de Busca (BST) em PHP. Ele fornece uma estrutura de dados eficiente para armazenamento, busca, inserção e exclusão de valores. Além disso, suporta funcionalidades como inversão da árvore.

## Funcionalidades

### Classe Node

Esta classe representa um nó na árvore, contendo:

**Propriedades:**
- `value`: O valor do nó.
- `left`: Referência ao nó filho à esquerda.
- `right`: Referência ao nó filho à direita.

**Métodos:**
- `__construct(int $value)`: Inicializa o nó com um valor.
- `getValue()`, `setValue($value)`: Métodos de acesso ao valor do nó.
- `getLeft()`, `getRight()`: Recupera os nós filhos.
- `setLeft(Node $node)`, `setRight(Node $node)`: Define os nós filhos.

### Classe BinarySearchTree

Gerencia a estrutura da árvore binária, com as seguintes operações:

**Propriedades:**
- `root`: Nó raiz da árvore.

**Métodos:**
- `__construct(Node $node)`: Inicializa a árvore com um nó raiz.
- `insertValue(int $value)`: Insere um valor na árvore.
- `searchValue(int $value)`: Verifica se um valor existe na árvore.
- `deleteValue(int $value)`: Remove um valor da árvore.
- `getRoot()`: Retorna o nó raiz.
- `reverseTree()`: Inverte a árvore binária.
- `reverse(Node $node)`: Lógica auxiliar para inverter a árvore.

## Exemplo de Uso

```php
<?php

require_once 'tree.php';

// Criação do nó raiz
$root = new Node(10);

// Inicialização da árvore binária
$bst = new BinarySearchTree($root);

// Inserção de valores
$bst->insertValue(5);
$bst->insertValue(15);
$bst->insertValue(3);

// Busca de valores
if ($bst->searchValue(5)) {
    echo "Valor 5 encontrado na árvore.\n";
} else {
    echo "Valor 5 não encontrado.\n";
}

// Remoção de valores
$bst->deleteValue(5);

// Inversão da árvore
$bst->reverseTree();
```

## Pré-requisitos

- PHP >= 7.4 para suporte a tipagem e null coalescing.

## Estrutura do Projeto

```
/project-directory
├── tree.php      # Código-fonte principal
└── README.md     # Documentação do projeto
```

## Melhorias Futuras

- Adicionar balanceamento automático para evitar desbalanceamento excessivo.
- Implementar iterações em vez de recursão em operações críticas.
- Criar testes unitários com PHPUnit.