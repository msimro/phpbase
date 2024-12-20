<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HTMX Filtering Demo</title>
    <script src="https://unpkg.com/htmx.org@1.9.6"></script>
</head>
<body>

<h1>Item Filter</h1>

<input type="text" name="search" hx-post="filter.php" hx-target="#items" hx-indicator="#loading">

<div id="loading" style="display:none;">Filtering...</div>

<div id="result"></div>

<ul id="items">
    <?php  // Initial items (you would typically load these from a database)
        $items = ['Apple', 'Banana', 'Orange', 'Grapefruit', 'Mango', 'Pineapple'];
        foreach ($items as $item) {
            echo "<li>$item</li>";
        }

    ?>

</ul>

</body>
</html>
