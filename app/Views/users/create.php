<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
</head>
<body>

<?= $this->include('partials/navigation'); ?>

<h1>Add User</h1>

<?php if (isset($validation)): ?>
    <div style="color: red;">
        <?= $validation->listErrors(); ?>
    </div>
<?php endif; ?>

<form method="post" enctype="multipart/form-data">

    <label>Username</label><br>
    <input
        type="text"
        name="username"
        value="<?= esc(old('username')); ?>"
        required>

    <br><br>

    <label>Full Name</label><br>
    <input
        type="text"
        name="full_name"
        value="<?= esc(old('full_name')); ?>"
        required>

    <br><br>

    <label>Password</label><br>
    <input
        type="password"
        name="password"
        required>

    <br><br>

    <label>Avatar</label><br>
    <input type="file" name="avatar">

    <br><br>

    <button type="submit">
        Save User
    </button>

</form>

</body>
</html>