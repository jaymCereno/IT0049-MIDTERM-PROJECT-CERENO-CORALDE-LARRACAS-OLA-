<!DOCTYPE html>
<html>
<head>
    <title>Add Customer</title>
</head>
<body>

<?= $this->include('partials/navigation'); ?>

<h1>Add Customer</h1>

<?php if (isset($validation)): ?>
    <div style="color: red;">
        <?= $validation->listErrors(); ?>
    </div>
<?php endif; ?>

<form method="post">

    <label>Full Name</label><br>
    <input
        type="text"
        name="full_name"
        value="<?= esc(old('full_name')); ?>"
        required>

    <br><br>

    <label>Email</label><br>
    <input
        type="email"
        name="email"
        value="<?= esc(old('email')); ?>"
        required>

    <br><br>

    <label>Phone</label><br>
    <input
        type="text"
        name="phone"
        value="<?= esc(old('phone')); ?>"
        required>

    <br><br>

    <button type="submit">
        Save Customer
    </button>

</form>

</body>
</html>