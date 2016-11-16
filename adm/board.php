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
echo '<a href="http://dfboard.wlantele.com/index.board?' . SID . '">Объявления</a> &raquo;Модерация<br /><br />';
switch ($vid):
case 'index':
$allboard= mysqlnd :: $open -> querySingle("SELECT count(*) FROM `boards` WHERE `boards_view`=?;", array(0));
if ($allboard > 0) {
if ($reader >= $allboard) {
$reader = 0;
}
$sqltoall = mysqlnd :: $open -> query("SELECT * FROM `boards` WHERE `boards_view`=0 ORDER BY `boards_id` DESC LIMIT " . $reader . "," . $limitboard . ";");
while ($dato = $sqltoall -> fetch()) {
echo '<hr />' . $dato['boards_time'] . '  ';
if (!empty($dato['boards_pic'])) {
$fot = substr ($dato['boards_pic'], '7');
echo '<img src="/screen.board?dir=pics/&amp;name=' . $fot . '" align="left" alt="image" />  ';
}
echo '<a href="index.board?vid=view&amp;id=' . $dato['boards_id'] . '">№' . $dato['boards_id'] . ' ' . $dato['boards_title'] . '</a>   ' . $dato['boards_price'] . '<br />' . $dato['boards_text'] . '<br /><br /><a href="boards.board?vid=edit&amp;id=' . $dato['boards_id'] . '&amp;' . SID . '">[Изм]</a> | <a href="boards.board?vid=add&amp;id=' . $dato['boards_id'] . '&amp;' . SID . '">Разрешить показ</a> ';
if (adrn_array(array(1))) {
echo '| <a href="boards.board?vid=del&amp;id=' . $dato['boards_id'] . '&amp;' . SID . '">[Уд]</a>';
}
echo '<br /><br />';
}
navigation ('boards.board?', $limitboard, $reader, $allboard);
navigator ('boards.board?', $limitboard, $reader, $allboard);
} else {
getmessage ('Объявлений для модерации нет<br /><br />');
}
break;
case 'add':
mysqlnd :: $open -> query("UPDATE `boards` SET `boards_view`=? WHERE `boards_id`=? AND `boards_view`=?;", array(1, $id, 0));
$_SESSION['info'] = 'Выбранное объявление промодерировано и отображается!';
header ('Location: boards.board?' . SID);
exit;
break;
case 'noshow':
mysqlnd :: $open -> query("UPDATE `boards` SET `boards_view`=? WHERE `boards_id`=? AND `boards_view`=?;", array(0, $id, 1));
$_SESSION['info'] = 'Выбранное объявление снова отправлено на модерацию и не отображается!';
header ('Location: /index.board?' . SID);
exit;
break;
case 'edit':
$sqltotext = mysqlnd :: $open -> query("SELECT * FROM `boards` WHERE `boards_id`=? LIMIT 1;", array($id));
$dato = $sqltotext -> fetch();
if (!empty($dato)) {
$dato['boards_title'] = str_replace ('<br />', "\r\n", $dato['boards_title']);
$dato['boards_text'] = str_replace ('<br />', "\r\n", $dato['boards_text']);
echo '<b><big>Изменение объявления №' . $dato['boards_id'] . '</big></b><hr /><form action="boards.board?vid=save&amp;id=' . $dato['boards_id'] . '&amp;' . SID . '" method="post">
Рубрика (' . $dato['boards_cat'] . '):<br /><select name="rubrika">';
$sqltorub = mysqlnd :: $open -> query("SELECT * FROM `categoria` ORDER BY `categoria_id`;");
$rrub = $sqltorub -> fetchAll();
foreach ($rrub as $rowrub) {
$rubrika = ($dato['boards_cat'] == $rowrub) ? ' selected="rubrika"' : '';
echo '<option value="' . $rowrub['categoria_id'] . '"' . $rubrika . '">' . $rowrub['categoria_id'] . '. ' . $rowrub['categoria_title'] . '</option>';
}
echo '</select><br /><br />
Цена: <input name="price" maxlength="50" value="' . $dato['boards_price'] . '" /><br /><br />
Название:<br /><input name="head" maxlength="50" value="' . $dato['boards_title'] . '"/><br /><br />
Текст:<br /><textarea name="am" maxlength="200" cols="25" rows="3">' . $dato['boards_text'] . '</textarea><br /><br />
Контактное лицо:<br />
<input name="name" value="' . $dato['boards_name'] . '" maxlength="90" /><br /><br />
Телефон:<br />
<input name="phone" maxlength="20" value="' . $dato['boards_phone'] . '" /><br /><br />
ICQ:<br />
<input name="icq" maxlength="9" value="' . $dato['boards_icq'] . '" /><br /><br />
Skype:<br />
<input name="skype" maxlength="50" value="' . $dato['boards_skype'] . '" /><br /><br />
<input type="submit" value="Изменить" /></form><br />';
} else {
getmessage ('Объявлений для редактирования не существует!');
} 
echo '<a href="boards.board?reader=' . $reader . '&amp;' . SID . '">Вернуться назад</a><br />';
break;
case 'save':
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
$price = 'Договорная';
}
if (!empty($name)) {
mysqlnd :: $open -> query("UPDATE `boards` SET `boards_title`=?, `boards_text`=?, `boards_name`=?, `boards_price`=?, `boards_cat`=?, `boards_phone`=?, `boards_icq`=?, `boards_skype`=? WHERE `boards_id`=? LIMIT 1;", array($head, $am, $name, $price, $rubrika, $phone, $icq, $skype, $id));
$_SESSION['info'] = 'Выбранное объявление отредактировано!';
header ('Location: boards.board?' . SID);
exit;
} else {
$_SESSION['info'] = 'Не указано контактное лицо! Редактирование отменено!';
header ('Location: boards.board?vid=edit&id=' . $id . '&' . SID);
exit;
}
} else {
$_SESSION['info'] = 'Неверный текст! Редактирование отменено!';
header ('Location: boards.board?vid=edit&id=' . $id . '&' . SID);
exit;
}
} else {
$_SESSION['info'] = 'Неверный текст названия! Редактирование отменено!';
header ('Location: boards.board?vid=edit&id=' . $id . '&' . SID);
exit;
}
} else {
$_SESSION['info'] = 'Неверная рубрика! Редактирование отменено!';
header ('Location: boards.board?vid=edit&id=' . $id . '&' . SID);
exit;
}
break;
case 'del':
if (adrn_array(array(1))) {
echo 'Вы действительно хотите удалить объявление №' . $id . '?<br /><br />
<a href="boards.board?vid=delete&amp;id=' . $id . '&amp;' . SID . '">Да</a> | <a href="/index.board?' . SID . '">На главную</a><br />';
} else {
echo 'У вас недостаточно прав для выполнения данной операции<br />
<a href="/index.board?' . SID . '">На главную</a><br />';
}
break;
case 'delete':
if (adrn_array(array(1))) {
mysqlnd :: $open -> query("DELETE FROM `boards` WHERE `boards_id`=? LIMIT 1;", array($id));
$_SESSION['info'] = 'Выбранное объявление удалено!';
header ('Location: boards.board?' . SID);
exit;
} else {
$_SESSION['info'] = 'У вас недостаточно прав для выполнения данной операции';
header ('Location: /index.board?' . SID);
exit;
}
break;
case 'pic':
$sqltopics = mysqlnd :: $open -> query("SELECT `boards_pic`, `boards_pic2` FROM `boards` WHERE `boards_id`=? LIMIT 1;", array($id));
$dato = $sqltopics -> fetch();
if (!empty($dato['boards_pic']) && !empty($dato['boards_pic2'])) {
if (!empty($dato['boards_pic'])) {
echo 'Kартинка 1<br />';
}
if (!empty($dato['boards_pic2'])) {
echo 'Kартинка 2<br />';
}
} else {
getmessage ('В данном объявлении нет картинок!');
}
break;
default:
header ('Location: boards.board?' .SID);
exit;
endswitch;
include_once ('../' . $vers . '/foot.php');
} else {
header ('Location: index.board?' .SID);
exit;
}

?>