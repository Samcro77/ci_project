<!DOCTYPE html>
<html>
<head>
    <title>Add new user</title>
</head>
<body>
<h1>Create new user</h1>
<form action="<?php echo site_url("users/add") ?>" method="post">
    <span>Firstname: </span><input type="text" name="first_name"><br />
    <span>Lastname: </span><input type="text" name="last_name"><br />
    <span>Email: </span><input type="text" name="email"><br />
    <input type="submit" value="Add">

</form>
</body>
</html>
