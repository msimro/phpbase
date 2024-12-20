<?php

function getRecurringPayments($name, $amount, $frequency, $occur, $startDate) {
    $startDate = new DateTime($startDate);
    $today = new DateTime();
    $occurrences = [];
    $remainingAmount = $totalDue;

    // Define frequency intervals
    $intervals = [
        'monthly' => 'P1M',
        'weekly' => 'P1W',
        'bi-weekly' => 'P2W',
        'quarterly' => 'P3M',
        'every6 months' => 'P6M',
        'yearly' => 'P1Y',
        'onetime' => 'P0D'
    ];

    $interval = new DateInterval($intervals[$frequency]);
    $currentDate = $startDate;

    while ($currentDate <= $today) {
        $currentDate->add($interval);
    }

    while ($endDate === null || $currentDate <= new DateTime($endDate)) {
        $occurrences[] = [
            'index' => count($occurrences) + 1,
            'date' => $currentDate->format('d-m-y'),
            'day' => $currentDate->format('l'),
            'amount' => $amount,
            'remaining' => $remainingAmount
        ];
        $currentDate->add($interval);
        $remainingAmount -= $amount;
    }

    // Generate HTML table
    $html = '<table border="1"><tr><th>Index</th><th>Date</th><th>Day</th><th>Amount</th><th>Remaining Amount</th></tr>';
    foreach ($occurrences as $occurrence) {
        $html .= '<tr>';
        foreach ($occurrence as $value) {
            $html .= '<td>' . $value . '</td>';
        }
        $html .= '</tr>';
    }
    $html .= '</table>';

    return $html;
}

// Example usage
//echo getRecurringPayments('Subscription', 100, 'monthly', '2023-01-01', null, 1200);
// Example usage
echo getRecurringPayments('Subscription', 100, 'monthly', '2025-01-01', '2025-08-01', 1200);


?>