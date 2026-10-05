<!DOCTYPE html>
<html>
<head>
    <title>Sales History</title>
</head>
<body>
    <?= $this->include('partials/navigation'); ?>
    <h1>Sales History</h1>

    <p>
        <a href="<?= site_url('sales/create'); ?>">
            Record New Sale
        </a>
    </p>

    <table border="1" cellpadding="10">
        <tr>
            <th>Product</th>
            <th>Customer</th>
            <th>Staff</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Date</th>
        </tr>

        <?php foreach ($sales as $sale): ?>
            <tr>
                <td><?= esc($sale['product_name']); ?></td>
                <td><?= esc($sale['customer_name'] ?? 'Walk-in Customer'); ?></td>
                <td><?= esc($sale['staff_name']); ?></td>
                <td><?= esc($sale['quantity']); ?></td>
                <td>₱<?= number_format((float) $sale['total_price'], 2); ?></td>
                <td><?= esc(date('M d, Y h:i A', strtotime($sale['created_at']))); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>