<?php

/**
 * Calculate the number of months required to pay off a debt.
 *
 * @param float $totalDebt The total amount of debt.
 * @param float $monthlyPayment The amount paid towards the debt each month.
 * @param float $annualInterestRate The annual interest rate (as a percentage).
 * @return int The number of months required to pay off the debt.
 */
function calculateDebtPayoffMonths($totalDebt, $monthlyPayment, $annualInterestRate) {
    // Convert annual interest rate to a monthly rate
    $monthlyInterestRate = ($annualInterestRate / 100) / 12;

    // Initialize the number of months
    $months = 0;

    // Loop until the debt is paid off
    while ($totalDebt > 0) {
        // Calculate interest for the current month
        $interestForMonth = $totalDebt * $monthlyInterestRate;

        // Update the total debt
        $totalDebt += $interestForMonth - $monthlyPayment;

        // Increment the month counter
        $months++;

        // If the monthly payment is less than the interest, break to avoid infinite loop
        if ($monthlyPayment <= $interestForMonth) {
            return -1; // Indicates that the debt cannot be paid off with the current payment
        }
    }

    return $months;
}

// Example usage
$totalDebt = 5000; // Total debt amount
$monthlyPayment = 200; // Monthly payment amount
$annualInterestRate = 5; // Annual interest rate in percentage

$monthsToPayOff = calculateDebtPayoffMonths($totalDebt, $monthlyPayment, $annualInterestRate);
if ($monthsToPayOff != -1) {
    echo "It will take " . $monthsToPayOff . " months to pay off the debt.";
} else {
    echo "The monthly payment is insufficient to cover the interest.";
}
?>
