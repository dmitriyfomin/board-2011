<?php
require_once ('../tools/setting.php');
require_once ('../tools/vvork.php');
require_once ('../tools/str.php');
include_once ('../' . $vers . '/header.php');
if (adrn_array()) {
echo '<a href="http://dfboard.wlantele.com/index.board?' . SID . '">ќбъ€влени€</a> &raquo;”правление объ€влени€ми<br /><br />';
if (adrn_array(array(1, 2))) {
$sqltonew = mysqlnd :: $open -> queryFetch("SELECT count(*) `boards_id` FROM `boards` WHERE `boards_view`=?;", array(0));
$sqltocozh = mysqlnd :: $open -> queryFetch("SELECT count(*) `zhaloba_id` FROM `zhaloba`;");
echo '<a href="boards.board?' . SID . '">”правление объ€влени€ми</a> (на модерацию ' . $sqltonew['boards_id'] . ')<br /><a href="zhaloby.board?' . SID . '">∆алобы</a> (' . $sqltocozh['zhaloba_id'] . ')<br /><br />';
}
} else {
header ('Location: /index.board?' . SID);
}
include_once ('../' . $vers . '/foot.php');

?>