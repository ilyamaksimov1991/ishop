<?php
# запрет просмотра этой страницы 
defined("ISHOP") or die ("Молчание-золото!"); ;
?>
<div class="content-line-vid">
  <!-- хлебная крошка -->
  <div class="crochca">
  <p><a href="<?php echo PATH ?>" >Мобильные телефоны</a> / <span><?php echo $page_menu[0]['title']?></span></p>
  </div>
  
  
  <!-- ++ Страница Текста НАЧАЛО ++--> 
<div class="text-page">
<!--  верхний  div не трогать!-->
<?php
	if($page_menu){
?>
<?php foreach ($page_menu as $arr){ ?>

<h1><?php echo $arr['title']?></h1>
<p><?php echo $arr['text']?></p>

<?php
	}}else{echo "<div class='Text-reg-error-1'><h3>Taкой страницы нет!</h3></div>";}
?>
<!--  нижний div не трогать!-->
</div> 
   <!-- ++ КОНЕЦ Страница Текста ++-->
  
  
  </div>