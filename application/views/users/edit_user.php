<!DOCTYPE html>
<html>
<head>
    <title>Edit user</title>
</head>
<body>
<h1>Edit user</h1>
<form action="<?php echo site_url('users/edit/' . $user['id']) ?>" method="post">
    <span>Firstname: </span><input type="text" name="first_name" value="<?php echo $user['first_name'] ?>"><br />
    <span>Lastname: </span><input type="text" name="last_name"  value="<?php echo $user['last_name'] ?>"><br />
    <span>Email: </span><input type="text" name="email"  value="<?php echo $user['email'] ?>"><br />
    <input type="submit" value="Update">

</form>
</body>
</html>
