<?php
if (user_array()) {
echo '<a href="/add.board?' . SID . '">Добавить объявление</a><br />
<a href="/myboards.board?' . SID . '">Мои объявления</a><br />';
if (adrn_array(array(1, 2))) {
echo '<a href="/adm/index.board?' . SID . '">Управления объявлениями</a><br />';
}
echo '<a href="http://dfboard.wlantele.com/login.board?vid=exit&amp;">Выйти</a><br />';
} else {
echo '<br /><form action="login.board?" method="post">e-mail:<input name="login" maxlength="50" />  Пароль:<input type="password" name="pass" maxlength="20" /><input type="submit" value="Вход" /></form> <a href="createlog.board?' . SID . '">Регистрация</a><hr color="#8a2be2" />';
}

?>