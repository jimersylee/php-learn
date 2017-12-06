<?php
/*
Author:Jimersy Lee
Time:2016-9-26 上午 10:28
Description:测试其他模块的控制器,如果其他模块的控制器使用了ajaxReturn()方法,则需要将此控制器文件复制到UnitTest目录下
Action:add
*/



//如果要以try catch方式截获单元测试的结果,则use此类,同时在核心Controller中,将ajaxReturn()方法选择为支持try catch的

class SortController
{

    private $arr = array(3, 5, 8, 4,9, 6, 1, 7, 2);


    public function test()
    {
        echo "hello<br>";

        //echo implode(" ",$this->bubbleSort($this->arr))."<br>";

        echo '冒泡排序：<br>';
        var_dump($this->bubbleSort($this->arr));
        echo "<br>";


        echo '快速排序:<br>';
        var_dump($this->quickSort($this->arr));
        echo "<br>";

    }


    /**
     * 冒泡排序
     * @param $arr
     */
    public function bubbleSort($arr)
    {
        $length = count($arr);
        if ($length <= 1) {
            return $arr;
        }
        //该层循环控制,需要冒泡的次数
        for ($i = 0; $i < $length; $i++) {
            //该层控制每轮冒出一个数,需要比较的次数
            //从最后一个数开始
            for ($j = $length - 1; $j > $i; $j--) {
                if ($arr[$j] < $arr[$j - 1]) {
                    $tmp = $arr[$j];
                    $arr[$j] = $arr[$j - 1];
                    $arr[$j - 1] = $tmp;
                }
            }
        }

        return $arr;
    }


    /**
     * 选择排序(不稳定)
     */

    public function selectSort($arr)
    {
        $length = count($arr);
        if ($length <= 1) {
            return $arr;
        }

        for ($i = 0; $i < $length; $i++) {
            $min = $i;//假设第一个数最小
            for ($j = $i + 1; $j < $length; $j++) {
                if ($arr[$j] < $arr[$min]) {
                    $min = $j;//最小的索引变成j
                }
            }

            //如果最小值的索引改变,将最小值放到索引i的位置
            if ($i != $min) {
                $tmp = $arr[$i];
                $arr[$i] = $arr[$min];
                $arr[$min] = $tmp;
            }

        }

        return $arr;

    }

    /**
     * 快速排序
     * 选择一个基准元素，通常选择第一个元素或者最后一个元素。通过一趟扫描，将待排序列分成两部分，一部分比基准元素小，一部分大于等于基准元素。此时基准元素在其排好序后的正确位置，然后再用同样的方法递归地排序划分的两部分。
     */

    public function quickSort($arr)
    {
        //先判断是否还需要继续进行
        $length = count($arr);
        if ($length <= 1) {
            return $arr;
        }
        //选择第一个元素作为基准
        $baseNum = $arr[0];
        //遍历除了基准数之外的所有元素,按照大小关系放入两个数组内
        //初始化两个数组
        $leftArr = array();//小于基准的
        $rightArr = array();//大于基准的
        for ($i = 1; $i < $length; $i++) {
            if ($baseNum > $arr[$i]) {
                //基准数大于这个位置的数,放入左边
                $leftArr[] = $arr[$i];
            } else {
                //放入右边
                $rightArr[] = $arr[$i];
            }
        }

        //再分别对左边右边的数组进行相同的排序处理方式递归调用这个函数
        $leftArr = $this->quickSort($leftArr);
        $rightArr = $this->quickSort($rightArr);

        //合并
        return array_merge($leftArr, array($baseNum), $rightArr);
    }


    /**
     * 二分查找
     * @param $arr:排序好的数组
     * @param $low:起始位置
     * @param $high:结束位置
     * @param $key:值
     * @return int
     */
    public function binarySearch($arr, $low, $high, $key)
    {
        while ($low <= $high) {
            $mid = intval(($low + $high) / 2);
            if ($key == $arr[$mid]) {
                return $mid + 1;
            }elseif ($key<$arr[$mid]){
                $high=$mid-1;
            }elseif($key>$arr[$mid]){
                $low=$mid+1;
            }
        }

        return -1;
    }


}