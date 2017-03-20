<?php
	# запрет просмотра этой страницы 
defined("ISHOP") or die ("Молчание-золото!");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_ADMIN ?>/style.css" />
<script type="text/javascript" src="<? echo TEMPLATE_ADMIN ?>/js/jquery-1.7.2.min.js"></script>

<script type="text/javascript" src="<? echo TEMPLATE_ADMIN ?>/js/workscripts.js"></script>
<script type="text/javascript" src="<? echo TEMPLATE_ADMIN ?>/js/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="<?php echo TEMPLATE_ADMIN ?>/js/ajaxupload.js"></script>
    <script type="text/javascript" src="<?php echo TEMPLATE_ADMIN?>/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="<?=TEMPLATE_ADMIN?>/js/jquery-ui-1.8.22.custom.min.js"></script>

<title>Список страниц</title>
</head>

<body>
<div class="karkas">
	<div class="head">
		<a href="<?php echo PATH?>/admin"><img src="<?php echo TEMPLATE_ADMIN ?>/images/logoAdm.jpg" /></a>
        <p><a href="<?php echo PATH ?>"> На сайт </a>|
<a href="<?php echo PATH?>/admin"><?php if ($_SESSION['auth']['admin']) { echo $_SESSION['auth']['admin'];}else {echo 'Admin';}?></a> |
            <a href="?do=logaut"><strong>Выйти</strong></a></p>

	</div> <!-- .head -->
