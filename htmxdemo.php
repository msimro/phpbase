<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HTMX Editable Table with Sorting</title>
    <script src="https://unpkg.com/htmx.org@1.9.6"></script>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f2f2f2; cursor: pointer; } /* Sortable header */
        .editable { background-color: #f9f9f9; } /* Editable cells */
        .editing { background-color: #fff; }  /* Cell being edited */

    </style>
</head>
<body>

<table>
    <thead>
    <tr>
        <th hx-get="/sort" hx-target="tbody" hx-indicator="#sorting-indicator" _="on click set my.dataset.sort = 'price' then trigger load" >Price</th>  
        <th>Item</th>
        <!-- Other columns -->
    </tr>
    </thead>
    <tbody id="product-list">

    </tbody>
</table>
<div id="sorting-indicator" style="display:none;">Sorting...</div>



<script>
    // Initial data load (replace with your actual data fetching logic)
    document.body.onload = () => {
        loadProducts();
    }

   
const loadProducts = () => {
    htmx.ajax('GET', `products.php?sort=price`, { //add sort parameter
        target: '#product-list',
        swap: 'innerHTML', 
        indicator: '#sorting-indicator',
    });
}

</script>

</body>
</html>

