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

function drawTree($node, $prefix = '', $isLeft = true) {
    if ($node === null) {
        return;
    }

    echo $prefix;

    echo $isLeft ? "├── " : "└── ";

    echo $node->getValue() . "\n";

    $newPrefix = $prefix . ($isLeft ? "│   " : "    ");

    drawTree($node->getLeft(), $newPrefix, true);
    drawTree($node->getRight(), $newPrefix, false);
}


$node = new Node(10);
$tree = new BinarySearchTree($node);

$tree->insertValue(12);
$tree->insertValue(5);
$tree->insertValue(9);
$tree->insertValue(20);
$tree->insertValue(21);
$tree->insertValue(30);

drawTree($tree->getRoot());
