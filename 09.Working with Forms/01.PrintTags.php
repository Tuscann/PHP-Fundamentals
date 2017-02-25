<form action="" method="get">
    <div>
        <label for="">Enter Tags:</label>
    </div>
    <div>
        <input type="text" name="text" checked>
    </div>
    <input type="submit" name="submit" value="Submit">
</form>

<?php
if (empty($_GET['text'])) {
    throw new Exception("Data is not filled");
}

if (isset($_GET['submit']) and !empty($_GET['text'])) {
    $date = $_GET['text'];
    $input = explode(", ", $date);

    for ($i = 0; $i < count($input); $i++) {
        echo $i . " : " . htmlentities($input[$i]) . "<br>";
    }


}
