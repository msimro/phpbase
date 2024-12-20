<?php

function fetchStockPrices($symbols) {
    $apiUrl = "https://query1.finance.yahoo.com/v7/finance/quote?symbols=" . implode(',', $symbols);
    $response = file_get_contents($apiUrl);
    $data = json_decode($response, true);

    if (isset($data['quoteResponse']['result'])) {
        $stocks = $data['quoteResponse']['result'];
        echo "<table border='1'>";
        echo "<tr><th>Symbol</th><th>Current Price</th><th>Open</th><th>High</th><th>Low</th></tr>";

        foreach ($stocks as $stock) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($stock['symbol']) . "</td>";
            echo "<td>" . htmlspecialchars($stock['regularMarketPrice']) . "</td>";
            echo "<td>" . htmlspecialchars($stock['regularMarketOpen']) . "</td>";
            echo "<td>" . htmlspecialchars($stock['regularMarketDayHigh']) . "</td>";
            echo "<td>" . htmlspecialchars($stock['regularMarketDayLow']) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No data found for the provided symbols.";
    }
}

// Example usage
$symbols = ['AAPL', 'GOOGL', 'MSFT'];
fetchStockPrices($symbols);

?>