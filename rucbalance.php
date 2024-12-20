<?php

function generatePaymentSchedule($name, $amount, $frequency, $occur, $startDate) {
    $frequencies = [
        'monthly' => '1 month',
        'weekly' => '1 week',
        'bi-weekly' => '2 weeks',
        'quarterly' => '3 months',
        'every 6 months' => '6 months',
        'yearly' => '1 year',
        'onetime' => '0 days'
    ];

    $startDate = new DateTime($startDate);
    $today = new DateTime();
    $payments = [];
    $totalPaid = 0;

    for ($i = 0; $i < $occur; $i++) {
        $nextDate = clone $startDate;
        $nextDate->modify("+" . $frequencies[$frequency]);
        
        // Update totalPaid only if the payment date is in the past
        //if ($nextDate < $today) {
            $totalPaid += $amount;
        //}
    
        $payments[] = [
            'index' => $i + 1,
            'date' => $nextDate->format('d-m-Y'),
            'day_of_week' => $nextDate->format('l'),
            'amount' => $amount,
            'paid_till' => $totalPaid,
            'remaining' => ($occur - ($i + 1)) * $amount,
            'percentage_paid' => ($totalPaid / ($amount * $occur)) * 100,
            'is_next' => $nextDate >= $today // Mark the first upcoming payment as next
        ];
        $startDate = $nextDate;
    }  

    
    $firstUpcomingPaymentFound = false; // Track if the first upcoming payment has been found
    
    // Generate HTML table
    $html = "<h2>Payment Schedule</h2><table border='1'><tr><th>Index</th><th>Date</th><th>Day of Week</th><th>Amount</th><th>Paid Till</th><th>Remaining</th><th>Percentage Paid (%)</th></tr>";
    foreach ($payments as $row) {
        $cssClass = $row['is_next'] ? 'dew' : 'pad'; // Assign class based on payment status
        // Check if this is the first upcoming payment
        if ($row['is_next'] && !$firstUpcomingPaymentFound) {
            //$dateCell = "<strong>{$row['date']}</strong>";
            $cssClass .= ' nex';
            $firstUpcomingPaymentFound = true; // Mark that the first upcoming payment has been found
        } else {
            //$dateCell = $row['date'];
        }
        $dateCell = $row['date'];
        $html .= "<tr class='{$cssClass}'><td>{$row['index']}</td><td>{$dateCell}</td><td>{$row['day_of_week']}</td><td>{$row['amount']}</td><td>{$row['paid_till']}</td><td>{$row['remaining']}</td><td>" . number_format($row['percentage_paid'], 2) . "</td></tr>";
    }
    $html .= "</table>";

    return $html;
}

// Example usage
echo generatePaymentSchedule('Subscription', 50, 'monthly', 24, '2024-12-27');

?>
<style>
.pad{
    opacity:0.6;
}
.nex{
    font-weight:bold;
}
</style>