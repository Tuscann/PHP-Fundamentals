<?php
$money = 0;
$currency = "";

try {
    if (isset($_GET['Calculate']) == true) {

        $validCurrencies = ['USD' => '$', 'BGN' => 'лв.', 'EUR' => '€'];
        $validPeriods = [6, 12, 24, 60];

        $money = filter_var($_GET['money'], FILTER_VALIDATE_INT);
        if ($money === false) {
            throw new Exception("Invalid amount supplied");
        }

        $currency = $_GET['currency'];
        if (!array_key_exists($currency, $validCurrencies)) {
            throw new Exception("Invalid currency type");
        }
        $sign = $validCurrencies[$currency];


        $interest = filter_var($_GET['interest'], FILTER_VALIDATE_INT);
        if ($interest === false) {
            throw new Exception("Invalid interest");
        }

        $periods = filter_var($_GET['period'], FILTER_VALIDATE_INT);
        if ($periods === false || !in_array($periods, $validPeriods)) {
            throw new Exception("Invalid period");
        }

        $calculateMoney = $money + (($money * $interest) / $periods);
    }


} catch (Exception $e) {
    echo $e->getMessage();
}

?>


<?php if (isset($sign, $calculateMoney)): ?>
    <h1><?php echo $sign; ?><?php echo $calculateMoney; ?></h1>
<?php endif; ?>

<form>
    <div>
        <label for="money">Enter Amount</label>
        <input type="number" name="money" step="1" min="0" required>
    </div>
    <div>
        <input type="radio" id="usd" name="currency" value="USD">
        <label for="usd">USD</label>
        <input type="radio" id="eur" name="currency" value="EUR">
        <label for="eur">EUR</label>
        <input type="radio" id="bgn" name="currency" value="BGN">
        <label for="bgn">BGN</label>
    </div>
    <div>
        <label for="interest">
            Compound Interest Amount
        </label>
        <input type="number" name="interest" step="1" min="0" required>
    </div>
    <div>
        <select name="period">
            <option value="6">6 Months</option>
            <option value="12">1 Year</option>
            <option value="24">2 year</option>
            <option value="60">5 year</option>
        </select>

        <input type="submit" name="Calculate" value="Calculate">
    </div>
</form>