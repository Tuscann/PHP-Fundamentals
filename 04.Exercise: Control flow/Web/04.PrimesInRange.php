<!--Test using Xamp or Lamp JetBrains server not work with Post-->


<form action="" method="post">
    <label>Starting Index:</label>
    <input type="number" name="start" required>
    <label>End:</label>
    <input type="number" name="end" required>
    <input type="submit" name="submit" value="Submit">
</form>


<?php

$_POST = array(); //workaround for broken PHPstorm
parse_str(file_get_contents('php://input'), $_POST);  //workaround for broken PHPstorm

if (isset($_POST['start']) && isset($_POST['end']) &&
    !empty(trim($_POST['start'])) && !empty(trim($_POST['end'])) &&
    is_numeric($_POST['start']) && is_numeric($_POST['end']) &&
    intval($_POST['start']) < intval($_POST['end'])
) {

    $start = intval(htmlentities($_POST['start']));
    $end = intval(htmlentities($_POST['end']));


    function isPrime($num)
    {
        for ($i = 2; $i <= sqrt($num); $i++) {
            if ($num % $i == 0) {
                return false;
            }
        }
        return true;
    }


    for ($i = $start; $i <= $end; $i++) {

        if ($i > 1 && isPrime($i)) {
            echo "<b>$i</b>" . ", ";
        } else {
            echo $i . ',  ';
        }
    }


}

