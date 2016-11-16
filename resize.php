<?php
require_once ('tools/setting.php');
require_once ('tools/vvork.php');
require_once ('tools/str.php');
if (isset($_GET['dir'])) { $dir = tabs ($_GET['dir']);
			} else {
$dir = "";
} 
if (isset($_GET['name'])) { $name = tabs ($_GET['name']);
			} else {
$name = "";
} 
if (preg_match('|^[a-z0-9_\-/]+$|i', $dir) && preg_match('|^[a-z0-9_\.\-]+$|i', $name)) {
if (file_exists($dir . '/' . $name)) {
$getim = getimagesize ($dir .'/' . $name);
if ($getim[2] == 1 || $getim[2] == 2 || $getim[2] == 3) {
$width = $getim[0];
$height = $getim[1];
if ($width > 50 || $height > 90) {
$x_ratio = 50 / $width;
$y_ratio = 90 / $height;
if (($x_ratio * $height) < 90) {
$tn_height = ceil ($x_ratio * $height);
$tn_width = 50;
} else {
$tn_width = ceil ($y_ratio * $width);
$tn_height = 90;
}
 if ($getim[2] == 2) {
$img = imagecreatefromjpeg ($dir . '/' . $name);
$dst = imagecreatetruecolor ($tn_width, $tn_height);
imagecopyresampled ($dst, $img, 0, 0, 0, 0, $tn_width, $tn_height, $width, $height);
header ('Content-Type: image/jpeg');
header ('Content-Disposition: filename="' . $name . '"');
imagejpeg ($dst, null, 75);
imagedestroy ($img);
imagedestroy ($dst);
}
if ($getim[2] == 1) {
$img = imagecreatefromgif ($dir .'/' . $name);
$dst = imagecreatetruecolor ($tn_width, $tn_height);
$colorTransparent = imagecolortransparent ($img);
imagepalettecopy ($img, $dst);
imagefill ($dst, 0, 0, $colorTransparent);
imagecolortransparent ($dst, $colorTransparent);
imagetruecolortopalette ($dst, true, 256);
imagecopyresampled ($dst, $img, 0, 0, 0, 0, $tn_width, $tn_height, $width, $height);
header ('Content-Type: image/gif');
header ('Content-Disposition: filename="' . $name . '"');
imagegif ($dst);
imagedestroy ($img);
imagedestroy ($dst);
}
if ($getim[2] == 3) {
$img = imagecreatefrompng ($dir . '/' . $name);
$dst = imagecreatetruecolor ($tn_width, $tn_height);
$colorTransparent = imagecolortransparent ($img);
imagepalettecopy ($img, $dst);
imagefill ($dst, 0, 0, $colorTransparent);
imagecolortransparent ($dst, $colorTransparent);
imagetruecolortopalette ($dst, true, 256);
imagecopyresampled ($dst, $img, 0, 0, 0, 0, $tn_width, $tn_height, $width, $height);
header ('Content-Type: image/png');
header ('Content-Disposition: filename="' . $name . '"');
imagepng ($dst);
imagedestroy ($img);
imagedestroy ($dst);
} 
} else {
$filename = file_get_contents ($dir . '/' .  $name);
header ('Content-Type: ' . $getim['mime']);
header ('Content-Disposition: filename="' . $name . '"');
header ('Content-Length: ' . strlen($filename));
echo $filename;
} 
} 
} 
} 
exit;

?>