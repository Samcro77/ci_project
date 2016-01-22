<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>Upload</title>
</head>
<body>
    <h1>Upload file</h1>
    <form action="<?php echo site_url('gallery/add/' . $user['id'])?>" method="post" enctype="multipart/form-data">
        <input type="file" name="upload">
        <input type="submit" value="upload"><br />
        <input type="checkbox" name="resize" checked>Resize
        <input type="checkbox" name="watermark">Watermark
    </form>
<?php
if(isset($success)) {
    if ($success === false) {
        echo $message;
    } elseif ($success) {

        echo $message;
    }
}

?>
</body>
</html>