<?php
if (user_array()) {
echo '<a href="/add.board?' . SID . '">�������� ����������</a><br />
<a href="/myboards.board?' . SID . '">��� ����������</a><br />';
if (adrn_array(array(1, 2))) {
echo '<a href="/adm/index.board?' . SID . '">���������� ������������</a><br />';
}
echo '<a href="http://dfboard.wlantele.com/login.board?vid=exit&amp;">�����</a><br />';
} else {
echo '<br /><form action="login.board?" method="post">e-mail:<input name="login" maxlength="50" />  ������:<input type="password" name="pass" maxlength="20" /><input type="submit" value="����" /></form> <a href="createlog.board?' . SID . '">�����������</a><hr color="#8a2be2" />';
}

?>