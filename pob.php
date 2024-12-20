<?php
# Monthly Overview for 2025

function displayMonthlyTable($year = 2025, $startingBalance = 20000, $monthlyExpenses = 3000, $monthlyIncome = 5000, $extraPercentage = 0.025) {
    $months = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];

    $balance = $startingBalance;
    $extraSum = 0;
    $totalSavings = 0;
    $totalExtras = 0;

    echo "<table border='1'>";
    echo "<tr><th>Month</th><th>Expenses</th><th>Income</th><th>Saving</th><th>Total Balance</th><th>Xtra</th><th>XtraSUM</th></tr>";

    foreach ($months as $month) {
        $saving = $monthlyIncome - $monthlyExpenses;
        $balance += $saving; // Update balance
        $extra = $balance * $extraPercentage;
        $extraSum += $extra; // Update extra sum
        
        $totalSavings += $saving;
        $totalExtras += $extra;

        echo "<tr>
                <td>{$month}</td>
                <td>{$monthlyExpenses}</td>
                <td>{$monthlyIncome}</td>
                <td>{$saving}</td>
                <td>{$balance}</td>
                <td>{$extra}</td>
                <td>{$extraSum}</td>
              </tr>";
    }

    echo "<tr>
            <td><strong>Total</strong></td>
            <td></td>
            <td></td>
            <td><strong>{$totalSavings}</strong></td>
            <td></td>
            <td><strong>{$totalExtras}</strong></td>
            <td></td>
          </tr>";

    echo "</table>";

    $netEarning = $totalSavings + $totalExtras;
    $grandTotal = $startingBalance + $netEarning;

    echo "Year: {$year}, Starting balance: {$startingBalance}, NetEarning: {$netEarning}, Grand Total: {$grandTotal}";
}

displayMonthlyTable();

?>
