<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
</head>
<body>

<h1>Products</h1>

<p>
     ?>">
        Add Product
    </a>
</p>

<table border="1" cellpadding="10">

    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($products as $product): ?>

    <tr>

        <td><?= $product['id']; ?></td>

        <td><?= $product['name']; ?></td>

        <td><?= $product['price']; ?></td>

        <td><?= $product['stock_quantity']; ?></td>

        <td>

            <button
                onclick="window.location.href='<?= site_url('products/edit/' . $product['id']); ?>'">
                Edit
            </button>

            <button
                onclick="window.location.href='<?= site_url('products/delete/' . $product['id']); ?>'">
                Delete
            </button>

        </td>

    </tr>

    <?php endforeach; ?>

</table>

</body>
</html>