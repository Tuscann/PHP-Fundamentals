<form action="">
    Categories:
    <input type="text" name="categories" required><br>
    Tags:
    <input type="text" name="tags" required><br>
    Months:
    <input type="text" name="months" required><br>
    <input type="submit" name="input" value="Generate" required>
</form>
<?php

if (isset($_GET['categories'])) {

    $categories = trim($_GET['categories']);
    $Categories = explode(", ", $categories);

    $tags = trim($_GET['tags']);
    $Tags = explode(", ", $tags);

    $months = trim($_GET['months']);
    $Months = explode(", ", $months);

    echo "<h2>" . "Categories" . "</h2><ul>";
    foreach ($Categories as $key) {
        echo "<li>" . $key . "</li>";
    }
    echo "</ul><h2>" . "Tags" . "</h2><ul>";
    foreach ($Tags as $key) {
        echo "<li>" . $key . "</li>";
    }
    echo "</ul><h2>" . "Months" . "</h2><ul>";
    foreach ($Months as $key) {
        echo "<li>" . $key . "</li>";
    }
    echo "</ul>";
}