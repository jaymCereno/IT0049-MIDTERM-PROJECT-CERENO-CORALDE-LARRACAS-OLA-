<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>
<?= $this->include('partials/navigation'); ?>
<h1>Add Product</h1>

<form method="post" enctype="multipart/form-data">

    <label>Product Name</label><br>
    <input type="text" name="name" required>

    <br><br>

    <label>Price</label><br>
    <input
        type="number"
        step="0.01"
        name="price"
        required
    >

    <br><br>

    <label>Stock Quantity</label><br>
    <input
        type="number"
        name="stock_quantity"
        required
    >

    <br><br>

    <label>Image</label><br>
    <input type="file" name="image">

    <br><br>

    <button type="submit">
        Save Product
    </button>

</form>

</body>
</html>