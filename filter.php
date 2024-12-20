<?php
$items = ['Apple', 'Banana', 'Orange', 'Grapefruit', 'Mango', 'Pineapple'];
$search = isset($_POST['search']) ? strtolower($_POST['search']) : '';  // Get search term


$filtered_items = array_filter($items, function ($item) use ($search) {
    return $search === '' || str_contains(strtolower($item), $search);
});

echo "<ul>";
foreach ($filtered_items as $item) {
  echo "<li>$item</li>";
}
echo "</ul>";

?>
