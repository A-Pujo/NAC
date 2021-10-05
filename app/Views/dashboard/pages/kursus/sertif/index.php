<?php
// echo "<img src='".base_url("public/img/sertif.png")."'>";
// header("Content-type: image/jpeg");
//--- Data ---//
// $image_file = base_url("public/img/sertif.png");
$image_file = "file/sertif.png";
$text = $_GET['text'] ?? 'Isi parameter GET text';
$font_file = 'file/vibes.ttf';

//Buat gambar
$createimage = imagecreatefrompng($image_file);
//Ukuran gambar
$image_file_width = getimagesize($image_file)[0];
$image_file_height =  getimagesize($image_file)[1];

//--- Konfigurasi Text ---//
$text_color = imagecolorallocate($createimage, 0, 0, 0);
$text_rotation = 0;
$font_size = 12;

//--- Hitung lebar text ---//
// Retrieve bounding box:
$type_space = imagettfbbox($font_size, 0, $font_file, $text);

// Determine image width and height, 10 pixels are added for 5 pixels padding:
$font_width = abs($type_space[4] - $type_space[0]) + 10;
$font_height = abs($type_space[5] - $type_space[1]) + 10;

//Koordinat text
$text_origin_x = ($image_file_width/2)-($font_width/2);
$text_origin_y=195;

//function to display name on certificate picture
imagettftext($createimage, $font_size, $text_rotation, $text_origin_x, $text_origin_y, $text_color, $font_file, $text);
$gambar = imagepng($createimage,null,3);
echo "<img src='$gambar'>";