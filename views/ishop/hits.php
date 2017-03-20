<?php
# запрет просмотра этой страницы 
defined("ISHOP") or die ("Молчание-золото!"); // Если константы не существие тогда покажи сообщение и заверши
//echo print_array($_SESSION);
?>
<div class="obl-cont">
  
  <h1>Хит продаж</h1>
  
  <?php if ($show_phone){
  foreach ($show_phone as $k => $array){   
         
    ?>
  
      <div class="teleffon">
      
      <p><a class="telefon-a"  href="?view=product&goods_id=<?php echo $array['goods_id'] ?>"><?php echo $array['name'] ?></a></p>
      <a href="?view=product&goods_id=<?php echo $array['goods_id'] ?>">
      <img  src="<?php echo  PRODUCTIMG  ?>baseimg/<?php echo $array['img'] ?>"/></a>
      
       <p><span>Цена :</span> <?php echo $array['price'] ?></p>
      <a href="?view=addtocart&goods_id=<?php echo $array['goods_id'] ?>"> 
      <img class="bottom-v-corziny" src="<?php echo TEMPLATE ?>images/addcard-index.jpg"/></a>
      
      </div>   
   <?php }
         }else {
             echo 'товаров в категории пока нет!'; 
             }             
  ?>   

  </div>
