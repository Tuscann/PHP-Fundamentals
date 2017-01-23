<?php
/**
 * Created by PhpStorm.
 * User: az
 * Date: 1/23/17
 * Time: 10:58 PM
 */

$maxInteger = 9223372036854775807;
echo gettype($maxInteger)."<br>"; // integer
$maxInteger += 1;
echo gettype($maxInteger); // double