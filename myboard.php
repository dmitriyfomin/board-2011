<?php
require_once ('tools/setting.php');
require_once ('tools/vvork.php');
require_once ('tools/str.php');
include_once ('' . $vers . '/header.php');
if (empty($_GET['uzer'])) { $uzer = tabs ($logine);
			} else {
		$uzer = tabs ($_GET['uzer']);
} 
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
if (user_array()) {
echo '<a href="/index.board?' . SID . '">����������</a> &raquo;��� ����������<br /><br />';
switch ($vid):
case 'index':
echo '������������ / <a href="/myboards.board?vid=noshow&amp;' . SID . '">�� ������������</a><br /><br />';
$allboard= mysqlnd :: $open -> querySingle("SELECT count(*) FROM `boards` WHERE `boards_user`=? AND `boards_show`=? AND `boards_view`=?;", array($uzer, 1, 1));
if ($allboard > 0) {
if ($reader >= $allboard) {
$reader = 0;
}
$sqltoall = mysqlnd :: $open -> query("SELECT * FROM `boards` WHERE `boards_user`=? AND `boards_show`=? AND `boards_view`=? ORDER BY `boards_id` DESC LIMIT " . $reader . "," . $limitboard . ";", array($uzer, 1, 1));
while ($dato = $sqltoall -> fetch()) {
echo '<hr />' . $dato['boards_time'] . '  ';
if (!empty($dato['boards_pic'])) {
$fot = substr ($dato['boards_pic'], '7');
echo '<img src="/screen.board?dir=pics/&amp;name=' . $fot . '" align="left" alt="image" />  ';
}
echo '<a href="index.board?vid=view&amp;id=' . $dato['boards_id'] . '">�' . $dato['boards_id'] . ' ' . $dato['boards_title'] . '</a>   ' . $dato['boards_price'] . '<br />' . $dato['boards_text'] . '<br /><br /><a href="myboards.board?vid=myedit&amp;id=' . $dato['boards_id'] . '&amp;' . SID . '">[���]</a> | <a href="myboards.board?vid=mydeshow&amp;id=' . $dato['boards_id'] . '&amp;' . SID . '">��������� �����</a> | <a href="myboards.board?vid=mydel&amp;id=' . $dato['boards_id'] . '&amp;' . SID . '">�������</a><br /><br />';
}
navigation ('boards.board?', $limitboard, $reader, $allboard);
navigator ('boards.board?', $limitboard, $reader, $allboard);
} else {
getmessage ('���������� ��� ���<br /><br />');
}
break;
case 'noshow':
echo '<a href="/myboards.board?' . SID . '">������������</a> / �� ������������<br /><br />';
$allboard= mysqlnd :: $open -> querySingle("SELECT count(*) FROM `boards` WHERE `boards_user`=? AND `boards_show`=? AND `boards_view`=?;", array($uzer, 0, 1));
if ($allboard > 0) {
if ($reader >= $allboard) {
$reader = 0;
}
$sqltoall = mysqlnd :: $open -> query("SELECT * FROM `boards` WHERE `boards_user`=? AND `boards_show`=? AND `boards_view`=? ORDER BY `boards_id` DESC LIMIT " . $reader . "," . $limitboard . ";", array($uzer, 0, 1));
while ($dato = $sqltoall -> fetch()) {
echo '<hr />' . $dato['boards_time'] . '  ';
if (!empty($dato['boards_pic'])) {
$fot = substr ($dato['boards_pic'], '7');
echo '<img src="/screen.board?dir=pics/&amp;name=' . $fot . '" align="left" alt="image" />  ';
}
echo '<a href="index.board?vid=view&amp;id=' . $dato['boards_id'] . '">�' . $dato['boards_id'] . ' ' . $dato['boards_title'] . '</a>   ' . $dato['boards_price'] . '<br />' . $dato['boards_text'] . '<br /><br /><a href="myboards.board?vid=myedit&amp;id=' . $dato['boards_id'] . '&amp;' . SID . '">[���]</a> | <a href="myboards.board?vid=myshow&amp;id=' . $dato['boards_id'] . '&amp;' . SID . '">��������� �����</a> | <a href="myboards.board?vid=mydel&amp;id=' . $dato['boards_id'] . '&amp;' . SID . '">�������</a><br /><br />';
}
navigation ('boards.board?', $limitboard, $reader, $allboard);
navigator ('boards.board?', $limitboard, $reader, $allboard);
} else {
getmessage ('���������� ��� ���<br /><br />');
}
break;
case 'myedit':
if ($uzer == $_SESSION['logine']) {
$sqltotext = mysqlnd :: $open -> query("SELECT * FROM `boards` WHERE `boards_id`=? AND `boards_user`=? LIMIT 1;", array($id, $uzer));
$dato = $sqltotext -> fetch();
if (!empty($dato)) {
$dato['boards_title'] = str_replace ('<br />', "\r\n", $dato['boards_title']);
$dato['boards_text'] = str_replace ('<br />', "\r\n", $dato['boards_text']);
echo '<b><big>��������� ���������� �' . $dato['boards_id'] . '</big></b><hr /><form action="/myboards.board?vid=mysave&amp;id=' . $dato['boards_id'] . '&amp;' . SID . '" method="post">
������� (' . $dato['boards_cat'] . '):<br /><select name="rubrika">';
$sqltorub = mysqlnd :: $open -> query("SELECT * FROM `categoria` ORDER BY `categoria_id`;");
$rrub = $sqltorub -> fetchAll();
foreach ($rrub as $rowrub) {
$rubrika = ($dato['boards_cat'] == $rowrub) ? ' selected="rubrika"' : '';
echo '<option value="' . $rowrub['categoria_id'] . '"' . $rubrika . '">' . $rowrub['categoria_id'] . '. ' . $rowrub['categoria_title'] . '</option>';
}
echo '</select><br /><br />
����: <input name="price" maxlength="50" value="' . $dato['boards_price'] . '" /><br /><br />
��������:<br /><input name="head" maxlength="50" value="' . $dato['boards_title'] . '"/><br /><br />
�����:<br /><textarea name="am" maxlength="200" cols="25" rows="3">' . $dato['boards_text'] . '</textarea><br /><br />
���������� ����:<br />
<input name="name" value="' . $dato['boards_name'] . '" maxlength="90" /><br /><br />
�������:<br />
<input name="phone" maxlength="20" value="' . $dato['boards_phone'] . '" /><br /><br />
ICQ:<br />
<input name="icq" maxlength="9" value="' . $dato['boards_icq'] . '" /><br /><br />
Skype:<br />
<input name="skype" maxlength="50" value="' . $dato['boards_skype'] . '" /><br /><br />
<input type="submit" value="��������" /></form><br />';
} else {
getmessage ('�� ������ ������������� ������ ���� ����������!');
}
} else {
getmessage ('���������� ��� �������������� �� ����������!');
}
echo '<a href="/myboards.board?reader=' . $reader . '&amp;' . SID . '">��������� �����</a><br />';
break;
case 'mysave':
if ($uzer == $_SESSION['logine']) {
$rubrika =intval ($_POST['rubrika']);
$head = tabs ($_POST['head']);
$am = tabs ($_POST['am']);
$price = tabs ($_POST['price']);
$name = tabs ($_POST['name']);
$phone = tabs ($_POST['phone']);
$icq = intval ($_POST['icq']);
$skype = tabs ($_POST['skype']);
if (!empty($rubrika)) {
if (!empty($head)) {
if (!empty($am)) {
if (empty($price)) {
$price = '����������';
}
if (!empty($name)) {
mysqlnd :: $open -> query("UPDATE `boards` SET `boards_title`=?, `boards_text`=?, `boards_name`=?, `boards_price`=?, `boards_view`=?, `boards_cat`=?, `boards_phone`=?, `boards_icq`=?, `boards_skype`=? WHERE `boards_id`=? AND `boards_user`=? LIMIT 1;", array($head, $am, $name, $price, 0, $rubrika, $phone, $icq, $skype, $id, $uzer));
$_SESSION['info'] = '��������� ���������� ��������������� � ����� ���������� �� ���������!';
header ('Location: myboards.board?' . SID);
exit;
} else {
$_SESSION['info'] = '�� ������� ���������� ����! �������������� ��������!';
header ('Location: myboards.board?vid=myedit&id=' . $id . '&' . SID);
exit;
}
} else {
$_SESSION['info'] = '�������� �����! �������������� ��������!';
header ('Location: myboards.board?vid=myedit&id=' . $id . '&' . SID);
exit;
}
} else {
$_SESSION['info'] = '�������� ����� ��������! �������������� ��������!';
header ('Location: myboards.board?vid=myedit&id=' . $id . '&' . SID);
exit;
}
} else {
$_SESSION['info'] = '�������� �������! �������������� ��������!';
header ('Location: myboards.board?vid=myedit&id=' . $id . '&' . SID);
exit;
}
} else {
getmessage ('�� ������ ������������� ������ ���� ����������!');
}
break;
case 'mydel':
if ($uzer == $_SESSION['logine']) {
echo '�� ������������� ������ ������� ���������� �' . $id . '?<br /><br />
<a href="myboards.board?vid=mydelete&amp;id=' . $id . '&amp;' . SID . '">��</a> | <a href="/index.board?' . SID . '">�� �������</a><br />';
} else {
$_SESSION['info'] = '�� �� ������ ������� ����� ����������!';
header ('Location: myboards.board?' . SID);
exit;
}
break;
case 'mydelete':
if ($uzer == $_SESSION['logine']) {
mysqlnd :: $open -> query("DELETE FROM `boards` WHERE `boards_id`=? AND `boards_user`=? LIMIT 1;", array($id, $uzer));
$_SESSION['info'] = '��������� ���������� �������!';
header ('Location: myboards.board?' . SID);
exit;
} else {
$_SESSION['info'] = '�� �� ������ ������� ����� ����������!';
header ('Location: myboards.board?' . SID);
exit;
}
break;
case 'myshow':
mysqlnd :: $open -> query("UPDATE `boards` SET `boards_show`=? WHERE `boards_id`=? AND `boards_user`=? LIMIT 1;", array(1, $id, $uzer));
$_SESSION['info'] = '��������� ���������� ������������, ����� ������� ��������.';
header ('Location: myboards.board?' . SID);
exit;
break;
case 'mydeshow':
mysqlnd :: $open -> query("UPDATE `boards` SET `boards_show`=? WHERE `boards_id`=? AND `boards_user`=? LIMIT 1;", array(0, $id, $uzer));
$_SESSION['info'] = '��������� ���������� �� ������������, ����� ������� ��������.';
header ('Location: myboards.board?' . SID);
exit;
break;
default:
header ('Location: myboards.board?' .SID);
exit;
endswitch;
include_once ('' . $vers . '/foot.php');
} else {
header ('Location: index.board?' .SID);
exit;
}

?>