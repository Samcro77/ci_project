<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
</head>
<body>
<table>
    <thead>
    <tr>
        <th>FirstName</th>
        <th>LastName</th>
        <th>Email</th>
        <th>Created at</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($users as $user){?>
        <tr>
            <td><?php echo $user['first_name']?></td>
            <td><?php echo $user['last_name']?></td>
            <td><?php echo $user['email']?></td>
            <td><?php echo $user['created_at']?></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>

</body>
</html>
