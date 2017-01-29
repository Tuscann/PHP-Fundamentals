<?php if (!empty($error)): ?>
    <h1><?= $error; ?></h1>
<?php endif; ?>
<form method="get">
    <div>
        Delimiter:
        <select name="delimiter">
            <?php foreach ($allowedDelimiters as $delimiter): ?>
                <option value="<?= $delimiter; ?>"><?= $delimiter; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        Names:
        <input type="text" name="names"/>
    </div>
    <div>
        Ages:
        <input type="text" name="ages"/>
    </div>
    <div>
        <input type="submit" name="filter" value="Filter!">
    </div>
</form>
<!---->
<?php //if (isset($name, $ages)): ?>
<!--    <table border="1">-->
<!--        <thead>-->
<!--        <tr>-->
<!--            <th>Name</th>-->
<!--            <th>Age</th>-->
<!--        </tr>-->
<!--        </thead>-->
<!--        <tbody>-->
<!--        --><?php //for ($i = 0; $i < count($names); $i++): ?>
<!--            <tr>-->
<!--                <td>--><?//= $names[$i]; ?><!--</td>-->
<!--                <td>--><?//= $ages[$i]; ?><!--</td>-->
<!--            </tr>-->
<!--        --><?php //endfor; ?>
<!--        </tbody>-->
<!--    </table>-->
<?// endif; ?>


