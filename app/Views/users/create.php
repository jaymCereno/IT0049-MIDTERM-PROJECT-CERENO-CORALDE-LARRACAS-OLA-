<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
</head>
<body>

<h1>Add User</h1>

<form method="post" enctype="multipart/form-data">

    <label>Username</label><br>
    <input type="text" name="username" required>

    <br><br>

    <label>Full Name</label><br>
    <input type="text" name="full_name" required>

    <br><br>

    <label>Password</label><br>
    <input type="password" name="password" required>

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
