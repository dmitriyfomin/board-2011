<?php
require_once ('tools/setting.php');
require_once ('tools/vvork.php');
require_once ('tools/str.php');
include_once ('' . $vers . '/header.php');
if (isset($_GET['vid'])) {$vid = tabs ($_GET['vid']);
			} else {
		$vid = 'index';
} 
if (!user_array()) {
switch ($vid):
case 'index':
echo '<form action="createlog.board?vid=regist&amp;' . SID . '" method="post">
e-mail: <br /><input name="login" maxlength="50" /><br />
������: <br /><input name="parol" type="password" maxlength="20" /><br />
��������� ������: <br /><input name="parol2" type="password" maxlength="20" /><br />
������� ����������� �����, ��������� �� ��������<br />
<input name="digits" size="6" maxlength="5" />&nbsp;<img src="/number.board?' . SID . '" alt="code" /><br /><br />
<div style="text-align:right"><input type="submit" value="���������" /></form></div>';
break;
case 'regist':
$login = tabs ($_POST['login']);
$parol = tabs ($_POST['parol']);
$parol2 = tabs ($_POST['parol2']);
$digits = abs (intval($_POST['digits']));
if ($digits == $_SESSION['digits']) {
if (preg_match('#^([a-z0-9_\-\.])+\@([a-z0-9_\-\.])+(\.([a-z0-9])+)+$#', $login)) {
if (preg_match('|^[a-z0-9\-]+$|i', $parol)) {
if (strlen($login) <= 50 && strlen($parol) <= 20) {
if (strlen($login) >= 3 && strlen($parol) >= 3) {
if ($parol == $parol2) {
if ($login != $parol) {
if (!ctype_digit($parol)) {
if (substr_count($login, '-') < 3) {
$regilogin = mysqlnd :: $open -> querySingle("SELECT `id` FROM `user` WHERE lower(`email`)=? LIMIT 1;", array(strtolower($login)));
if (empty($regilogin)) {
mysqlnd :: $open -> query("INSERT INTO `user` (`email`, `pass`,  `num`) VALUES (?, ?, ?);", array($login, md5(md5($parol)), 3));
echo '������ ��� �����:<br /> e-mail: <b>' . $login . '</b><br />������: <b>' . $parol . '<br /><a href="/login.board?login=' . $login . '&amp;pass=' . $parol . '&amp;' . SID . '">�����</a>';
} else {
getmessage ('��� �������� ���������� ������. ������������ � ����� e-mail ��� ���������������.');
}
} else {
getmessage ('��� �������� ���������� ������. � e-mail ������� ����� �������!');
} 
} else {
getmessage ('��� �������� ���������� ������. ������, ��������� ������ �� ����, �������� � ����� ������������. ������������� ������������ ����� ��� ����� � �����.');
} 
} else {
getmessage ('��� �������� ���������� ������. ������ � e-mail ������ ����������.');
} 
} else {
getmessage ('��� �������� ���������� ������. ������, ������� �� �����, ������.');
} 
} else {
getmessage ('��� �������� ���������� ������. ����� �������� e-mail ��� ������.');
} 
} else {
getmessage ('��� �������� ���������� ������. ����� ������� e-mail ��� ������.');
} 
} else {
getmessage ('��� �������� ���������� ������. ������������ ������� � ������. ��������� ������ ���� ����� ���������� ��������, ����� � �����!');
} 
} else {
getmessage ('��� �������� ���������� ������. ������������ ������� � e-mail. ��������� ������ ���� ����� ���������� ��������, �����, ����� � "@"!');
}
} else {
getmessage ('��� �������� ���������� ������. ����������� ��� ����� �������!');
}
break;
default:
header ('Location: createlog.board?' .SID);
exit;
endswitch;
} else {
getmessage ('�� ��� ������������, ����������� ��� ����������������.');
} 
include_once ('' . $vers . '/foot.php');

?>