<?php

function calculate_interest(float $apy = 0.0675, float $principal = 25000, int $days = 30): float {
    // Convert APY to a daily rate
    $daily_rate = pow(1 + $apy, 1/365) - 1;

    // Calculate interest
    $interest = $principal * $daily_rate * $days;

    return $interest;
}


// // Example usage with default values:
// $interest = calculate_interest();  // Uses default values for APY, principal, and days.
// echo "Interest accured (with defaults): $" . number_format($interest, 2) . PHP_EOL;

// // Example usage with different values:
// // $apy = 0.08; // 8% APY
// // $principal = 5000;
// // $days = 90;
// // $interest = calculate_interest($apy, $principal, $days);
// // echo "Interest earned: $" . number_format($interest, 2) . PHP_EOL;


function calculate_percentage_change(float $original_value, float $current_value): string {
    if ($original_value == 0) {
        return "N/A (original value is zero)"; // Handle division by zero
    }

    $change = $current_value - $original_value;
    $percentage_change = ($change / $original_value) * 100;

    $formatted_change = number_format($change, 2);
    $formatted_percentage = number_format($percentage_change, 2);

    if ($percentage_change > 0) {
        return "Gain: $" . $formatted_change . " (" . $formatted_percentage . "%)";
    } elseif ($percentage_change < 0) {
        return "Loss: $" . abs($formatted_change) . " (" . abs($formatted_percentage) . "%)"; // Show loss as positive
    } else {
        return "No Change (0%)";
    }
}


// Examples
echo calculate_percentage_change(100, 120) . PHP_EOL;      // Output: Gain: $20.00 (20.00%)
echo calculate_percentage_change(100, 80) . PHP_EOL;       // Output: Loss: $20.00 (20.00%)
echo calculate_percentage_change(100, 100) . PHP_EOL;      // Output: No Change (0%)
echo calculate_percentage_change(0, 100) . PHP_EOL;       // Output: N/A (original value is zero)
echo calculate_percentage_change(-100,-50).PHP_EOL;   // Gain: $50.00 (50.00%)


?>
