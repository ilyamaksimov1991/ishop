<?php
# запрет просмотра этой страницы 
defined("ISHOP") or die ("Молчание-золото!"); 
?>

<div class="content-line-vid">
  <!-- хлебная крошка -->
  <div class="crochca">
  <p><a href="<?php echo PATH ?>" >Мобильные телефоны</a> / <span>Все новости</span></p>
  </div>
  
  
  <!-- ++ Страница Текста НАЧАЛО ++--> 
<div class="text-page">
<!--  верхний  div не трогать!-->
<?php
	if($arhive_news){
?>
<?php foreach ($arhive_news as $arr){ ?>

<h1 class="text-page-arhive"><a href="?view=news&id=<?php echo $arr['news_id'] ?>"><?php echo $arr['title']?></a></h1>
<p><?php echo $arr['date']?></a></p>
<p><?php echo $arr['anons']?></p>
<p><a href="?view=news&id=<?php echo $arr['news_id'] ?>">Подробне.. </a></a></p><br /><br />
<?php
}if($amount_page > 1){ pagination($page,$amount_page);}
	}else{echo "<div class='Text-reg-error-1'><h3>Новостей пока нет!</h3></div>";}
?>

<!--  нижний div не трогать!-->
</div> 
   <!-- ++ КОНЕЦ Страница Текста ++-->
  
  
  </div>