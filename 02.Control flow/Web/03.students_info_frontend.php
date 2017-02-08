<!doctype html>
<html lang="en">
<head>
    <title>Students Info</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <style>
        table {
            border-collapse: collapse;
        }

        td, th {
            border: 1px solid #333;
            padding: 0.2em;
        }

        a, a:visited, a:active {
            color: mediumspringgreen;
        }

        span.current-page {
            color: red;
        }
    </style>
</head>
<body>
<form method="get">
    <p>
        <label>
            Delimiter:
            <select name="delimiter">
                <option value=",">,</option>
                <option value="|">|</option>
                <option value="&">&</option>
            </select>
        </label>
    </p>
    <p>
        <label>
            Names:
            <input type="text" name="names" id="names">
        </label>
    </p>
    <p>
        <label>
            Ages:
            <input type="text" name="ages" id="ages">
        </label>
    </p>
    <p>
        <input type="submit" name="filter" value="Filter!">
        <input type="button" id="fill-sample-values" value="Fill Sample Values">
    </p>
</form>
<?php if (isset($names, $ages)) : ?>
    <table>
        <tr>
            <th>Name</th>
            <th>Age</th>
        </tr>
        <?php for ($i = 0; $i < count($names); $i++) : ?>
            <tr>
                <td><?= $names[$i] ?></td>
                <td><?= $ages[$i] ?></td>
            </tr>
        <?php endfor; ?>
        <tr>
            <th>Page</th>
            <th><?= $_SESSION['current_page'] ?></th>
        </tr>
    </table>

    <p>
        <?php if ($_SESSION['current_page'] > 1): ?>
            <a href="?page=<?= $_SESSION['current_page'] - 1 ?>">[Previous]</a>
        <?php endif; ?>
        <?php
        $startPage = max($_SESSION['current_page'] - 1, 1);
        $endPage = min($_SESSION['current_page'] + 1, $_SESSION['pages']);
        if($startPage == 1 && $_SESSION['pages'] > 2) {
            $endPage = 3;
        }

        if($endPage == $_SESSION['pages'] && $_SESSION['pages'] > 2) {
            $startPage = $_SESSION['pages'] - 2;
        }
        ?>
        <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
            <?php if ($_SESSION['current_page'] != $i) : ?>
                <a href="?page=<?= $i ?>">[<?= $i ?>]</a>
            <?php else: ?>
                <span class="current-page">[<?= $i ?>]</span>
            <?php endif; ?>
        <?php endfor; ?>
        <?php if ($_SESSION['current_page'] < $_SESSION['pages']): ?>
            <a href="?page=<?= $_SESSION['current_page'] + 1 ?>">[Next]</a>
        <?php endif; ?>
    </p>
<?php endif; ?>

<script>
    $(function() {
        $('#fill-sample-values').click(function(){
            $('#names')
                .val('Ivan,Dimitur,Sonya,Pesho,Gosho,Filip,Nikolay,Cvetan,Hristina,Mariya,Lidiya,Mima,' +
                'Ivan,Dimitur,Sonya,Pesho,Gosho,Filip,Nikolay,Cvetan,Hristina,Mariya,Lidiya,Mima');

            $('#ages')
                .val('16,19,21,32,35,23,13,24,31,36,23,28,16,19,21,32,35,23,13,24,31,36,23,28');
        });
    });
</script>
</body>
</html>