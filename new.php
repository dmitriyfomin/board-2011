<?php
require_once ('tools/setting.php');
require_once ('tools/vvork.php');
require_once ('tools/str.php');
include_once ('' . $vers . '/header.php');
if (isset($_GET['vid'])) {$vid = tabs ($_GET['vid']);
			} else {
		$vid = 'index';
} 
if (user_array()) {
switch ($vid):
case 'index':
echo '<b>Добавление объявления:</b><br /><br /><form action="add.board?vid=addnew&amp;' . SID . '" method="post" enctype="multipart/form-data">';
$sqltobc = mysqlnd :: $open -> query("SELECT * FROM `boards` ORDER BY `boards_id` LIMIT 1");
while ($dato = $sqltobc -> fetch()) {
echo 'Тип<br /><select name="typ">';
$typ = ($dato['boards_rub'] == "1") ? ' selected="typ"' : '';
echo '<option value="1">продам</option>';
$typ = ($dato['boards_rub'] == "2") ? ' selected="typ"' : '';
echo '<option value="2">куплю</option>';
$typ = ($dato['boards_rub'] == "3") ? ' selected="typ"' : '';
echo '<option value="3">отдам даром</option>';
$typ = ($dato['boards_rub'] == "4") ? ' selected="typ"' : '';
echo '<option value="4">услуги</option></select><br /><br />';
echo 'Рубрика <span style="color:red">*</span><br /><select name="rubrika">';
$sqltorub = mysqlnd :: $open -> query("SELECT * FROM `categoria` ORDER BY `categoria_id`;");
$rrub = $sqltorub -> fetchAll();
foreach ($rrub as $rowrub) {
$rubrika = $rowrub['categoria_id'] ? ' selected="rubrika"' : '';
echo '<option value="' . $rowrub['categoria_id'] . '">' . $rowrub['categoria_title'] . '</option>';
}
echo '</select><br /><br />
Заголовок <span style="color:red">*</span><br /><input name="head" maxlength="50" /><br /><br />
Цена<br /><span style="color:red">*</span><br /><input name="price" maxlength="50" /><br /><br />
Текст объявления<br /><textarea name="am" maxlength="200" cols="25" rows="3"></textarea><br /><br />
<select name="author">';
$author = ($dato['boards_author'] == "1") ? ' selected="author"' : '';
echo '<option value="1">частное лицо</option>';
$author = ($dato['boards_author'] == "2") ? ' selected="author"' : '';
echo '<option value="2">компания</option></select><br /><br />';
echo 'Контактное лицо<br />
<input name="name" maxlength="99" /><br />
Фото:<br />
<input type="file" name="photo" /><br />
<input type="file" name="photo2" /><br /<br />
Телефон<br/>
<input name="phone" maxlength="20" /><br /><br />
ICQ<br/>
<input name="icq" maxlength="9" /><br /><br />
Skype<br/>
<input name="skype" maxlength="50" /><br /><br /><br />
<div style="text-align:right"><input type="submit" value="Сохранить" /></form></div>';
}
break;
case 'addnew':
$typ = tabs ($_POST['typ']);
$rubrika = tabs ($_POST['rubrika']);
$head = tabs ($_POST['head']);
$price = intval ($_POST['price']);
if ($typ == 3) {
$price = 'Бесплатно!';
}
if (empty($price)) {
$price = 'Договорная';
}
$am = tabs ($_POST['am']);
$author = tabs ($_POST['author']);
$name = tabs ($_POST['name']);
$phone = tabs ($_POST['phone']);
$icq = tabs ($_POST['icq']);
$icq = intval (str_replace('-', '', $icq));
$skype = tabs ($_POST['skype']);
if (!empty($typ)) {
if (!empty($rubrika)) {
if (!empty($head)) {
if (!empty($am)) {
if (!empty($name)) {
if (!empty($author)) {
$boa = mysqlnd :: $open -> querySingle("SELECT `boards_id` FROM `boards` WHERE `boards_title`=? AND `boards_text`=? AND `boards_author`=? AND `boards_price`=? AND `boards_name`=? AND `boards_phone`=? AND `boards_rub`=? AND `boards_cat`=? AND `boards_icq`=? AND `boards_skype`=? AND `boards_pic`=? AND `boards_pic2`=? LIMIT 1;", array($head, $am, $author, $price, $name, $phone, $rubrika, $typ, $icq, $skype, $photoname, $photoname2));
if (empty($boa)) {
$dir = './pics/';
$photo = $_FILES['photo']['tmp_name'];
$photoname = $_FILES['photo']['name'];
$photosize = $_FILES['photo']['size'];
$ra = $_FILES['photo']['type'];
if (!empty($photoname)) {
$photoname = $dir . $photoname;
} else {
$photoname = '';
}
move_uploaded_file ($photo, $photoname);
$photo2 = $_FILES['photo2']['tmp_name'];
$photoname2 = $_FILES['photo2']['name'];
$photosize2 = $_FILES['photo2']['size'];
$ra2 = $_FILES['photo2']['type'];
if (!empty($photoname2)) {
$photoname2 = $dir . $photoname2;
} else {
$photoname2 = '';
}
move_uploaded_file ($photo2, $photoname2);
mysqlnd :: $open -> query("INSERT INTO `boards` (`boards_user`, `boards_title`, `boards_text`, `boards_price`, `boards_name`, `boards_time`, `boards_show`, `boards_view`, `boards_rub`, `boards_author`, `boards_cat`, `boards_pic`, `boards_pic2`, `boards_phone`, `boards_icq`, `boards_skype`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);", array($_SESSION['logine'], $head, $am, $price, $name, date('j.m.Y H:i:s'), 1, 0, $typ, $author, $rubrika, $photoname, $photoname2, $phone, $icq, $skype));
$_SESSION['info'] = 'Ваше объявление усешно добавлено и ожидает проверки менеджера';
header ('Location: index.board?' . SID);
exit;
} else {
getmessage ('При проверке обнаружена ошибка. Такое объявление уже существует!');
}
} else {
getmessage ('При проверке обнаружена ошибка. Не указана категория (частное лицо, компания).');
}
} else {
getmessage ('При проверке обнаружена ошибка. Не указано контактное лицо.');
}
} else {
getmessage ('При проверке обнаружена ошибка. Текст объявления пуст!');
}
} else {
getmessage ('При проверке обнаружена ошибка. Отсутствует название объявления!');
}
} else {
getmessage ('При проверке обнаружена ошибка. Не выбрана рубрика!');
}
} else {
getmessage ('При проверке обнаружена ошибка. Не выбран тип объявления.');
}
echo '<br /><a href="/add.board?' . SID . '">Вернуться к добавлению</a>';
break;
default:
header ('Location: add.board?' . SID);
exit;
endswitch;
} else {
header ('Location: /index.board?' .SID);
} 
include_once ('' . $vers . '/foot.php');

?>