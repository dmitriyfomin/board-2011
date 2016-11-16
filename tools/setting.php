<?php
@ini_set('url_rewriter.tags', '');
	@ini_set ('session.use_only_cookies', 0);
		session_name ('sess');
			session_start ();
if (get_magic_quotes_gpc()) {
$in = array (&$_GET, &$_POST, &$_COOKIE);
while (list($k, $v) = each ($in)) {
foreach ($v as $key => $val) {
if (!is_array($val)) {
$in[$k][$key] = stripslashes ($val);
continue;
}
$in[] = &$in[$k][$key];
}
}
unset ($in);
if (!empty($_FILES)) {
foreach ($_FILES as $k => $v) {
$_FILES[$k]['name'] = stripslashes ((string) $v['name']);
}
}
}
# --------------------- Стандартный класс для PDO -------------------------#
class PDO_ extends PDO {
function __construct($dsn, $username, $password) {
parent :: __construct($dsn, $username, $password);
$this -> setAttribute(PDO :: ATTR_ERRMODE, PDO :: ERRMODE_EXCEPTION);
$this -> setAttribute(PDO :: ATTR_DEFAULT_FETCH_MODE, PDO :: FETCH_ASSOC);
} 
function prepare($sql) {
$stmt = parent :: prepare($sql, array(
PDO :: ATTR_STATEMENT_CLASS => array('PDOStatement_')
));
return $stmt;
}
function query($sql, $params = array()) {
$stmt = $this -> prepare($sql);
$stmt -> execute($params);
return $stmt;
}
function querySingle($sql, $params = array()) {
$stmt = $this -> query($sql, $params);
$stmt -> execute($params);
 return $stmt -> fetchColumn(0);
}
function queryFetch($sql, $params = array()) {
$stmt = $this -> query($sql, $params);
$stmt -> execute($params);
return $stmt -> fetch();
}
}
class PDOStatement_ extends PDOStatement {
function execute($params = array()) {
if (func_num_args() == 1) {
$params = func_get_arg(0);
} else {
$params = func_get_args();
}
if (!is_array($params)) {
$params = array($params);
}
parent :: execute($params);
return $this;
}
function fetchSingle() {
return $this -> fetchColumn(0);
}
function fetchAssoc() {
$this -> setFetchMode(PDO :: FETCH_NUM);
$dato = array();
while ($row = $this -> fetch()) {
$dato[$row[0]] = $row[1];
}
return $dato;
}
}
include_once ('connect.php');
class mysqlnd {
static $open;
public function __construct() {
try {
self :: $open = new PDO_('mysql:host=' . DBHOST . ';port=' . DBPORT . ';dbname=' . DBNAME, DBUSER, DBPASS);
self :: $open -> exec('SET CHARACTER SET utf8');
self :: $open -> exec('SET NAMES utf8');
}
catch (PDOException $e) { 
die('Connection failed: ' . $e -> getMessage());
}
}
final public function __destruct() {
self :: $open = null;
}
}
$nd = new mysqlnd();
$pdo = mysqlnd :: $open -> querySingle("SELECT VERSION();");
if  (preg_replace('/[^0-9\.]/', '', $pdo) < '5.0.0') {
die ('<b>Ошибка! Устаревшая версия PDO-MySQL!</b>');
}
$limitboard = 10; // Объявлений на страницу


?>