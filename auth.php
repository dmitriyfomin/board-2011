<?php
require_once ('tools/setting.php');
require_once ('tools/vvork.php');
require_once ('tools/str.php');
if (isset($_GET['vid'])) { $vid = tabs ($_GET['vid']);
			} else {
  $vid = 'index';
}
switch ($vid):
case 'index':
if (isset($_POST['login'])) {
$login = tabs ($_POST['login']);
} else {
$login = tabs ($_GET['login']);
}
if (isset($_POST['pass'])) {
$pass = tabs ($_POST['pass']);
} else {
$pass = tabs ($_GET['pass']);
}
if (!empty($login) && !empty($pass)) {
$uzo = mysqlnd :: $open -> queryFetch("SELECT `email`, `pass` FROM `user` WHERE LOWER(`email`)=? LIMIT 1;", array($login));
if (!empty($uzo)) {
if (md5(md5($pass)) == $uzo['pass']) {
$_SESSION['logine'] = $uzo['email'];
$_SESSION['parol'] = $pass;
$_SESSION['info'] = 'Вы авторизованы.';
header ('Location: /index.board?' . SID);
exit;
} 
} 
} 
$_SESSION['info'] = 'Неверные данные';
header ('Location: /index.board');
exit;
break;
case 'exit':
$_SESSION = array();
session_unset();
session_destroy();
header ('Location: /index.board');
exit;
break;
default:
header ('Location: /index.board');
exit;
endswitch;

?>