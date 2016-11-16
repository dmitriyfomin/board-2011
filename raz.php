<?php
require_once ('tools/setting.php');
require_once ('tools/vvork.php');
require_once ('tools/str.php');
include_once ('' . $vers . '/header.php');
include_once ('' . $vers . '/checker.php');
if (isset($_GET['vid'])) { $vid = tabs ($_GET['vid']);
			} else {
		$vid = 'default';
}
if (isset($_GET['rz'])) { $rz = abs (intval($_GET['rz']));
			} else {
		$rz = 0;
}
if (isset($_GET['reader'])) { $reader = abs (intval($_GET['reader']));
			} else {
		$reader = 0;
}
if (isset($_GET['id'])) { $id = abs (intval($_GET['id']));
			} else {
		$id = 0;
}
switch ($vid):
case 'view':
$allboard = mysqlnd :: $open -> querySingle("SELECT count(*)  `boards_id` FROM `boards` WHERE `boards_cat`=? AND `boards_show`=? AND `boards_view`=?;", array($rz, 1, 1));
if ($allboard > 0) {
if ($reader >= $allboard) {
$reader = 0;
}
$sqlcat = mysqlnd :: $open -> query("SELECT * FROM `categoria` WHERE `categoria_id`=? LIMIT 1;", array($rz));
while ($rc = $sqlcat -> fetch()) {
echo '<a href="/index.board?' . SID . '">&laquo;&nbsp;назад</a>&nbsp;&nbsp;&raquo;Категория: ' . $rc['categoria_title'] . '<br /><br />';
if ($reader == 0) {
mt_info ($rc['categoria_id'], 'Описание категории:');
}
$sqltob = mysqlnd :: $open -> query("SELECT * FROM `boards` WHERE `boards_cat`=? AND `boards_show`=1 AND `boards_view`=1 ORDER BY `boards_id` DESC LIMIT " . $reader . ", " . $limitboard . ";", array($rz));
while ($dato = $sqltob -> fetch()) {
echo '<hr />' . $dato['boards_time'] . '  ';
if (!empty($dato['boards_pic'])) {
$fot = substr ($dato['boards_pic'], '7');
echo '<img src="resize.php?dir=pics/&amp;name=' . $fot . '" align="left" alt="image" />  ';
}
echo '<a href="/index.board?vid=view&amp;id=' . $dato['boards_id'] . '&amp;' . SID . '">№' . $dato['boards_id'] . ' ' . $dato['boards_title'] . '</a>&nbsp;&nbsp;&nbsp;Цена (руб.): ' . $dato['boards_price'] . '<br />';
}
}
if (function_exists(navo)) {
navigation ('razdel.board?vid=view&amp;rz=' . $rz . '&amp;', $limitboard, $reader, $allboard);
navigator ('razdel.board?vid=view&amp;rz=' . $rz . '&amp;', $limitboard, $reader, $allboard);
} else {
mc ();
}
} else {
getmessage ('В данной рубрике пока нет объявлений');
}
break;
default:
header ('Location: /index.board?' . SID);
endswitch;
include_once ('' . $vers . '/foot.php');

?>