<?php
require_once ('tools/setting.php');
require_once ('tools/vvork.php');
require_once ('tools/str.php');
if (isset($_GET['type'])) { $type = tabs ($_GET['type']);
			} else {
		$type = 'default';
}
if (isset($_GET['id'])) { $id = abs (intval($_GET['id']));
			} else {
		$id = '';
}
if (empty($id)) {
header ('Location: /index.board?' . SID);
exit;
}
$image = imagecreate (230, 13);
$back = imagecolorallocate ($image, 255, 255, 255);
$color = imagecolorallocate ($image, 0, 0, 0);
$sqltobcont = mysqlnd :: $open -> query("SELECT * FROM `boards` WHERE `boards_id`=?;", array($id));
$dato = $sqltobcont -> fetch();
switch ($type):
case 'mail':
imagettftext ($image, 11, 0, 3, 11, $color, '/fonts/ming.ttf', $dato['boards_user']);
break;
case 'phone':
imagettftext ($image, 11, 0, 3, 12, $color, '/fonts/ming.ttf', $dato['boards_phone']);
break;
case 'icq':
imagettftext ($image, 11, 0, 3, 12, $color, '/fonts/ming.ttf', $dato['boards_icq']);
break;
case 'skype':
imagettftext ($image, 11, 0, 3, 11, $color, '/fonts/ming.ttf', $dato['boards_skype']);
break;
default:
header ('Location: /index.board?' . SID);
exit;
endswitch;
header ('Content-Type: image/png');
imagepng ($image);
imagedestroy ($image);

?>