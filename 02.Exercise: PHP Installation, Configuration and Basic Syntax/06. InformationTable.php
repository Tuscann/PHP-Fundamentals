<form action="" method="get">
    Name: <input type="text" name="name"><br>
    Phone: <input type="number" name="phone"><br>
    Age: <input type="number" name="years"><br>
    Address: <input type="number" name="adress"><br>
    <input type="submit" name="submit">
</form>


<?php
$name = "";
$phone = "";
$age = "";
$address = "";


if (isset($_GET["submit"])) {

    $name = $_GET["name"];
    $phone = $_GET["phone"];
    $age = $_GET["years"];
    $address = $_GET["adress"];
}
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            text-indent: 5px;
            border-collapse: collapse;
        }

        table tr {
            border: 1px solid #000;
        }

        table th, table td {
            width: 115px;
            line-height: 25px;
            padding: 5px;
        }

        table th {
            text-align: left;
            background: #FFA100;
        }

        table td {
            text-align: right;
        }
    </style>
</head>
<body>
<table>
    <tbody>
    <tr>
        <th><strong>Name</strong></th>
        <td><?php echo $name; ?></td>
    </tr>
    <tr>
        <th><strong>Phone number</strong></th>
        <td><?php echo $phone; ?></td>
    </tr>
    <tr>
        <th><strong>Age</strong></th>
        <td><?php echo $age; ?></td>
    </tr>
    <tr>
        <th><strong>Address</strong></th>
        <td><?php echo $address; ?></td>
    </tr>
    </tbody>
</table>
</body>
</html>


