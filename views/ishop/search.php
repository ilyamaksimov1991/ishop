 <?php
# запрет просмотра этой страницы 
defined("ISHOP") or die ("Молчание-золото!"); // Если константы не существие тогда покажи сообщение и заверши
?>
 
 <!-- блок КОНТЕНТ -->
  <div class="content-line-vid">
  <!-- хлебная крошка -->
 
  <div class="crochca">
  <p><a href="?view=hits " >Мобильные телефоны</a> / <span>Результат поиска</span></p>
  </div>
  <div class="sort">

  </div>
  
  <!-- ++ НАЧАЛО текст с ссылкой на товар ++-->
  <div class="searh_phone"><h3>Результат Поиска:</h3></div>
   
 <?php //print_array($result);
 if( $_SESSION['search']){ echo  $_SESSION['search']; unset($_SESSION['search']);} 
  ?>  
    <?php
   for ($i=$start_position; $i< $end_position; $i++){ // изменить если не будет?>   
	 <div class="tabl-vid-phone">
        <h4><a href="?view=product&goods_id=<?php echo $result[$i]['goods_id'] ?>" ><?php echo $result[$i]['name'] ?></a></h4>
        <div class="bloc-c-image">
               <div class="bloc-c-image-phone"> 
               <a href="?view=product&goods_id=<?php echo $result[$i]['goods_id'] ?>" >
               <img src="<?php echo PRODUCTIMG ?>baseimg/<?php echo $result[$i]['img'] ?>" width="64" height="125" /> </a>
               
                    <div class="tabl-ico">
<?php if ($result[$i]['new'] == 1){ echo "<img src='".TEMPLATE."images/tabl-ico-line-new.jpg'/>";} ?>
<?php if ($result[$i]['sale'] == 1){ echo "<img src='".TEMPLATE."images/tabl-ico-line-sale.jpg'/>";} ?>
<?php if ($result[$i]['hits'] == 1){ echo "<img src='".TEMPLATE."images/tabl-ico-line-lider.jpg'/>";} ?>
                       
                    </div>
                    
                </div>   
        </div>

        <p><a href="?view=product&goods_id=<?php echo $result[$i]['goods_id'] ?>" >подробнее...</a></p>
        <p>Цена: <span><?php echo $result[$i]['price'] ?></span></a></p>
        <a href="?view=addtocart&goods_id=<?php echo $result[$i]['goods_id'] ?>" >
        <img src="<?php echo TEMPLATE ?>images/addcard-table.jpg" width="123" height="27" /></a>
  </div>
<?php  }  ?> 

  <!-- ++ КОНЕЦ текст с ссылкой на товар ++-->
</div>
   
  