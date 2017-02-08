<!doctype html>
<html lang="en">
<head>
    <title>Calculator</title>
</head>
<body>
<form method="get">
    <p>
        <label>
            Operation:
            <select name="operation">
                <option value="sum">Sum</option>
                <option value="subtract">Subtract</option>
            </select>
        </label>
    </p>
    <p>
        <label>
            Number 1:
            <input type="number" name="number_one">
        </label>
    </p>
    <p>
        <label>
            Number 2:
            <input type="number" name="number_two">
        </label>
    </p>
    <?php if (isset($output)) : ?>
        <p>
            Result:
            <input type="text" disabled="disabled" readonly="readonly" value="<?= $output; ?>">
        </p>
    <?php endif; ?>
    <p>
        <input type="submit" name="calculate" value="Calculate!">
    </p>
</form>
</body>
</html>