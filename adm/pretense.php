<?php
require_once ('../tools/setting.php');
require_once ('../tools/vvork.php');
require_once ('../tools/str.php');
include_once ('../' . $vers . '/header.php');
if (isset($_GET['vid'])) { $vid = tabs ($_GET['vid']);
			} else {
		$vid = 'index';
}
if (isset($_GET['id'])) { $id = abs (intval($_GET['id']));
			} else {
		$id = 0;
}
if (isset($_GET['reader'])) { $reader = abs (intval($_GET['reader']));
			} else {
		$reader = 0;
}
if (adrn_array(array(1, 2))) {
echo '<a href="http://dfboard.wlantele.com/index.board?' . SID . '">Объявления</a> &raquo;Жалобы<br /><br />';
switch ($vid):
case 'index':
$allboard= mysqlnd :: $open -> querySingle("SELECT count(*) FROM `zhaloba`;");
if ($allboard > 0) {
if ($reader >= $allboard) {
$reader = 0;
}
$sqltozhal = mysqlnd :: $open -> query("SELECT * FROM `zhaloba` ORDER BY `zhaloba_id` DESC LIMIT " . $reader . "," . $limitboard . ";");
while ($dato = $sqltozhal -> fetch()) {
echo '<hr /><span style="font-weight:bold">На №' . $dato['zhaloba_board'] . ' от ' . $dato['zhaloba_user'] . '</span><br />' . $dato['zhaloba_text'] . '<br /><br /><a href="zhaloby.board?vid=del&amp;id=' . $dato['zhaloba_id'] . '&amp;' . SID . '">[Удалить]</a><br /><br />';
}
navigation ('zhaloby.board?', $limitboard, $reader, $allboard);
navigator ('zhaloby.board?', $limitboard, $reader, $allboard);
} else {
getmessage ('Жалоб пока нет<br /><br />');
}
break;
case 'del':
echo 'Вы действительно хотите удалить эту жалобу?<br /><br />
<a href="zhaloby.board?vid=delete&amp;id=' . $id . '&amp;' . SID . '">Да</a> | <a href="/index.board?' . SID . '">На главную</a><br />';
break;
case 'delete':
mysqlnd :: $open -> query("DELETE FROM `zhaloba` WHERE `zhaloba_id`=? LIMIT 1;", array($id));
$_SESSION['info'] = 'Выбранная жалоба успешно удалена';
header ('Location: zhaloby.board?' . SID);
exit;
break;
default:
header ('Location: /index.board?' .SID);
exit;
endswitch;
include_once ('../' . $vers . '/foot.php');
} else {
header ('Location: /index.board?' . SID);
exit;
}

?>