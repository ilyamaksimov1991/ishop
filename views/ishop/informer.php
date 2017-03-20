<?php
# запрет просмотра этой страницы 
defined("ISHOP") or die ("Молчание-золото!"); 
?>

<div class="content-line-vid">
  <!-- хлебная крошка -->
  <div class="crochca">
  <p><a href="<?php echo PATH ?>" >Мобильные телефоны</a> / 
  <span><?php echo mb_substr($informer_show[0]['informer_name'],0,-1,"UTF-8") ?></span> 
  / <span><?php echo $informer_show[0]['link_name'] ?></span></p>
  </div>
  
  
  <!-- ++ Страница Текста НАЧАЛО ++--> 
<div class="text-page">
<!--  верхний  div не трогать!-->
<?php
	if($informer_show){?>
<?php foreach ($informer_show as $arr){ ?>

<h1><?php echo $arr['link_name']?></h1>
<p><?php echo $arr['text']?></a></p>
<?php
}}else{echo "<div class='Text-reg-error-1'><h3>Новостей пока нет!</h3></div>";}
?>

<!--  нижний div не трогать!-->
</div> 
   <!-- ++ КОНЕЦ Страница Текста ++-->
  
  
  </div>