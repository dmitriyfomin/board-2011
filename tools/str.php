<?php
# ----------------------- ������  � ����������� ����������� -------------------------#
if (empty($_SESSION['logine'])) {
$uzlogin = '�����';
} else {
$uzlogin = $_SESSION['logine'];
}
if (empty($_SESSION['digits'])) {
$_SESSION['digits'] = mt_rand (1000, 9999);
}

# ----------------------- ���� � ������� -------------------------------------------------#
if (user_array()) {
$logine = tabs ($_SESSION['logine']);
$uzo = mysqlnd :: $open -> queryFetch("SELECT * FROM `user` WHERE `email`=? LIMIT 1;", array($logine));
}

# ------------------------ ��� --------------------------------------------------------------#
header ('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
header ('Expires: ' . date('r'));

# ----------------------- ����������� ������ -----------------------------------------#
if (!empty($_SERVER['HTTP_USER_AGENT'])) {
if (stros($_SERVER['HTTP_USER_AGENT'], array('bsd', 'linux', 'mac', 'macintosh', 'macos', 'unix', 'win', 'win95', 'win98', 'winnt', 'windows', 'windows95', 'windows98', 'x11'))) {
$vers = 'www';
}
}


?>