<?php
# запрет просмотра этой страницы 
defined("ISHOP") or die ("Молчание-золото!");
?>
<div class="content-main">
		<div class="leftBar">
			<ul class="nav-left">
                <?php $countzakaz = countzakaz();?>
				<li><a <?php activ_str('view=page');  ?>href="<?php echo PATH?>/admin" >Основные страницы</a></li>
  
      <!-- end- акардион -->
				<li><a <?php activ_str("view=informers");  ?>  href="?view=informers">Информеры</a></li>
                <li><a  <?php activ_str('view=major_cat');  ?>href="?view=major_cat">Основные категории</a></></li>
				<li><a <?php //activ_str('view=page');  ?>href="#">Каталог</a></li>
                
                 <!-- акардион -->
                <div class="mobilki">

                    <ul class="spisok" id="accordion">



                        <?php
                        # +++ Вывод меню из базы данных ++++#

                        foreach ($cat as $k => $arr){
                            if  (count($arr) > 1 ){
                                ?>

                                <span><li><a href="#"><?php echo $arr[0]; ?></a></li></span>

                                <ul>
                                    <li class="spisok-ul-li"><a <?php activ_str("view=cat&category=$k");  ?> href="?view=cat&category=<?php echo $k?>">- Все модели</a></li>
                                    <?php foreach ($arr['sub'] as $k1 => $arr2){ // прохожу по второму массивут 5 ?>

                                        <li class="spisok-ul-li"><a <?php activ_str("view=cat&category=$k1");  ?>href="?view=cat&category=<?php echo $k1 ?>">- <?php echo $arr2; ?></a></li>

                                    <?php }	?>
                                </ul>


                            <?php }else if($arr[0]){  // Если есть нулевой элемент выводи:?>
                                <li><a <?php activ_str("view=cat&category=$k");  ?>href="?view=cat&category=<?php echo $k ?>"><?php echo $arr[0]; ?></a></li>

                            <?php } }?>

                    </ul>
</div>
				<li><a <?php activ_str("view=news");  ?>href="?view=news">Новости</a></li>
                <li><a <?php activ_str("view=zakaz");  ?>href="?view=zakaz">Заказы</a></li>
				<li><a <?php //activ_str("view=cat&category=$k");  ?> href="#">Пользователи</a></li>
			</ul>
		</div> <!-- .leftBar -->