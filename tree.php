<?php


class Node 
{
    private $value;
    private $left;
    private $right;

    public function __construct(int $value = null, Node $left = null, Node $right = null)
    {
        $this->value = $value;
        $this->left = $left;
        $this->right = $right;
    }

    public function getValue() 
    {
        return $this->value;
    }

    public function getLeft() 
    {
        return $this->left;
    }

    public function getRight() 
    {
        return $this->right;
    }

    public function setLeft(Node $node) 
    {
        $this->left = $node;
        return $this;
    }

    public function setRight(Node $node)
    {
        $this->right = $node;
        return $this;
    }
}

class BinarySearchTree
{
    private $root;

    public function __construct(Node $node)
    {
        $this->root = $node;
    }

    public function insertValue(int $value): Node {
        return $this->addNode($this->root, $value);
    }

    public function getRoot() 
    {
        return $this->root;
    }

    private function addNode(Node $node, $value): Node
    {
        if ($value < $node->getValue()) {
            $leftNode = $node->getLeft() ?? new Node($value);
            return $node->setLeft($this->addNode($leftNode, $value));
        }

        if ($value > $node->getValue()) {
            $rightNode = $node->getRight() ?? new Node($value);
            return $node->setRight($this->addNode($rightNode, $value));
        }
        return $node;
    }
}

function drawTree($node) {
    $lines = [];
    populateLines($node, $lines, 0, 0, 50); // 50 é a posição inicial, pode ser ajustada
    foreach ($lines as $line) {
        echo $line . "\n";
    }
}

function populateLines($node, &$lines, $level, $position, $spacing) {
    if ($node === null) {
        return;
    }

    // Garante que o nível atual exista no array de linhas
    if (!isset($lines[$level])) {
        $lines[$level] = str_repeat(" ", 100); // 100 caracteres de largura para o terminal
    }

    // Calcula a posição do valor no nível
    $currentPos = $position + $spacing / 2;
    $value = (string)$node->getValue();

    // Substitui a posição com o valor do nó
    $lines[$level] = substr_replace($lines[$level], $value, (int)$currentPos, strlen($value));

    // Espaçamento para os filhos
    $nextSpacing = $spacing / 2;

    // Adiciona as conexões e os nós filhos
    populateLines($node->getLeft(), $lines, $level + 1, $position, $nextSpacing);
    populateLines($node->getRight(), $lines, $level + 1, $currentPos, $nextSpacing);
}


$node = new Node(100);
$tree = new BinarySearchTree($node);

$tree->insertValue(12);
$tree->insertValue(5);
$tree->insertValue(9);
$tree->insertValue(20);
$tree->insertValue(21);
$tree->insertValue(30);
$tree->insertValue(4);
$tree->insertValue(200);

drawTree($tree->getRoot());
