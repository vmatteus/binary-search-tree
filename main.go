package main

import (
	"fmt"
)

// Node representa um nó da árvore binária.
type Node struct {
	Value int
	Left  *Node
	Right *Node
}

// BST é a estrutura da árvore binária de busca.
type BST struct {
	Root *Node
}

// Insert adiciona um valor à árvore binária de busca.
func (bst *BST) Insert(value int) {
	bst.Root = insertNode(bst.Root, value)
}

func insertNode(node *Node, value int) *Node {
	if node == nil {
		return &Node{Value: value}
	}
	if value < node.Value {
		node.Left = insertNode(node.Left, value)
	} else if value > node.Value {
		node.Right = insertNode(node.Right, value)
	}
	return node
}

// Search busca um valor na árvore binária de busca.
func (bst *BST) Search(value int) bool {
	return searchNode(bst.Root, value)
}

func searchNode(node *Node, value int) bool {
	if node == nil {
		return false
	}
	if value == node.Value {
		return true
	} else if value < node.Value {
		return searchNode(node.Left, value)
	} else {
		return searchNode(node.Right, value)
	}
}

// Delete remove um nó da árvore binária de busca.
func (bst *BST) Delete(value int) {
	bst.Root = deleteNode(bst.Root, value)
}

func deleteNode(node *Node, value int) *Node {
	if node == nil {
		return nil
	}

	if value < node.Value {
		node.Left = deleteNode(node.Left, value)
	} else if value > node.Value {
		node.Right = deleteNode(node.Right, value)
	} else {
		// Caso 1: Nó com zero ou um filho.
		if node.Left == nil {
			return node.Right
		} else if node.Right == nil {
			return node.Left
		}

		// Caso 2: Nó com dois filhos.
		// Substituir pelo menor valor da subárvore direita (successor).
		minValue := findMin(node.Right)
		node.Value = minValue
		node.Right = deleteNode(node.Right, minValue)
	}

	return node
}

// findMin encontra o menor valor em uma subárvore.
func findMin(node *Node) int {
	current := node
	for current.Left != nil {
		current = current.Left
	}
	return current.Value
}

// InOrder exibe os valores da árvore em ordem.
func (bst *BST) InOrder() {
	inOrderTraversal(bst.Root)
	fmt.Println()
}

func inOrderTraversal(node *Node) {
	if node != nil {
		inOrderTraversal(node.Left)
		fmt.Printf("%d ", node.Value)
		inOrderTraversal(node.Right)
	}
}

func main() {
	tree := &BST{}

	// Inserindo valores na árvore.
	values := []int{50, 30, 70, 20, 40, 60, 80}
	for _, v := range values {
		tree.Insert(v)
	}

	// Exibindo a árvore em ordem.
	fmt.Println("Árvore em ordem antes da exclusão:")
	tree.InOrder()

	// Deletando valores.
	toDelete := []int{20, 30, 50}
	for _, v := range toDelete {
		fmt.Printf("Deletando valor %d...\n", v)
		tree.Delete(v)
		fmt.Println("Árvore em ordem após exclusão:")
		tree.InOrder()
	}
}
