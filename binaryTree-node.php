<?php
/**
 * Created by PhpStorm.
 * User: jimersylee
 * Date: 17-11-29
 * Time: 上午10:57
 */


//二、二叉树的链表实现方式


/**
 * 二叉树的节点类
 */
class Node
{
    //索引 值 左孩子 右孩子 父节点
    public $index, $data, $lChild, $rChild, $parentNode;

    /**
     * Node constructor.
     * @param $index
     * @param $data
     * @param MyNode|null $parentNode
     * @param MyNode|null $lChild
     * @param MyNode|null $rChild
     */
    function __construct($index, $data, Node $parentNode = null, Node $lChild = null, Node $rChild = null)
    {

        $this->index = $index;
        $this->data = $data;
        $this->lChild = $lChild;
        $this->rChild = $rChild;
        $this->parentNode = $parentNode;
    }

    /**
     * 搜索节点
     * @param $nodeIndex
     * @return $this|Node|null
     */
    function searchNode($nodeIndex)
    {
        if ($this->index == $nodeIndex) {
            return $this;
        }
        if ($this->lChild != null) {
            if ($this->lChild->index == $nodeIndex) {
                return $this->lChild;
            } else {
                $tempNode = $this->lChild->searchNode($nodeIndex);
                if ($tempNode != null) {
                    return $tempNode;
                }
            }
        }
        if ($this->rChild != null) {
            if ($this->rChild->index == $nodeIndex) {
                return $this->rChild;
            } else {
                $tempNode = $this->rChild->searchNode($nodeIndex);
                if ($tempNode != null) {
                    return $tempNode;
                }
            }
        }
        return null;
    }

    /**
     * 节点的删除
     */
    function deleteNode()
    {
        if ($this->lChild != null) {
            $this->lChild->deleteNode();
        }
        if ($this->rChild != null) {
            $this->rChild->deleteNode();
        }
        if ($this->parentNode != null) {
            if ($this->parentNode->lChild === $this) {
                $this->parentNode->lChild = null;
            } elseif ($this->parentNode->rChild === $this) {
                $this->parentNode->rChild = null;
            }
        }
    }

    /**
     * 节点的前序遍历
     */
    function preOrderTraversal()
    {

        echo $this->data;
        if ($this->lChild != null) {
            $this->lChild->preOrderTraversal();
        }
        if ($this->rChild != null) {
            $this->rChild->preOrderTraversal();
        }
    }

    /**
     * 节点的中序遍历
     */
    function inOrderTraversal()
    {

        if ($this->lChild != null) {
            $this->lChild->inOrderTraversal();
        }
        echo $this->data;
        if ($this->rChild != null) {
            $this->rChild->inOrderTraversal();
        }
    }

    /**
     * 节点的后序遍历
     */
    function postOrderTraversal()
    {
        if ($this->lChild != null) {
            $this->lChild->postOrderTraversal();
        }
        if ($this->rChild != null) {
            $this->rChild->postOrderTraversal();
        }
        echo $this->data;
    }
}


class Tree
{
    private $root;


    /*
     *构造树并初始化根节点
     */
    function __construct($index, $data)
    {
        $this->root = new Node($index, $data);
    }


    /*
     * 搜索节点
     * @return this|Node|null
     */
    function searchNode($nodeIndex)
    {
        return $this->root->searchNode($nodeIndex);
    }


    /**
     * 增加节点
     * @param $nodeIndex
     * @param $direction 0:左边 1:右边
     * @param Node $node
     * @return bool
     */
    function addNode($nodeIndex, $direction, Node $node)
    {
        $searchResult = $this->root->searchNode($nodeIndex);
        if ($searchResult != null) {
            if ($direction == 0) {
                $searchResult->lChild = $node;
                $searchResult->lChild->parentNode = $searchResult;
            } elseif ($direction == 1) {
                $searchResult->rChild = $node;
                $searchResult->rChild->parentNode = $searchResult;
            }

            return true;
        } else {
            return false;
        }
    }


    /**
     * 删除节点
     * @param $nodeIndex
     */
    function deleteNode($nodeIndex)
    {
        if ($this->searchNode($nodeIndex) != null) {
            $this->searchNode($nodeIndex)->deleteNode();
        }
    }


    /*
     * 前序遍历,从上到下,从左到右
     */
    function preOrderTraversal()
    {
        $this->root->preOrderTraversal();
    }


    /**
     *
     * 中序遍历,从左到右
     */
    function InOrderTraversal()
    {
        $this->root->InOrderTraversal();
    }


    /*
     * 后序遍历,从左到右,从下到上
     */
    function PostOrderTraversal()
    {
        $this->root->PostOrderTraversal();
    }

}

//这种实现方式相对于以数组方式实现二叉树来说稍微复杂一点，首先，创建一个节点类，节点类属性有索引(index)、数据(data)、左孩子、右孩子、父节点，再创建一个二叉树类，有些在二叉树类中相对难以实现的方法我们可以放到节点类中去实现。


//应用
$tree = new Tree(0, "first");

$lnode = new Node(0, "secondL");
$rnode = new Node(0, "secondR");
$l3node = new Node(1, "thirdL");
$r3node = new Node(1, "thirdR");

$tree->addNode(0, 0, $lnode);
$tree->addNode(0, 1, $rnode);

//$tree->searchNode(0)->setLeft($l3node);
//$tree->searchNode(0)->setRight($r3node);


$tree->InOrderTraversal();
echo "<br>";
$tree->PostOrderTraversal();
echo "<br>";
$tree->PreOrderTraversal();
echo "<br>";
