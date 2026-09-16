<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>

<h1>Edit Product</h1>

<form method="post" enctype="multipart/form-data">

    <label>Name</label><br>
    <input
        type="text"
        name="name"
        value="<?= $product['name']; ?>"
        required
    >

    <br><br>

    <label>Price</label><br>
    <input
        type="number"
        step="0.01"
        name="price"
        value="<?= $product['price']; ?>"
        required
    >

    <br><br>

    <label>Stock Quantity</label><br>
    <input
        type="number"
        name="stock_quantity"
        value="<?= $product['stock_quantity']; ?>"
        required
    >

    <br><br>

    <label>New Image (Optional)</label><br>
    <input type="file" name="image">

    <br><br>

    <button type="submit">
        Update Product
    </button>

</form>

</body>
</html>