<?php

# Pay Days Generator

function getPayDays($year, $firstPayDate, $payFrequency, $payAmount) {
    $payDays = [];
    $currentDate = new DateTime($firstPayDate);
    $endDate = new DateTime("$year-12-31");
    
    while ($currentDate <= $endDate) {
        $payDays[] = [
            'month' => $currentDate->format('F'),
            'date' => $currentDate->format('jS'),
            'amount' => $payAmount
        ];
        
        if ($payFrequency === 'weekly') {
            $currentDate->modify('+1 week');
        } elseif ($payFrequency === 'bi-weekly') {
            $currentDate->modify('+2 weeks');
        } elseif ($payFrequency === 'monthly') {
            $currentDate->modify('+1 month');
        }
    }

    $monthlyTotals = [];
    foreach ($payDays as $payDay) {
        $monthlyTotals[$payDay['month']]['total'] = ($monthlyTotals[$payDay['month']]['total'] ?? 0) + $payDay['amount'];
        $monthlyTotals[$payDay['month']]['dates'][] = $payDay['date'];
    }

    echo "<table border='1'>";
    echo "<tr><th>#</th><th>Month</th><th>Date of Pay</th><th>Amount</th></tr>";
    $index = 1;
    foreach ($monthlyTotals as $month => $data) {
        foreach ($data['dates'] as $date) {
            echo "<tr><td>{$index}</td><td>{$month}</td><td>{$date}</td><td>{$payAmount}</td></tr>";
            $index++;
        }
        echo "<tr><td colspan='4'><strong>---------------------------------</strong></td></tr>";
    }
    echo "<tr><td colspan='2'><strong>Total:</strong></td><td colspan='2'><strong>" . array_sum(array_column($monthlyTotals, 'total')) . "</strong></td></tr>";
    echo "</table>";
}

// Example usage
getPayDays(2025, '2025-01-03', 'bi-weekly', 2400);

?>