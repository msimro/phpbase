<?php

/**
 * Calculate Compound Interest
 *
 * @param float $principal The initial amount of money
 * @param float $rate The annual interest rate (in percentage)
 * @param int $time The number of years the money is invested or borrowed
 * @param int $n The number of times that interest is compounded per year
 * @return float The amount of money accumulated after n years, including interest.
 */
function calculateCompoundInterest($principal, $rate, $time, $n) {
    // Convert the annual interest rate from percentage to decimal
    $rateDecimal = $rate / 100;

    // Calculate the compound interest using the formula
    $amount = $principal * pow((1 + $rateDecimal / $n), $n * $time);

    return round($amount, 2); // Round to 2 decimal places for currency format
}

// Example usage
$principal = 20000; // Initial investment
$rate = 4.5; // Annual interest rate
$time = 10; // Investment duration in years
$n = 1; // Compounded quarterly

$totalAmount = calculateCompoundInterest($principal, $rate, $time, $n);
echo "Total amount after $time years: $" . $totalAmount;

?>
