<!DOCTYPE html>
<html>
<head>
	<title>Users</title>
</head>
<body>
<script type="text/javascript">
    function confirmDelete()
    {
        return confirm("Are you sure thet you want delete user");
    }
</script>
<p>Hello Users!</p>
<a href="<?php echo site_url('users/add')?>">Add new user</a>
<table>
    <thead>
    <tr>
        <th>FirstName</th>
        <th>LastName</th>
        <th>Email</th>
        <th>Created at</th>
        <th>Actions</th>
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
                    <td>
                        <span style="margin-right: 5px">
                            <a href="<?php echo site_url('users/edit/' . $user['id']) ?>">Edit</a>
                        </span>
                        <span>
                            <a onclick="return confirmDelete();" href="<?php echo site_url('users/delete/' . $user['id']) ?>">Delete</a>
                        </span>
                         <span style="margin-right: 5px">
                            <a href="<?php echo site_url('gallery/add/' . $user['id']) ?>">Create Gallery</a>
                        </span>
                         <span style="margin-right: 5px">
                            <a href="<?php echo site_url('gallery/user/' . $user['id']) ?>">View gallery</a>
                        </span>
                    </td>
                </tr>
        <?php
            }
        ?>
    </tbody>
</table>

<?php echo $this->pagination->create_links(); ?>
</body>
</html>
