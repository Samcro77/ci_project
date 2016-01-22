<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <script type="application/javascript" src="jquery-2.1.4.min.js"></script>
</head>
<body>

<script type="text/javascript">
//    $(document).ready(function(){
//        $('#send').on('click',function(){
//            $.ajax({
//                type:'POST',
//                url: 'http://ci-project/subscribe/add', // указываем URL и
//                data:  {'email' : $('#email').val()},
//                dataType : "json",                     // тип загружаемых данных
//                beforeSend: function(){
//                    $('#message').html('');
//                },
//                success: function (data, textStatus) {
//                    if(data.success){
//
//
//                        var html =
//                            '<tr>' +
//                            '<td>' + data.subscriber.id +'</td>' +
//                            '<td>' + data.subscriber.email +'</td>' +
//                            '</tr>';
//                        $('#subs').find('tbody').append(html);
//                    }else{
//                        $('#message').html('Error');
//                    }
//                }
//            });
//        });
//    });

</script>
<form action="<?php echo site_url('subscribe/add') ?>" method="post" id="subscriber" name="subscriber">
    <input type="text" name="email" id="email">
<!--    <button id="send">Subscribe</button>-->
    <input type="submit" value="Subscribe" id="send">
</form>
<div id="message"></div>
<table border="1" width="100%" id="subscriber_subs">
    <thead><tr>
        <th width="10%">id</th>
        <th>email</th>
    </tr></thead>
    <tbody>
    <?php

    foreach ($subs as $sub) {
        ?>
        <tr>
            <td><?php echo $sub['id'] ?></td>
            <td><?php echo $sub['email'] ?></td>
        </tr>
        <?php
    }

    ?>
    </tbody>
</table>
</body>
</html>
