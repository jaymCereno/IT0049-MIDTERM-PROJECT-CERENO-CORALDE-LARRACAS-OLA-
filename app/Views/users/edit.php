<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>

<h1>Edit User</h1>

<form method="post" enctype="multipart/form-data">

    <label>Username</label><br>
    <input
        type="text"
        name="username"
        value="<?= $user['username']; ?>"
        required>

    <br><br>

    <label>Full Name</label><br>
    <input
        type="text"
        name="full_name"
        value="<?= $user['full_name']; ?>"
        required>

    <br><br>

    <label>New Avatar</label><br>
    <input type="file" name="avatar">

    <br><br>

    <button type="submit">
        Update User
    </button>

</form>

</body>
</html>