<?php
# запретить доступ напрямую - тоько через контролер
defined("ISHOP") or die ('Молчание-золото'); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <script type="text/javascript" src="<?php echo TEMPLATE ?>js/functions.js"></script>
  
<script type="text/javascript" src="<?=TEMPLATE?>js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?=TEMPLATE?>js/jquery-ui-1.8.22.custom.min.js"></script>
<script type="text/javascript" src="<?=TEMPLATE?>js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?=TEMPLATE?>js/workscripts.js"></script>
     <!-- Fancybox -->
     <script type="text/javascript" src="./fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
     <script type="text/javascript" src="./fancybox/jquery.fancybox-1.3.4.pack.js"></script>
     <link rel="stylesheet" type="text/css" href="./fancybox/jquery.fancybox-1.3.4.css" media="screen" />
     <!-- Fancybox -->
   
  <link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE ?>css/style.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE ?>css/text.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE ?>css/style2.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE ?>css/order-reg.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE ?>css/detal-line.css"/>

  <title><?php echo TITLE ?></title>
 </head>
 <body>
 <!-- Начало всего обшего div -->
  <div class="main">
   <!-- div - шапка -->
  <div class="header">
  <a href="?view=hits"><img class="logo" src="<?php echo TEMPLATE ?>images/logotip.jpg" alt="Интернет магазин сотовых телефонов" /></a>
  <img class="slogan" src="<?php echo TEMPLATE ?>images/slogan.jpg" alt="сотовые телефоны"/>
  <!-- div - контакты -->
  <div class="head-contact">
  <p><b>Телефон:</b><br/><span>8 (800) 700-00-01</span></p>
  <p><b>Режим работы:</b><br/>
Будние дни: с 9:00 до 18:00 <br/> 
Суббота, Воскресенье - выходные  </p>
</div>
<form method="GET" action="">
<ul class="serh-head">
<li>
<input type="hidden" name="view" value="search"/>
<input type="text" name="look" id="quickquery" placeholder="Что вы хотите купить?" />
<script type="text/javascript">
//<![CDATA[
placeholderSetup('quickquery');
//]]>
</script>
</li>
<li><input class="poisk-buttom" type="image" src="<?php echo TEMPLATE ?>images/buttom.jpg" name="submit" alt="Найти" /></li>
</ul>
</form>
  
  </div>
  <ul class="menu">
  <li><a href="?">Главная </a></li>
  <?php foreach ($menu as $key=> $arr ){?>
   <li><a href="?view=page&page_id=<?php echo $arr['page_id']; ?>"><?php echo $arr['title'] ?> </a></li>
   <?php } ?>
  </ul>
  
 