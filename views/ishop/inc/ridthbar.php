<?php
	defined("ISHOP") or die ('Молчание-золото'); 
?> 
 <!-- блок Сайтбар ПРАВЫЙ -->
  <div class="saidbar-ridhe"> 
  
        <!-- Сайтбар ПРАВЫЙ Аторизация-->
  <div class="autoresize">
  
  <h2><a href="<?php echo TEMPLATE ?>" >Авторизация</a></a></h2>
  
  <div id="autores">
  <?php if (!isset($_SESSION['auth']['user'])){ //Если не существует переменной с именем пользователя?>
	   <form method="POST" >
       <label for="login">Логин:</label><br />
       <input type="text" id="login" name="login"/><br/>
       <label for="password">Пароль:</label><br/>
       <input type="password" id="password" name="pasword"/><br/><br/>
       <input class="knopca-autores" type="submit" name="auth" value=" Авторизиваться " /><br/>
       
       <a href="?view=reg">Регистрация</a>
       
       </form>
       <?php
	if (isset($_SESSION['reg']['result'])){ // если существует такая ошибка
	  echo ($_SESSION['reg']['result']); // вывести ее
      unset ($_SESSION['reg']['result']); // и удалить
	}
?>
<?php
	
	}else {
	   echo " Добро пожаловать<br />".$_SESSION['auth']['user'];?>
       
	<a href="?do=logout" >Выйти</a>
<?php
	}
?>
  
  
  </div></div>
  
         <!-- Сайтбар ПРАВЫЙ Корзина-->
         <?php
	if(!isset($_SESSION['cart'])){?>
	 <div class="autoresize"><h2><a href="<?php echo TEMPLATE ?>" >Корзина</a></h2><p> Ваша корзина пуста</p>
      </div>	 
       
<?php	}else{ ?>
  <div class="autoresize"><h2><a href="<?php echo TEMPLATE ?>" >Корзина</a></h2><p>Товаров в корзине:<br />
  <span><?php echo $_SESSION['summa_phone']?></span> на сумму: <span> <?php echo $_SESSION['total_summ'];?></span>  руб.
</p> <a href="?view=cart" ><img src="<?php echo TEMPLATE ?>images/oformit.jpg" alt="Оформить заказ" /></a></div>
  <?php } ?>
         <!-- Сайтбар ПРАВЫЙ Корзина-->
 <div class="parameter-selection"><h2><a href="<?php echo TEMPLATE ?>">Выбор по параметрам</a></h2>
 <form class="form" method="GET" >
   Стоимость: <br />
       <input type="hidden" name="view"  value="filter" />
  <p>
  от  <input class="input-text" type="text" name="ot" value="<?php echo $ot ?>"/>  
  до  <input class="input-text" type="text" name="do" value="<?php echo $do ?>"/> руб.</p><br />
 Производители:<br /><br />

<?php 
foreach ($cat as $k => $arr){ 
    if  ($arr[0]){ ?>

<input type="checkbox" name="brand[]" id="<?php echo $k ?>" value="<?php echo $k ?>" 
<?php if ($k == $brand_phone[$k]){ echo "checked";}?>/>

<label for="<?php echo $k ?>" > <?php echo $arr[0]; ?></label><br />

 <?php }} ?>
                              
 <input class="input-image" type="image" src="<?php echo TEMPLATE ?>images/podbor.jpg"/>
 </form>
  </div>       
 </div>