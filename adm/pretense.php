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
echo '<a href="http://dfboard.wlantele.com/index.board?' . SID . '">����������</a> &raquo;������<br /><br />';
switch ($vid):
case 'index':
$allboard= mysqlnd :: $open -> querySingle("SELECT count(*) FROM `zhaloba`;");
if ($allboard > 0) {
if ($reader >= $allboard) {
$reader = 0;
}
$sqltozhal = mysqlnd :: $open -> query("SELECT * FROM `zhaloba` ORDER BY `zhaloba_id` DESC LIMIT " . $reader . "," . $limitboard . ";");
while ($dato = $sqltozhal -> fetch()) {
echo '<hr /><span style="font-weight:bold">�� �' . $dato['zhaloba_board'] . ' �� ' . $dato['zhaloba_user'] . '</span><br />' . $dato['zhaloba_text'] . '<br /><br /><a href="zhaloby.board?vid=del&amp;id=' . $dato['zhaloba_id'] . '&amp;' . SID . '">[�������]</a><br /><br />';
}
navigation ('zhaloby.board?', $limitboard, $reader, $allboard);
navigator ('zhaloby.board?', $limitboard, $reader, $allboard);
} else {
getmessage ('����� ���� ���<br /><br />');
}
break;
case 'del':
echo '�� ������������� ������ ������� ��� ������?<br /><br />
<a href="zhaloby.board?vid=delete&amp;id=' . $id . '&amp;' . SID . '">��</a> | <a href="/index.board?' . SID . '">�� �������</a><br />';
break;
case 'delete':
mysqlnd :: $open -> query("DELETE FROM `zhaloba` WHERE `zhaloba_id`=? LIMIT 1;", array($id));
$_SESSION['info'] = '��������� ������ ������� �������';
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