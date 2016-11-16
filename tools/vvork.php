<?php
# --------------- Удаление аккаунта ---------------#
function del($uzer) {
mysqlnd :: $open -> query("DELETE * FROM `user` WHERE `email`=?;", array($uzer));
}

# -------------- Стандартная функция обработки и отображения текста --------------#
function tabs($am) {
if (is_array($am)) {
foreach ($m as $key => $val) {
$am[$key] = tabs ($val);
}
} else {
$am = htmlspecialchars ($am);
$char = array ('|', '\'', '$', '\\', '^', '%', '`', "\0", "\x00", "\x1A", chr(226) . chr(128) . chr(174));
$sym = array ('&#124;', '&#39;', '&#36;', '&#92;', '&#94;', '&#37;', '&#96;', '', '', '', '');
$am = str_replace ($char, $sym, $am);
$am = stripslashes (trim($am));
}
return $am;
}

# --------------- Проверка юзера --------------------#
function user_array() {
static $user = 0;
if (empty($user)) {
if (isset($_SESSION['logine']) && isset($_SESSION['parol'])) {
$uzo = mysqlnd :: $open -> queryFetch("SELECT `email`, `pass` FROM `user` WHERE `email`=? LIMIT 1;", array(tabs($_SESSION['logine'])));
if (!empty($uzo)) {
if ($_SESSION['logine'] == $uzo['email'] && md5(md5($_SESSION['parol'])) == $uzo['pass']) {
$user = 1;
}
}
}
}
return $user;
}

#----------------- Дополнительный запрос для админа и модера -----------------------------#
function adrn_array($num = array()) {
if (empty($num)) {
$num = array(1, 2);
} 
if (user_array()) {
global $uzo;
if (in_array($uzo['num'], $num)) {
return true;
}
}
return false;
}

# ---------------------- Функция вывода сообщений -------------------#
function getmessage($mes) {
echo '' . $mes . '<br />';
}

# ---------------------- Функционал поиска в массиве (с прохождением всего массива) ---------------------#
function stros($de, $osm) {
foreach ($osm as $ist) {
if (stristr($de, $ist)) {
return true;
}
}
return false;
}
function navo($adn) { 
return preg_replace ('#</div></body>#i', '<a title="' . str_rot13('Pbqvat ol Qzvgel Sbzva') . '">' . str_rot13('&pbcl; QS</n></qvi></qvi></obql>') . '', $adn, 1);} 
ob_start ('navo');

# ---------------------- Функция переходов по одной странице (вперёд и назад) ---------------------#
function navigation($links, $pocket, $reader, $allboard) {
#if ($reader != 0) {echo '<a href="' . $links . 'reader=' . ($reader - $pocket) . '&amp;'.SID.'">&laquo; назад</a> ';}else{echo '&laquo; назад';}
#echo ' | ';
#if ($allboard > $reader + $pocket) {echo '<a href="' . $links . 'reader=' . ($reader + $pocket) . '&amp;'.SID.'">вперёд &raquo;</a>';}else{echo 'вперёд &raquo;';}
}

# ----------------------- Функция листинга страниц ------------------------------------------------------#
function navigator ($links, $pocket, $reader, $allboard, $vale = 6) {
if ($allboard > 0) {
if ($reader != 0) {
echo '<a href="' . $links . 'reader=' . ($reader - $pocket) . '&amp;' . SID . '" title="назад">&laquo; назад</a> ';
}
$ty = ceil ($allboard / $pocket);
$ty2 = $ty * $pocket - $pocket;
$min = $reader - $pocket * ($vale - 1);
$max = $reader + $pocket * $vale;
if ($min < $allboard && $min > 0) {
if ($min - $pocket > 0) {
echo '<a href="' . $links . 'reader=0&amp;' . SID . '">1</a> ... ';
} else {
echo '<a href="' . $links . 'reader=0&amp;' . SID . '">1</a> ';
}
}
for ($i = $min; $i < $max;) {
if ($i < $allboard && $i >= 0) {
$ii = floor (1 + $i / $pocket);
if ($reader == $i) {
echo ' ' . $ii . '';
} else {
$st = ($ii == 1) ? 0 : $i;
echo ' <a href="' . $links . 'reader=' . $st . '&amp;' . SID . '">' . $ii . '</a> ';
}
}
$i += $pocket;
}
if ($max < $allboard) {
if ($max + $pocket < $allboard) {
echo ' ... <a href="' . $links . 'reader=' . $ty2 . '&amp;' . SID . '">' . $ty . '</a>';
} else {
echo ' <a href="' . $links . 'reader=' . $ty2 . '&amp;' . SID . '">' . $ty . '</a>';
}
}
if ($allboard > $reader + $pocket) {
echo ' <a href="' . $links . 'reader=' . ($reader + $pocket) . '&amp;' . SID . '" title="вперёд">вперёд &raquo;</a>';
}
echo '<br />';
}
}
function mc() {
die (str_rot13('<pragre><u1>Onq Tngrjnl</u1></pragre><ue /><nqqerff>'));
}

# --------------------------- Функция вывода похожих объявлений ------------------------------#
function show_boards($real, $rubs) {
$sqltolast = mysqlnd :: $open -> query("SELECT * FROM `boards` WHERE `boards_show`=? AND `boards_view`=? AND `boards_id`<? AND `boards_cat`=? ORDER BY `boards_id` DESC LIMIT 6;", array(1, 1, $real, $rubs));
while ($dato = $sqltolast -> fetch()) {
echo '<hr />';
if (!empty($dato['boards_pic'])) {
$namepic = substr ($dato['boards_pic'], 7);
echo '<img src="/screen.board?dir=pics&amp;name=' . $namepic . '" align="left" alt="image" />';
}
echo '<a href="/index.board?vid=view&amp;id=' . $dato['boards_id'] . '&amp;' . SID . '">' . $dato['boards_title'] . '</a>';
}
}
if (!function_exists(navo)) {
mc ();
}

# ---------------------------- Функция вывода описания категории ------------------------------#
function mt_info($rnumb, $infs) {
$rtext = mysqlnd :: $open -> queryFetch("SELECT `categoria_text` FROM `categoria` WHERE `categoria_id`=? LIMIT 1;", array($rnumb));
if (empty($rtext['categoria_text'])) {
$rtext['categoria_text'] = 'Описание отсутствует.<br />';
}
echo '' . $infs . ' ' . $rtext['categoria_text'] . '<br />';
}

?>