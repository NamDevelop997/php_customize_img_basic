<?php
$link = 'imgs/anh-nen-hoa-phuong-do-dep-19.JPG';

if (@unlink($link)) {
    echo "Xóa ảnh {$link} thành công!";
} else {
    echo "ảnh không tồn tại trên hệ thống!";
}
