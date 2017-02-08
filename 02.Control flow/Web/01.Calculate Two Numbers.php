<form>
    <div>
        Operation:
        <select name="operation">
            <option value="sum">Sum</option>
            <option value="substract">Subtract</option>
        </select>
    </div>
    <div>
        Number:1
        <input type="number" name="num1">
    </div>
    <div>
        Number:2
        <input type="number" name="num2">
    </div>

<?php

function renderResult($result){
    if(!empty($_GET['calculate'])){
        echo "<div>Result:";
        echo "<input type='text' disabled='disabled' value='".$result."'/>";
        echo "</div>";
    }
}
if (isset($_GET['calculate'])) {
    $operation = $_GET['operation'];
    $numberOne = intval($_GET['num1']);
    $numberTwo = intval($_GET['num2']);

    if ($operation == 'sum') {
         renderResult($numberOne + $numberTwo);
    }
    else if($operation == 'substract') {
        renderResult($numberOne - $numberTwo);
    }
    else{
        renderResult("Invalid Operation");
    }
}
else{
    renderResult("");
}
?>
    <div><input type="submit" name="calculate" value="Calculate!"></div>
</form>





