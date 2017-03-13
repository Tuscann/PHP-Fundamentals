<form action="" method="get">
    <textarea name="dateOne"></textarea><br>
    <textarea name="dateTwo"></textarea><br>
    <textarea name="holidays"></textarea><br>
    <input type="submit" name="submit">
</form>


//<?php var_export($_GET); ?>
<?php
if (isset($_GET["submit"])) {

    $startDate = $_GET["dateOne"];
    $endDate = $_GET["dateTwo"];
    $restDays = trim($_GET["holidays"]);

//$startDate = fgets(STDIN);
//$endDate = fgets(STDIN);
//$restDays = fgets(STDIN);

    $holidays = preg_split("/\\s+/", $restDays, -1, PREG_SPLIT_NO_EMPTY);

    $start = new DateTime(trim($startDate));
    $end = new DateTime(trim($endDate));

    $end->modify('+1 day');

    $period = new DatePeriod($start, new DateInterval('P1D'), $end);

    $print = "";

    foreach ($period as $dt) {

        $curr = $dt->format('D');

        if ($curr == 'Sat' || $curr == 'Sun' || in_array($dt->format('d-m-Y'), $holidays)) {

        } else {
            $print .= "<li>" . $dt->format('d-m-Y') . "</li>";
        }
    }

    if (!empty($print)) {
        echo "<ol>" . $print . "</ol>";
    } else {
        echo "<h2>No workdays</h2>";
    }
}