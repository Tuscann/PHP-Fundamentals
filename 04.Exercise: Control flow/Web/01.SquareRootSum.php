<table border="1">
    <tr>
        <th>Number</th>
        <th>Square</th>
    </tr>
    <tbody>
    <?php
    $total = 0;
    for ($i = 0; $i <= 100; $i += 2) {
        $sqrt = round(sqrt($i), 2);
        $total += $sqrt;
        echo '<tr><td>' . $i . '<td>' . $sqrt . '</td>' . '</td></tr>';
    }
    echo '<tr><td><strong>' . "Total:" . '</strong><td>' . round($total, 2) . '</td>' . '</td></tr>';
    ?>
    </tbody>
</table>



