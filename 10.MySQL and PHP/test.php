<?php

$a = array(3, 1, 4, 1, 5, 9, 2, 6);

//$counter = 0;
//$aa = 0;
//
//function bubblesort($data, &$counter, &$aa)
//{
//    $data_length = count($data);
//    for ($i = 0; $i < $data_length; $i++) {
//        for ($j = 0; $j < $data_length - 1 - $i; $j++) {
//            if ($data[$j + 1] < $data[$j]) {
//                $data = swappositions($data, $j, $j + 1);
//                $counter++;
//            }
//        }
//    }
//    return $data;
//}
//
//$data = bubblesort($data, $counter, $aa);
//echo $counter . PHP_EOL;
//echo $aa;
//print_r($data);
//
//function swappositions($data, $left, $right)
//{
//    $backup_old_data_right_value = $data[$right];
//    $data[$right] = $data[$left];
//    $data[$left] = $backup_old_data_right_value;
//
//    return $data;
//}

$i = 0;
$j = 0;
$temp = 0;
for ($i = 0; $i < count($a); $i++) {
    $flag = 0;        //taking a flag variable
    for ($j = 0; $j < count($a) - $i - 1; $j++) {
        if ($a[$j] > $a[$j + 1]) {
            $temp = $a[$j];
            $a[$j] = $a[$j + 1];
            $a[$j + 1] = $temp;
            $flag += 1;
            echo $flag;
        }
    }
    if (!$flag)             //breaking out of for loop if no swapping takes place
    {
        break;
    }

}


?>