<?php
/**
 * Created by PhpStorm.
 * User: jimersylee
 * Date: 17-11-29
 * Time: 下午2:18
 */

class Node{
    public $value;
    public $left;
    public $right;
}




class Ergodic{
    /**
     * 前序遍历:先访问根节点,再遍历左子树,最后遍历右子树;并且在遍历左右子树时,仍需先遍历根节点,然后访问左子树,最后遍历右子树
     * @param $rootNode
     */
    public static function preOrder($rootNode){
        $stack=array();
        array_push($stack,$rootNode);
        while (!empty($stack)){
            $centerNode=array_pop($stack);
            echo $centerNode->vaule.' ';
            //先把右子树节点入栈,已确保左子树节点先出栈
            if($centerNode->right!=null){
                array_push($stack,$centerNode->right);
            }
            if($centerNode->left!=null){
                array_push($stack,$centerNode->left);
            }
        }
    }


    /**
     * 中序遍历:先遍历左子树,然后访问根节点,最后遍历右子树;并且在遍历子树的时候,仍然是先遍历左子树,然后根节点,最后遍历右子树
     * @param $rootNode
     */
    public static function  midOrder($rootNode){
        $stack=array();
        $centerNode=$rootNode;
        while (!empty($stack) || $centerNode!=null){
            //还存在父节点
            while ($centerNode!=null){
                array_push($stack,$centerNode);
                $centerNode=$centerNode->left;
            }
            $centerNode=array_pop($stack);
            echo $centerNode->value.' ';
            $centerNode=$centerNode->right;
        }

    }

    /**
     * 后序遍历:先遍历左子树,然后遍历右子树,最后访问根节点;同样,在遍历左右子树的时候先遍历左子树,右子树,根节点
     * @param $rootNode
     */
    public static function endOrder($rootNode){
        $pushStack=array();
        $visitStack=array();
        array_push($pushStack,$visitStack);

        while(!empty($pushStack)){
            $centerNode=array_pop($pushStack);
            array_push($visitStack,$centerNode);
            //左子树节点
        }

    }
}