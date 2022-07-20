<?php
$char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$captcha = substr(str_shuffle($char), 0, 5);
$output = "textimage.jpg"; // lokasi gambar disimpan
$x = 150;
$y = 50;

$gambar = imagecreate($x, $y); // buat lebar dan tinggi gambar
//warna
$black = imagecolorallocate($gambar, 0, 0, 0); // ganti warna background gambar
$white = imagecolorallocate($gambar, 255, 0, 0);
// seting data textnya
$font_size = 20;
$rotasi = 0;
$x_text = 30;
$y_text = 30;
$font_type = './file/font/Edu_QLD_Beginner/EduQLDBeginner-Bold.ttf';
$text_input = $captcha;


$text1 = imagettftext($gambar, $font_size, $rotasi, $x_text, $y_text, $white, $font_type, $text_input); //pengaturan text pada gambar

imagepng($gambar, $output);
