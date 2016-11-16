<?php
header ('Content-Type: text/html; charset=utf-8');
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
			<head><title>Доска объявлений</title>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
			<link rel="stylesheet" href="http://dfboard.wlantele.com/www/style.css" type="text/css" />
			<meta name="keywords" content="доска объявлений, куплю, продам, отдам даром, услуги, " />
			<meta name="description" content="объявления о продаже, покупке, услугах" />
		<meta name="generator" content="DFBoard 2011" />
	<meta name="author" content="Dmitry Fomin" />
</head><body><div id="container"><div id="container"><div id="main_content"><div class="content">';
if (isset($_SESSION['info'])) {
echo '<span style="color:red;font-weight:bold;font-size:14px">' . $_SESSION['info'] . '</span><br />';
}

?>