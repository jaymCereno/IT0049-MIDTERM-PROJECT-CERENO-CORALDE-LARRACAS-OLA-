<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
</head>
<body>
<?= $this->include('partials/navigation'); ?>
<h1>Users</h1>

<p>
    <button onclick="window.location.href='<?= site_url('users/create'); ?>'">
        Add User
    </button>
</p>

<table border="1" cellpadding="10">

    <tr>
        <th>ID</th>
        <th>Avatar</th>
        <th>Username</th>
        <th>Full Name</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($users as $user): ?>

    <tr>

        <td><?= $user['id']; ?></td>

        <td>
            <?php if (!empty($user['avatar'])): ?>
                <img
                    src="<?= base_url('uploads/avatars/' . $user['avatar']); ?>"
                    width="80"
                >
            <?php endif; ?>
        </td>

        <td><?= $user['username']; ?></td>

        <td><?= $user['full_name']; ?></td>

        <td>

            <button
                onclick="window.location.href='<?= site_url('users/edit/' . $user['id']); ?>'">
                Edit
            </button>

            <button
                onclick="if(confirm('Delete this user?')) window.location.href='<?= site_url('users/delete/' . $user['id']); ?>'">
                Delete
            </button>

        </td>

    </tr>

    <?php endforeach; ?>

</table>

</body>
</html>