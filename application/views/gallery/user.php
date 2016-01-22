<!DOCTYPE html>
<html>
<head>
    <title>Galleries</title>
</head>
<body>
<a href="<?php echo site_url('users/index')?>">Return to user's list</a>
<table border="1">
    <tbody>
    <?php
    $count = 0;
    foreach($galleries as $gallery){?>
        <?php if($count %3 == 0): ?>
            <tr>
        <?php endif ?>
        <td><img width="100" src="<?php echo base_url().'files/'.$gallery['file_name'] . '_thumb'. $gallery['file_ext'] ?>">
        </td>
        <td>
            <?php echo anchor('gallery/delete/' . $gallery['file_name'].  $gallery['file_ext'], 'Delete') ?>
        </td>
        <?php if($count %3 == 0): ?>
            </tr>
        <?php endif ?>
        <?php
        $count++;
    }

    ?>
    </tbody>
</table>
</body>
</html>