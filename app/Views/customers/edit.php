<!DOCTYPE html>
<html>
<head>
    <title>Edit Customer</title>
</head>
<body>

<h1>Edit Customer</h1>

<form method="post">

    <label>Full Name</label><br>
    <input
        type="text"
        name="full_name"
        value="<?= $customer['full_name']; ?>"
        required>

    <br><br>

    <label>Email</label><br>
    <input
        type="email"
        name="email"
        value="<?= $customer['email']; ?>"
        required>

    <br><br>

    <label>Phone</label><br>
    <input
        type="text"
        name="phone"
        value="<?= $customer['phone']; ?>"
        required>

    <br><br>

    <button type="submit">
        Update Customer
    </button>

</form>

</body>
</html>