<!DOCTYPE html>
<html>

<head>
    <title>Customers</title>
</head>
<?= $this->include('partials/navigation'); ?>
<body>

    <h1>Customers</h1>

    <p>
        <button onclick="window.location.href='<?= site_url('customers/create'); ?>'">
            Add Customer
        </button>
    </p>

    <table border="1" cellpadding="10">

        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($customers as $customer): ?>

            <tr>

                <td><?= $customer['id']; ?></td>

                <td><?= $customer['full_name']; ?></td>

                <td><?= $customer['email']; ?></td>

                <td><?= $customer['phone']; ?></td>

                <td>

                    <button onclick="window.location.href='<?= site_url('customers/edit/' . $customer['id']); ?>'">
                        Edit
                    </button>

                    <button onclick="window.location.href='<?= site_url('customers/delete/' . $customer['id']); ?>'">
                        Delete
                    </button>

                </td>

            </tr>

        <?php endforeach; ?>

    </table>

</body>

</html>