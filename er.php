<?php
require_once ('tools/setting.php');
require_once ('tools/vvork.php');
require_once ('tools/str.php');
if (isset($_GET['code'])) { $code = intval ($_GET['code']);
			} else {
		$code = '';
}
switch ($code):
case '1':
$_SESSION['info'] = 'Ошибка. Запрашиваемый файл отсутствует, либо был удалён';
break;
endswitch;
header ('Location: /index.board?' . SID);
exit;

?>
