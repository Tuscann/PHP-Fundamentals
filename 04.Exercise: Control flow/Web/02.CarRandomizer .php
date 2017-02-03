<form action="" method="get">
    Enter cars:<input type="text" name="cars" required>
    <input type="submit" name="submit" value="Show results">
</form>


<?php

if (isset($_GET['submit']) &&!empty($_GET['cars']) ) {

    $inputArea = $_GET['cars'];
    $new = explode(', ', $inputArea);
    $color = array("red", "black", "green", "yellow", "pink");
}

?>
<?php if (isset($_GET['submit']) &&!empty($_GET['cars']) ):?>
<table border="1">
    <thead>
    <th>Car</th>
    <th>Color</th>
    <th>Count</th>
    </thead>
    <tbody>
    <?php foreach ($new as $car): ?>
        <tr>
            <td><?=  htmlentities($car); ?></td>
            <td><?= $color[array_rand($color, 1)]; ?></td>
            <td><?= rand(1, 5); ?></td>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>
<?php endif;?>