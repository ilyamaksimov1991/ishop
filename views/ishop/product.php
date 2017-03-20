 <?php
# запрет просмотра этой страницы 
defined("ISHOP") or die ("Молчание-золото!"); // Если константы не существие тогда покажи сообщение и заверши
?>
 
 <!-- блок КОНТЕНТ -->
  <div class="content-line-vid">
  <!-- хлебная крошка -->
  <div class="crochca">
  <?php if(count($bread_crumbs)>1){?>
  <p><a href="<?php echo PATH ?>" >Мобильные телефоны</a> /
   <a href="?view=cat&category=<?php echo $bread_crumbs[0]['brand_id'] ?>">
  <?php echo $bread_crumbs[0]['brand_name'] ?></a> / 
  <a href="?view=cat&category=<?php echo $description[0]['goods_brandid']?>" ><?php echo $bread_crumbs[1]['brand_name'] ?></a> / 
  <span><?php echo $description[0]['name'] ?></span></p></p>
<?php } ?>

<?php if(count($bread_crumbs)== 1){?>
  <p><a href="<?php echo PATH ?>" >Мобильные телефоны</a> / 
  <a href="?view=cat&category=<?php echo $description[0]['goods_brandid']?>" ><?php echo $bread_crumbs[0]['brand_name'] ?></a>  
  / <span><?php echo $description[0]['name'] ?></span></p>
<?php } ?>
  </div>
  <?php if ($description>0){ ?>

<div class="text-page">
<h1><?php echo $description[0]['name']; ?></h1>
<div class="catalog-detail">

<div class="brief-description-img"><img src="<?php echo PRODUCTIMG ?>baseimg/<?php echo $description[0]['img']; ?>" height="305" /></div>
<div class="brief-description">
        <div class="brief-description-img">
             <?php if ( $description[0]['new'] == 1){ echo "<img src='".TEMPLATE."images/tabl-ico-line-new.jpg'/>";} ?>
            <?php if ( $description[0]['sale'] == 1){ echo "<img src='".TEMPLATE."images/tabl-ico-line-sale.jpg'/>";} ?>
            <?php if ( $description[0]['hits'] == 1){ echo "<img src='".TEMPLATE."images/tabl-ico-line-lider.jpg'/>";} ?>
        </div>

        <div class="brief-description-1">
        <h4>Краткое описание:</h4><br />
        <!-- анонс  -->
        <?php echo $description[0]['anons']; ?>


        <h4>Цена: <span> <?php echo $description[0]['price']; ?></span></h4>
       <a href="?view=addtocart&goods_id=<?php echo $description[0]['goods_id']; ?>" ><img src="<?php echo TEMPLATE ?>images/addcard-index.jpg" width="165" height="35" /></a>
    </div><br /><br /></div>

    <!--  полное описание!-->
    <div class="full-description">
        <?php if (isset($desc)){ // если сущетсвует галерея?>
            <div class="item_gallery">

                <div class="item_thumbs">
                    <?php foreach ($desc as $image ){ // если есть в галереи картинки ?>
                        <a rel="galery" href="<?php echo PRODUCTIMG ?>photos/<?php echo $image ?>"><img src="<?php echo PRODUCTIMG ?>thumbs/<?php echo $image ?>" /></a>

                    <?php } ?>
                </div> <!-- .item_thumbs -->

            </div> <!-- .item_gallery -->
        <?php } ?>

    <h3>Описание телефона: </h3>
   <?php echo $description[0]['content']; ?>
    
 
 </div>   

</div> 
<?php
	}else{
	   echo "<div class='Text-reg-error-1'>Такого товара нет!</div>";
	} 
?>
</div></div>
<?php
//	print_array($description);
  // print_array($desc);
?>