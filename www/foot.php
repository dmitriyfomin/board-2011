<?php
echo '</div><div class="menu"><div class="menu_title">дняйю назъбкемхи</div><ul>';
$sqltoall = mysqlnd :: $open -> query("SELECT *  FROM `categoria`;");
$rowallcats = $sqltoall -> fetchAll();
foreach ($rowallcats as $rowallcat) {
$sqltocountcat = mysqlnd :: $open -> query("SELECT COUNT(*) `boards_id` FROM `boards` WHERE `boards_show`=? AND `boards_view`=? AND `boards_cat`=?;", array(1, 1, $rowallcat['categoria_id']));
$rowcount = $sqltocountcat -> fetchAll();
foreach ($rowcount as $rowcountcat) {
echo '<li><a href="/razdel.board?vid=view&amp;rz=' . $rowallcat['categoria_id'] . '&amp;' . SID . '" class="menu_link">' . $rowallcat['categoria_title'] . '</a> (' . $rowcountcat['boards_id'] . ')</li>';
}
}
echo '</ul></div><div id="clear"></div></div><div id="footer">';
if (isset($_SESSION['info'])) {
unset ($_SESSION['info']);
} 
echo '<div style="text-align:left"></div></body></html>';

?>