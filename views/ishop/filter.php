 <?php
# запрет просмотра этой страницы 
defined("ISHOP") or die ("Молчание-золото!"); 
?>
 
 <!-- блок КОНТЕНТ -->
  <div class="content-line-vid">
  <!-- хлебная крошка -->
  <div class="crochca">
  <p><a href="?view=hits" >Мобильные телефоны</a> /<span>Результат поиска</span></p>
  </div>
      <div class="sort">
          <p>Вид: <?php if ($line == 1){$image1 = "vid-tabl1.gif"; $image2 = "vid-line1.gif";}else{$image1 = "vid-tabl.gif"; $image2 = "vid-line.gif"; }?>
              <a href="?view=filter&ot=<?=$ot?>&do=<?=$do?>&cat=<?php echo $brand ?>&sort=<?php echo $sort_a ?>&vid=2"><img src="<?php echo TEMPLATE ?>images/<?php echo $image1 ?>"class="vid" /></a>
              <a href="?view=filter&ot=<?=$ot?>&do=<?=$do?>&cat=<?php echo $brand ?>&sort=<?php echo $sort_a ?>&vid=1"> <img class="vid" src="<?php echo TEMPLATE ?>images/<?php echo $image2 ?>"/></a>
              <span>Сортировать по: </span>&nbsp;

              <a id="sort_clic" class="sort-top-act" href="&"><?php echo $sort_a?></a> &nbsp;  &nbsp;
          </p>
          <div class="sort_hidden">
              <?php foreach($sort_category as $key=> $array){ ?>

                  <a class="sort-bot1" href="?view=filter&ot=<?=$ot?>&do=<?=$do?>&cat=<?php echo $brand ?>&sort=<?php echo $key ?>">
                      <?php if ($key==$sort){continue;}else{echo $array[0];}?>
                  </a><br />

              <?php } ?>
          </div>
      </div>
  
  <!-- ++ НАЧАЛО текст с ссылкой на товар ++-->
  <div class="searh_phone"><h3>Результат поиска по параметрам:</h3></div>
  
 <?php
 if (isset($result_searh['notfound'])){ 
    echo $result_searh['notfound'];
    }else{
      foreach ($result_searh as $array){ ?>
          <?php if ($line != 1){?>
	 <div class="tabl-vid-phone">
        <h4><a href="?view=product&goods_id=<?php echo $array['goods_id'] ?>" ><?php echo $array['name'] ?></a></h4>
        <div class="bloc-c-image">
               <div class="bloc-c-image-phone"> 
               <a href="?view=product&goods_id=<?php echo $array['goods_id'] ?>" >
               <img src="<?php echo  PRODUCTIMG  ?>baseimg/<?php echo $array['img'] ?>" width="64" height="125" /> </a>
               
                    <div class="tabl-ico">
<?php if ($array['new'] == 1){ echo "<img src='".TEMPLATE."images/tabl-ico-line-new.jpg'/>";} ?>
<?php if ($array['sale'] == 1){ echo "<img src='".TEMPLATE."images/tabl-ico-line-sale.jpg'/>";} ?>
<?php if ($array['hits'] == 1){ echo "<img src='".TEMPLATE."images/tabl-ico-line-lider.jpg'/>";} ?>
                       
                    </div>
                    
                </div>   
        </div>

        <p><a href="?view=product&goods_id=<?php echo $array['goods_id'] ?>" >подробнее...</a></p>
        <p>Цена: <span><?php echo $array['price'] ?></span></a></p>
        <a href="?view=addtocart&goods_id=<?php echo $array['goods_id'] ?>" >
        <img src="<?php echo TEMPLATE ?>images/addcard-table.jpg" width="123" height="27" /></a>
  </div>
<?php }else{?>
<div class="text-c-silkoy">

  <div class="image-mini-phone"><a href="?view=product&goods_id=<?php echo $array['goods_id'] ?>">
  <img src="<?php echo PRODUCTIMG ?>baseimg/<?php echo $array['img'] ?>" width="46" height="87"/></a></div>


  <div class="price-basket-more-detailed">
        <p><span>Цена :</span>  <?php echo $array['price'] ?></p>
      <a href="?view=addtocart&goods_id=<?php echo $array['goods_id'] ?>">
          <img class="add-to-cart" src="<?php echo TEMPLATE ?>images/addcard-table.jpg" alt="Добавить в корзину"/></a>

      <div class="img-opisanie">

          <?php if ($array['new'] == 1){ echo "<img src='".TEMPLATE."images/ico-line-new.jpg'/>";} ?>
          <?php if ($array['sale'] == 1){ echo "<img src='".TEMPLATE."images/ico-line-sale.jpg'/>";} ?>
          <?php if ($array['hits'] == 1){ echo "<img src='".TEMPLATE."images/ico-line-lider.jpg'/>";} ?>

      </div>

      <p><span><a href="?view=product&goods_id=<?php echo $array['goods_id'] ?>">подробнее...</a></span></p>
  </div>
 <div class="mini-description">

     <a href="?view=product&goods_id=<?php echo $array['goods_id'] ?>"><?php echo $array['name'] ?></a>
     <?php echo $array['anons'] ?>

 </div>
 </div>

  <?php        }


      }} ?>
 
  <!-- ++ КОНЕЦ текст с ссылкой на товар ++-->
  
  </div>