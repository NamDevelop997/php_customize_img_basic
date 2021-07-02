<?php
require 'lib/show_arr.php';
show_array($_FILES);
// b1: kiểm tra xem file img có tồn tại hay không 
if (isset($_FILES['file_img'])) {
    $err = [];
    $type_allow = ['img', 'jpg', 'png', 'gif', 'jpeg'];
    $file_size = 29000000;
    // đường dẫn file ảnh khi upload 
    $upload_dir = "imgs/";
    $upload_file = $upload_dir . $_FILES['file_img']['name'];
    /* b2: xử lí upload file ảnh
            -- nếu file upload lên có trùng định dạng ảnh cho phép thì xử lí tiếp
            -- nếu ko đúng đinh dạng thì báo lỗi 
    */

    $type = pathinfo($_FILES['file_img']['name'], PATHINFO_EXTENSION);
    if (!in_array(strtolower($type), $type_allow)) {
        $err["file_type"] = "ảnh phải ở định dạng img, jpg, png, gif, jpeg";
    }

    //    b3: kiểm tra dung lượng file ảnh không quá 20MB nếu vượt quá kích thước thì báo lỗi
    if ($_FILES['file_img']['size'] > $file_size) {
        $err["file_size"] = "kích thước file ảnh tối đa cho phép là 20MB!";
    }

    // b4: kiểm tra sự tồn tại của file trên hệ thống đã có hay chưa 
    if (file_exists($upload_file)) {
        $err['file_exists'] = "File đã tồn tại trên hệ thống!";
    }
    // b5 : xử lí upload_file khi không có bất kì lỗi nào
    if (empty($err)) {
        if (move_uploaded_file($_FILES['file_img']['tmp_name'], $upload_file)) {
            echo "<a href= '{$upload_file}'>Download file {$_FILES['file_img']['tmp_name']} </a>";
        }
    } else {
        show_array($err);
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customize upload file in php</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="file_img"><br> <br>
        <input type="submit" value="submit">
    </form>
</body>

</html>