<?php

class ExpenseTracker {
    private $expenses = [];

    // Method to add an expense
    public function addExpense($amount, $category, $date) {
        $this->expenses[] = [
            'amount' => $amount,
            'category' => $category,
            'date' => new DateTime($date)
        ];
    }

    // Method to calculate total expenses for a given month
    public function calculateMonthlyExpenses($month, $year) {
        $total = 0;
        foreach ($this->expenses as $expense) {
            if ($expense['date']->format('m') == $month && $expense['date']->format('Y') == $year) {
                $total += $expense['amount'];
            }
        }
        return $total;
    }

    // Method to get spending insights
    public function getSpendingInsights($month, $year) {
        $categoryTotals = [];
        foreach ($this->expenses as $expense) {
            if ($expense['date']->format('m') == $month && $expense['date']->format('Y') == $year) {
                if (!isset($categoryTotals[$expense['category']])) {
                    $categoryTotals[$expense['category']] = 0;
                }
                $categoryTotals[$expense['category']] += $expense['amount'];
            }
        }
        return $categoryTotals;
    }
}

// Example usage
$tracker = new ExpenseTracker();
$tracker->addExpense(50, 'Groceries', '2023-10-01');
$tracker->addExpense(20, 'Transport', '2023-10-05');
$tracker->addExpense(100, 'Entertainment', '2023-10-10');

$totalExpenses = $tracker->calculateMonthlyExpenses('10', '2023');
$insights = $tracker->getSpendingInsights('10', '2023');

echo "Total Expenses for October 2023: $" . $totalExpenses . "\n";
echo "Spending Insights: \n";
print_r($insights);

?>
