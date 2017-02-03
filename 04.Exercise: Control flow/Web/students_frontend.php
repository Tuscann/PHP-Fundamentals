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

<?php if (!empty($namesAges)): ?>
    <table border="1">
        <thead>
        <tr>
            <th>Names</th>
            <th>Ages</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($nameAgesPaged as $name => $age): ?>
            <tr>
                <td><?= $name; ?></td>
                <td><?= $age; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php if ($hasPrevious): ?>
        <a href="students.php?page=<?= $page - 1; ?>&<?= $queryString; ?>"> Previous </a>
        <?php if (!$hasNext): ?>
            <a href="students.php?page=<?= $page - 2; ?>&<?= $queryString; ?>">[<?= $page - 2; ?>]</a>
        <?php endif; ?>
        <a href="students.php?page=<?= $page - 1; ?>&<?= $queryString; ?>">[<?= $page - 1; ?>]</a>
    <?php endif; ?>
    <a style="color: red">[<?= $page; ?>]</a>
    <?php if ($hasNext): ?>
        <a href="students.php?page=<?= $page + 1; ?>&<?= $queryString; ?>">[<?= $page + 1; ?>]</a>
        <?php if (!$hasPrevious): ?>
            <a href="students.php?page=<?= $page + 2; ?>&<?= $queryString; ?>">[<?= $page + 2; ?>]</a>
        <?php endif; ?>
        <a href="students.php?page=<?= $page + 1; ?>&<?= $queryString; ?>"> Next </a>
    <?php endif; ?>
<?php endif; ?>






