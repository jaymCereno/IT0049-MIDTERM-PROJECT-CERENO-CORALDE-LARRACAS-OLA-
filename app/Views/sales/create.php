<!DOCTYPE html>
<html>
<head>
    <title>Record Sale</title>
</head>
<body>
    <?= $this->include('partials/navigation'); ?>
    <h1>Record Sale</h1>

    <?php if (session()->getFlashdata('success')): ?>
        <p style="color: green;">
            <?= session()->getFlashdata('success'); ?>
        </p>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <p style="color: red;">
            <?= session()->getFlashdata('error'); ?>
        </p>
    <?php endif; ?>

    <form action="<?= site_url('sales/create'); ?>" method="post">

        <p>
            <label for="sold_by">Staff:</label><br>
            <select name="sold_by" id="sold_by" required>
                <option value="">-- Select Staff --</option>

                <?php foreach ($users as $user): ?>
                    <option
                        value="<?= $user['id']; ?>"
                        <?= old('sold_by') == $user['id'] ? 'selected' : ''; ?>
                    >
                        <?= esc($user['full_name']); ?>
                    </option>
                <?php endforeach; ?>

            </select>
        </p>

        <p>
            <label for="product_id">Product:</label><br>
            <select name="product_id" id="product_id" required>
                <option value="">-- Select Product --</option>

                <?php foreach ($products as $product): ?>
                    <option
                        value="<?= $product['id']; ?>"
                        <?= old('product_id') == $product['id'] ? 'selected' : ''; ?>
                    >
                        <?= esc($product['name']); ?>
                        - ₱<?= number_format($product['price'], 2); ?>
                        (Stock: <?= $product['stock_quantity']; ?>)
                    </option>
                <?php endforeach; ?>

            </select>
        </p>

        <p>
            <label for="customer_id">Customer (Optional):</label><br>
            <select name="customer_id" id="customer_id">
                <option value="">-- Walk-in Customer --</option>

                <?php foreach ($customers as $customer): ?>
                    <option
                        value="<?= $customer['id']; ?>"
                        <?= old('customer_id') == $customer['id'] ? 'selected' : ''; ?>
                    >
                        <?= esc($customer['full_name']); ?>
                    </option>
                <?php endforeach; ?>

            </select>
        </p>

        <p>
            <label for="quantity">Quantity:</label><br>
            <input
                type="number"
                name="quantity"
                id="quantity"
                min="1"
                value="<?= old('quantity', 1); ?>"
                required
            >
        </p>

        <p>
            <button type="submit">Record Sale</button>
            <button
                type="button"
                onclick="window.location.href='<?= site_url('products'); ?>'"
            >
                Back to Products
            </button>
        </p>

    </form>

</body>
</html>