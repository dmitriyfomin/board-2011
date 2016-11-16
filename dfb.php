<?php
require_once ('tools/setting.php');
require_once ('tools/vvork.php');
require_once ('tools/str.php');
include_once ('' . $vers . '/header.php');
include_once ('' . $vers . '/checker.php');
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

switch ($vid):
case 'index':
$allboard= mysqlnd :: $open -> querySingle("SELECT count(*) FROM `boards` WHERE `boards_show`=? AND `boards_view`=?;", array(1, 1));
if ($allboard > 0) {
if ($reader >= $allboard) {
$reader = 0;
}
$sqltocountall = mysqlnd :: $open -> query("SELECT count(*) `boards_id` FROM `boards` WHERE `boards_show`=? AND `boards_view`=?;", array(1, 1));
while ($dato = $sqltocountall -> fetch()) {
echo '<span style="font-size:18px">Все ' . $dato['boards_id'] . '  ';
}
$sqltoelse = mysqlnd :: $open -> query("SELECT count(*) `boards_id` FROM `boards` WHERE `boards_author`=? AND `boards_show`=? AND `boards_view`=?;", array(1, 1, 1));
while ($rowelse = $sqltoelse -> fetch()) {
echo '<a href="/index.board?vid=stand&amp;' . SID . '">Частные объявления ' . $rowelse['boards_id'] . '</a>  ';
}
$sqltofirm = mysqlnd :: $open -> query("SELECT count(*) `boards_id` FROM `boards` WHERE `boards_author`=? AND `boards_show`=? AND `boards_view`=?;", array(2, 1, 1));
while ($rowfirm = $sqltofirm -> fetch()) {
echo '<a href="/index.board?vid=comp&amp;' . SID . '">Компании ' . $rowfirm['boards_id'] . '</a></span><br />';
}
$sqltoboards = mysqlnd :: $open -> query("SELECT * FROM `boards` WHERE `boards_show`=1 AND `boards_view`=1 ORDER BY `boards_id` DESC LIMIT " . $reader . ", " . $limitboard . ";");
while ($dato = $sqltoboards -> fetch()) {
$sqltotit = mysqlnd :: $open -> query("SELECT `categoria_title` FROM `categoria` WHERE `categoria_id`=?;", array($dato['boards_cat']));
while ($rowcat = $sqltotit -> fetch()) {
echo '<hr />' . $dato['boards_time'] . '  ';
if (!empty($dato['boards_pic'])) {
$fot = substr ($dato['boards_pic'], '7');
echo '<img src="/screen.board?dir=pics/&amp;name=' . $fot . '" align="left" alt="image" />  ';
}
echo '<a href="index.board?vid=view&amp;id=' . $dato['boards_id'] . '">№' . $dato['boards_id'] . ' ' . $dato['boards_title'] . '</a>&nbsp;&nbsp;&nbsp;' . $dato['boards_price'] . '<br/>' . $rowcat['categoria_title'] . '<br /><br />';
if (adrn_array(array(1, 2))) {
echo '<a href="/adm/boards.board?vid=edit&amp;id=' . $dato['boards_id'] . '&amp;' . SID . '">Редактировать</a> | <a href="/adm/boards.board?vid=noshow&amp;id=' . $dato['boards_id'] . '&amp;' . SID . '">Запретить показ</a> ';
}
if (adrn_array(array(1))) {
echo '| <a href="/adm/boards.board?vid=del&amp;id=' . $dato['boards_id'] . '&amp;' . SID . '">Удалить!</a>';
}
echo '<br />';
}
}
navigation ('index.board?', $limitboard, $reader, $allboard);
navigator ('index.board?', $limitboard, $reader, $allboard);
} else {
getmessage ('Объявлений нет<br /><br />');
}
break;
case 'view':
$sqltoboard = mysqlnd :: $open -> query("SELECT * FROM `boards` WHERE `boards_id`=? AND `boards_show`=? AND `boards_view`=? LIMIT 1;", array($id, 1, 1));
$dato = $sqltoboard -> fetch();
if ($dato > 0) {
$sqltonum = mysqlnd :: $open -> query("SELECT * FROM `categoria` ORDER BY `categoria_id` LIMIT 1;");
while ($rowrazd = $sqltonum -> fetch()) {
$sqltoname = mysqlnd :: $open -> query("SELECT `categoria_title` FROM `categoria` WHERE `categoria_id`=?;", array($dato['boards_cat']));
while ($numb = $sqltoname -> fetch()) {
echo '<span style="font-size:18px"><a href="/razdel.board?vid=view&rz=' . $dato['boards_cat'] . '&amp;' . SID . '">&laquo; назад</a>  <a href="index.board?' . SID . '">Объявления</a>  &raquo; ' . $numb['categoria_title'] . '</span><br /><br />';
if (!empty($dato['boards_pic'])) {
echo '<img src="' . $dato['boards_pic'] . '" alt="image" /> ';
}
if (!empty($dato['boards_pic2'])) {
echo '<img src="' . $dato['boards_pic2'] . '" alt="image" />';
}
echo '<br /><br />';
if (user_array()) {
echo '<a href="/index.board?vid=pret&amp;id=' . $dato['boards_id'] . '&amp;' . SID . '">Пожаловаться администрации о нарушении</a><br /><br />';
} 
echo '№' . $dato['boards_id'] . '<br /><br />Цена (руб.): ' . $dato['boards_price'] . '<br /><br />' . $dato['boards_text'] . '<br /><br /><span style="font-weight:bold;font-size:15px">Контакты</span><br/><span style="font-size:12px">Заинтересованы в объявлении? Контактное лицо: <span style="font-weight:bold">' . $dato['boards_name'] . '</span><br />
e-mail: <img src="/contact.board?type=mail&amp;id=' . $dato['boards_id'] . '&amp;' . SID . '" alt="e-mail" /><br />';
if (!empty($dato['boards_phone'])) {
echo 'Телефон: <img src="/contact.board?type=phone&amp;id=' . $dato['boards_id'] . '&amp;' . SID . '" alt="phone" /><br />';
}
if (!empty($dato['boards_icq'])) {
echo 'ICQ: <img src="/contact.board?type=icq&amp;id=' . $dato['boards_id'] . '&amp;' . SID . '" alt="icq" /><br />';
}
if (!empty($dato['boards_skype'])) {
echo 'Skype: <img src="/contact.board?type=skype&amp;id=' . $dato['boards_id'] . '&amp;' . SID . '" alt="skype" /><br />';
}
echo 'Похожие объявления:';
show_boards ($dato['boards_id'], $dato['boards_cat']);
}
}
} else {
getmessage ('Объявление, выбранное вами, не существует.<br /><br />');
}
break;
case 'stand':
$allboard= mysqlnd :: $open -> querySingle("SELECT count(*) FROM `boards` WHERE `boards_author`=? AND `boards_show`=? AND `boards_view`=?;", array(1, 1, 1));
if ($allboard > 0) {
if ($reader >= $allboard) {
$reader = 0;
}
$sqltocountall = mysqlnd :: $open -> query("SELECT count(*) `boards_id` FROM `boards` WHERE `boards_show`=? AND `boards_view`=?;", array(1, 1));
while ($dato = $sqltocountall -> fetch()) {
echo '<span style="font-size:18px"><a href="/index.board?' . SID . '">Все ' . $dato['boards_id'] . '</a>  ';
}
$sqltoelse = mysqlnd :: $open -> query("SELECT count(*) `boards_id` FROM `boards` WHERE `boards_author`=? AND `boards_show`=? AND `boards_view`=?;", array(1, 1, 1));
while ($rowelse = $sqltoelse -> fetch()) {
echo 'Частные объявления ' . $rowelse['boards_id'] .   '  ';
}
$sqltofirm = mysqlnd :: $open -> query("SELECT count(*) `boards_id` FROM `boards` WHERE `boards_author`=? AND `boards_show`=? AND `boards_view`=?;", array(2, 1, 1));
while ($rowfirm = $sqltofirm -> fetch()) {
echo '<a href="/index.board?vid=comp&amp;' . SID . '">Компании ' . $rowfirm['boards_id'] . '</a></span><br />';
}
$sqltoboards = mysqlnd :: $open -> query("SELECT * FROM `boards` WHERE `boards_author`=1 AND `boards_show`=1 AND `boards_view`=1 ORDER BY `boards_id` DESC LIMIT " . $reader . ", " . $limitboard . ";");
while ($dato = $sqltoboards -> fetch()) {
$sqltotit = mysqlnd :: $open -> query("SELECT `categoria_title` FROM `categoria` WHERE `categoria_id`=?;", array($dato['boards_cat']));
while ($rowcat = $sqltotit -> fetch()) {
echo '' . $dato['boards_time'] . '  ';
if (!empty($dato['boards_pic'])) {
$fot = substr ($dato['boards_pic'], '7');
echo '<img src="resize.php?dir=pics/&amp;name=' . $fot . '" align="left" alt="image" />  ';
}
echo '<a href="index.board?vid=view&amp;id=' . $dato['boards_id'] . '">№' . $dato['boards_id'] . ' ' . $dato['boards_title'] . '</a>&nbsp;&nbsp;&nbsp;' . $dato['boards_price'] . '<br/>' . $rowcat['categoria_title'] . '<br /><br />';
}
}
navigation ('index.board?vid=stand&amp;', $limitboard, $reader, $allboard);
navigator ('index.board?vid=stand&amp;', $limitboard, $reader, $allboard);
} else {
getmessage ('Объявлений нет<br /><br />');
}
break;
case 'comp':
$allboard= mysqlnd :: $open -> querySingle("SELECT count(*) FROM `boards` WHERE `boards_author`=? AND `boards_show`=? AND `boards_view`=?;", array(2, 1, 1));
if ($allboard > 0) {
if ($reader >= $allboard) {
$reader = 0;
}
$sqltocountall = mysqlnd :: $open -> query("SELECT count(*) `boards_id` FROM `boards` WHERE `boards_show`=? AND `boards_view`=?;", array(1, 1));
while ($dato = $sqltocountall -> fetch()) {
echo '<span style="font-size:18px"><a href="/index.board?' . SID . '">Все ' . $dato['boards_id'] . '</a>  ';
}
$sqltoelse = mysqlnd :: $open -> query("SELECT count(*) `boards_id` FROM `boards` WHERE `boards_author`=? AND `boards_show`=? AND `boards_view`=?;", array(1, 1, 1));
while ($rowelse = $sqltoelse -> fetch()) {
echo '<a href="/index.board?vid=stand&amp;' . SID . '">Частные объявления ' . $rowelse['boards_id'] .   '</a>  ';
}
$sqltofirm = mysqlnd :: $open -> query("SELECT count(*) `boards_id` FROM `boards` WHERE `boards_author`=? AND `boards_show`=? AND `boards_view`=?;", array(2, 1, 1));
while ($rowfirm = $sqltofirm -> fetch()) {
echo 'Компании ' . $rowfirm['boards_id'] . '</span><br />';
}
$sqltoboards = mysqlnd :: $open -> query("SELECT * FROM `boards` WHERE `boards_author`=2 AND `boards_show`=1 AND `boards_view`=1 ORDER BY `boards_id` DESC LIMIT " . $reader . ", " . $limitboard . ";");
while ($dato = $sqltoboards -> fetch()) {
$sqltotit = mysqlnd :: $open -> query("SELECT `categoria_title` FROM `categoria` WHERE `categoria_id`=?;", array($dato['boards_cat']));
while ($rowcat = $sqltotit -> fetch()) {
echo '' . $dato['boards_time'] . '  ';
if (!empty($dato['boards_pic'])) {
$fot = substr ($dato['boards_pic'], '7');
echo '<img src="resize.php?dir=pics/&amp;name=' . $fot . '" align="left" alt="image" />  ';
}
echo '<a href="index.board?vid=view&amp;id=' . $dato['boards_id'] . '">№' . $dato['boards_id'] . ' ' . $dato['boards_title'] . '</a>&nbsp;&nbsp;&nbsp;' . $dato['boards_price'] . '<br/>' . $rowcat['categoria_title'] . '<br /><br />';
}
}
navigation ('index.board?vid=comp&amp;', $limitboard, $reader, $allboard);
navigator ('index.board?vid=comp&amp;', $limitboard, $reader, $allboard);
} else {
getmessage ('Объявлений нет<br /><br />');
}
break;
case 'pret':
if (user_array()) {
$idnum = mysqlnd :: $open -> queryFetch("SELECT `boards_id` FROM `boards` WHERE `boards_id`=?;", array($id));
if (!empty($idnum)) {
echo '<hr /><big><b>Добавление жалобы на объявление №' . $id . '</b></big><br /><br />
<form action="/index.board?vid=sendpret&amp;id=' . $id . '" method="post">
Введите текст жалобы:<br />
<input name="am" maxlength="100" /> <input type="submit" value="Отправить" /></form>';
} else {
$_SESSION['info'] = 'При проверке обнаружена ошибка. Объявление под  номером ' . $id . ' отсутствует!';
header ('Location: /index.board?' .SID);
exit;
}
} else {
$_SESSION['info'] = 'Для отправки жалобы необходимо войти на сайт.';
header ('Location: /index.board?' .SID);
exit;
}
break;
case 'sendpret':
if (user_array()) {
$am = tabs ($_POST['am']);
$idnum = mysqlnd :: $open -> queryFetch("SELECT `boards_id` FROM `boards` WHERE `boards_id`=?;", array($id));
if (!empty($idnum)) {
if (!empty($am)) {
mysqlnd :: $open -> query("INSERT INTO `zhaloba` (`zhaloba_user`, `zhaloba_board`, `zhaloba_text`) VALUES(?, ?, ?);", array($_SESSION['logine'], $id, $am));
$_SESSION['info'] = 'Ваша жалоба на объявление №' . $id . ' отправлена администрации.';
header ('Location: /index.board?' .SID);
exit;
} else {
$_SESSION['info'] = 'При проверке обнаружена ошибка. Текст жалобы отсутствует!';
header ('Location: /index.board?vid=pret&id=' . $id . '' .SID);
exit;
}
} else {
$_SESSION['info'] = 'При проверке обнаружена ошибка. Объявление под  номером ' . $id . ' отсутствует!';
header ('Location: /index.board?vid=pret&id=' . $id . '' .SID);
exit;
}
} else {
$_SESSION['info'] = 'Для отправки жалобы необходимо войти на сайт.';
header ('Location: /index.board?' .SID);
exit;
}
break;
default:
header ('Location: /index.board');
exit;
endswitch;
include_once ('' . $vers . '/foot.php');


?>