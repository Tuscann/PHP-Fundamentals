<form action="" method="get">
    Name: <input type="text" name="name" placeholder="Name.."><br>
    Years: <input type="number" name="number" placeholder="Age.."><br>
    <input type='radio' name='gender' value='male'>Male<br>
    <input type='radio' name='gender' value='female'>Female<br>
    <input type="submit" name="submit">
</form>


<?php
if ((count($_GET) == 4) && isset($_GET["submit"])) {

    $name = htmlentities($_GET['name']);
    $age = intval(htmlentities($_GET['number']));
    $gender = htmlentities($_GET['gender']);

    echo "My name is {$name}. I am {$age} years old. I am {$gender}";
}
?>
