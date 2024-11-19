<?php


class Node 
{
    private $value;
    private $left;
    private $right;

    public function __construct(int $value)
    {
        $this->value = $value;
        $this->left = null;
        $this->right = null;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $value): void
    {
        $this->value = $value;
    }

    public function getLeft(): Node | null
    {
        return $this->left;
    }

    public function getRight(): Node | null
    {
        return $this->right;
    }

    public function setLeft(Node $node = null): Node
    {
        $this->left = $node;
        return $this;
    }

    public function setRight(Node $node = null): Node
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

    public function insertValue(int $value): Node 
    {
        return $this->addNode($this->root, $value);
    }

    public function searchValue(int $value): bool
    {
        return $this->searchNode($this->root, $value);
    }

    public function deleteValue(int $value): Node | null
    {
        return $this->deleteNode($this->root, $value);
    }

    public function getRoot(): Node
    {
        return $this->root;
    }

    private function addNode(Node $node, int $value): Node
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

    private function searchNode(Node $node = null, int $value): bool
    {
        if (is_null($node)) {
            return false;
        }

        if ($value == $node->getValue()) {
            return true;
        }

        if ($value < $node->getValue()) {
            return $this->searchNode($node->getLeft(), $value);
        }

        if ($value > $node->getValue()) {
            return $this->searchNode($node->getRight(), $value);
        }
    }

    private function findMinValue(Node $node): int
    {
        $current = $node;
        
        while ($current->getLeft() !== null) {
            $current = $current->getLeft();
        }
        return $current->getValue();
    }

    private function deleteNode(Node $node = null, int $value): Node | null
    {
        if (is_null($node)) {
            return null;
        }

        $nodeLeft = $node->getLeft();
        $nodeRight = $node->getRight();

        if (is_null($nodeLeft) && is_null($nodeRight)) {
            return null;
        }

        if ($value < $node->getValue()) {
            $nodeReturn = $this->deleteNode($nodeLeft, $value);
            
            if ( is_null($nodeReturn) ) {
                $node->setLeft(null);
            }

            return $node;
        }

        if ($value > $node->getValue()) {
            $nodeReturn = $this->deleteNode($nodeRight, $value);

            if ( is_null($nodeReturn) ) {
                $node->setRight(null);
            }

            return $node;
        }

        if (is_null($nodeLeft)) {
            return $nodeRight;
        }

        if (is_null($nodeRight)) {
            return $nodeLeft;
        }

        $minValue = $this->findMinValue($nodeRight);
        $node->setValue($minValue);
        $node->setRight($this->deleteNode($nodeRight, $minValue));
        
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
var_dump($tree->searchValue(201));

$tree->deleteValue(200);
// $tree->deleteValue(5);

drawTree($tree->getRoot());