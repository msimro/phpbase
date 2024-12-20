<?php

function displayHolidaysAndWeekends($year) {
    // Start output buffering
    ob_start();
    
    // Create a table for both holidays and weekends
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th>Type</th><th>Month</th><th>Date</th><th>Day of the Week</th></tr>";

    // List US Holidays
    $events = [];
    $holidays = [
        'New Year\'s Day' => "$year-01-01",
        'Martin Luther King Jr. Day' => date('Y-m-d', strtotime("third monday of January $year")),
        'Presidents\' Day' => date('Y-m-d', strtotime("third monday of February $year")),
        'Memorial Day' => date('Y-m-d', strtotime("last monday of May $year")),
        'Independence Day' => "$year-07-04",
        'Labor Day' => date('Y-m-d', strtotime("first monday of September $year")),
        'Columbus Day' => date('Y-m-d', strtotime("second monday of October $year")),
        'Veterans Day' => "$year-11-11",
        'Thanksgiving Day' => date('Y-m-d', strtotime("fourth thursday of November $year")),
        'Christmas Day' => "$year-12-25"
    ];

    foreach ($holidays as $holiday => $date) {
        $events[] = ['type' => 'Holiday', 'date' => $date, 'name' => $holiday];
    }

    // Find Weekend Dates
    for ($month = 1; $month <= 12; $month++) {
        $date = new DateTime("$year-$month-01");
        $daysInMonth = $date->format('t');

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date->setDate($year, $month, $day);
            if ($date->format('N') >= 6) {
                $events[] = ['type' => 'Weekend', 'date' => $date->format('Y-m-d'), 'name' => 'Weekend'];
            }
        }
    }

    // Sort events by date
    usort($events, function($a, $b) {
        return strtotime($a['date']) - strtotime($b['date']);
    });

    // Display events
    foreach ($events as $event) {
        $month = date('F', strtotime($event['date']));
        $day = date('j', strtotime($event['date']));
        $dayOfWeek = date('l', strtotime($event['date']));
        
        // Check if the event is a holiday or a weekend
        if ($event['type'] === 'Holiday') {
            echo "<tr><td><strong>{$event['name']}</strong></td><td>$month</td><td>$day</td><td>$dayOfWeek</td></tr>";
        } else {
            echo "<tr><td>{$event['name']}</td><td>$month</td><td>$day</td><td>$dayOfWeek</td></tr>";
        }
    }
    

    echo "</table>";
}

// Example usage
displayHolidaysAndWeekends(2025);
?>
