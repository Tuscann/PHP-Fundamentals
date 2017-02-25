<form method="Get">
    <label for=""> Enter tags: <br></label>
    <input type="text" name="tags">
    <input type="submit" name="add" value="Submit">
    <input type="submit" name="clear" value="Clear">
</form>


<?php
session_start();

if (isset($_GET['tags'])) {

    $tags = explode(', ', trim($_GET['tags']));

    if (isset($_SESSION["tags"]) == false) {
        $_SESSION['tags'] = array();
    }

    if (count($tags) > 0) {
        foreach ($tags as $tag) {
            if (array_key_exists($tag, $_SESSION['tags'])) {
                $_SESSION['tags'][$tag]++;
            } else {
                $_SESSION['tags'][$tag] = 1;
            }
        }
        $tags = $_SESSION["tags"];

        arsort($_SESSION['tags']);

        foreach ($_SESSION['tags'] as $key => $vale) {
            echo $key . ' : ' . $vale . ' times' . "<br>";
        }

        $biggest = key($tags);

        echo "<br>Most frequent tag is: " . $biggest;
    }

} else if (isset($_GET['clear'])) {
    session_destroy();

}
?>
