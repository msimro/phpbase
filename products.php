<?php

// Sample product data (replace with your database logic)
$products = [
    ['price' => 10, 'item' => 'Apple'],
    ['price' => 75, 'item' => 'Banana'],
    ['price' => 15, 'item' => 'Orange'],
    ['price' => 20, 'item' => 'Grape'],
];

$action = isset($_GET['action']) ? $_GET['action'] : 'list';

// Sorting for initial load AND after updates
if (($action === 'list') && isset($_GET['sort']) && ($_GET['sort'] === 'price')) {
    usort($products, function ($a, $b) {
        return $a['price'] - $b['price'];
    });
}

switch ($action) {
    case 'list':
        // Output the entire table body
        $output = "";
        foreach ($products as $product) {
            $output .= "<tr>";
            $output .= "<td class='editable' hx-get='products.php?action=edit&id={$product['item']}&sort=price' hx-target='closest tr' hx-swap='outerHTML'>{$product['price']}</td>";
            $output .= "<td>{$product['item']}</td>";
            $output .= "</tr>";
        }
        echo $output;
        break;

    case 'edit':
        $id = $_GET['id'];
        $item = array_values(array_filter($products, function ($product) use ($id) {
            return $product['item'] === $id;
        }))[0];

        ?>
        <tr>
            <td>
                <input type="number" name="price" value="<?= $item['price'] ?>"
                       hx-post="products.php?action=update&id=<?= $item['item'] ?>&sort=price" hx-target="#product-list"
                       hx-swap="innerHTML">
            </td>
            <td><?= $item['item'] ?></td>
        </tr>
        <?php
        break;

    case 'update':
        $id = $_GET['id'];
        $newPrice = (float)$_POST['price'];

        foreach ($products as &$product) {
            if ($product['item'] === $id) {
                $product['price'] = $newPrice;
                break;
            }
        }
        unset($product);

        // Sort after update
        usort($products, function ($a, $b) {
            return $a['price'] - $b['price'];
        });

        // Output the ENTIRE table body
        $output = "";
        foreach ($products as $product) {
            $output .= "<tr>";
            $output .= "<td class='editable' hx-get='products.php?action=edit&id={$product['item']}&sort=price' hx-target='closest tr' hx-swap='outerHTML'>{$product['price']}</td>";
            $output .= "<td>{$product['item']}</td>";
            $output .= "</tr>";
        }
        echo $output;
        break;


    default:
        echo "Invalid action.";
}

?>
