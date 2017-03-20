<?php
	defined("ISHOP") or die ('Молчание-золото'); 
  if (count($_SESSION['cart'])==0){
   
    echo '<div class="empty_basket"><h2>Ваша корзина пуста</h2></div><br />';
    if ($_SESSION['reg']['res']){
	echo $_SESSION['reg']['res']; // показать ошибки
    unset($_SESSION['reg']); // удаление при обновлении страницы
    } 
  }else{  
            
?> 
<div class="order-registration">
    <h2>Оформление заказа</h2>
 
 <table class="order-registration-table" >
 
                 <tr class="table-tr">
                      <td class="table-td">наименование</td>
                      <td>колличесво</td>
                      <td>стоимость</td>
                      <td>удалить  </td>
                  </tr>
                 
 <?php foreach($_SESSION['cart'] as $key=> $item){ ?>  
 
          <tr>
          <td><div class="phone-div"><img src="<?php echo  PRODUCTIMG  ?>baseimg/<?php echo $item['img']?>" width="32" height="61" />
                                      <a href="?view=product&goods_id=<?php echo $key ?>"><?php echo $item['name']?></a ></div></td>
          <td><input id="id<?php echo $key; ?>" class="table-input" type="text" name="quantity" value="<?php echo $item['amount'];?>"/></td>
          <td><span><?php echo $item['price']?></span></td>
          <td><a href="?view=cart&delete_id=<?php echo $key; ?>"><input type="image" src="<?php echo TEMPLATE ?>images/delete.jpg"/></a></td>
          </tr>
 <?php } ?>
 
 </table>
 <div class="itog">
 <p>Итого: <span><?php echo $_SESSION['summa_phone']?> шт &nbsp; <?php echo $_SESSION['total_summ']?> руб.</p></span>
 </div><br />
 
  <!--форма -->
  <form class="order-registration-form-reg" action="#" method="POST"> 
 <div class="order-registration-radio">
      <h4> Способы доставки:</h4><br />
      <div class="Information-for-delivery-reg1">
      <?php foreach($delivery as $array){?>
       <input type="radio" value="<?php echo $array['dostavka_id'] ?>" name="name_radio"/> <?php echo $array['name'] ?><br />
       <?php } ?>
 </div> </div>


      <h4>Информация для доставки:</h4>  
        
   <table class="Information-for-delivery-reg">
              <?php if (!isset($_SESSION['auth']['user'])){ ?>
              <tr>
              <td><label for="fio">ФИО*:</label></td>
              <td><input type="text" name="fio" id="fio" value="<?php echo $_SESSION['reg']['fio']; ?>"/></td>
              <td ><i>Пример: Иванов Сергей Александрович</i></td>
              </tr>
              
              <tr>
              <td><label for="email">Е-маил*:</label></td>
              <td><input type="text" name="email" id="email" value="<?php echo $_SESSION['reg']['email']; ?>"/></td>
              <td><i><i>Пример: test@mail.ru</i></i></td>
              </tr>
              
              
              <tr>
              <td><label for="tlf">Телефон*:</label></td>
              <td><input type="text" name="telefon" id="tlf" value="<?php echo $_SESSION['reg']['telefon']; ?>"/></td>
              <td><i>Пример: 8 937 999 99 99</i></td>
              </tr>
              
              <tr>
              <td><label for="adress">Адрес доставки*:</label></td>
              <td><input type="text" name="adres" id="adress" value="<?php echo $_SESSION['reg']['adres']; ?>"/></td>
              <td><i>Пример: г. Москва, пр. Мира, ул. Петра Великого д.19, кв 51.</i></td>
              </tr>
                            
              <tr>
              <td class="primer"> Примечание</td>
              <td><textarea class="note-form"  name="prim" ></textarea></td>
              <td class="primer"><i>Пример: Позвоните пожалуйста после 10 вечера,до этого времени я на работе </i></td>
              </tr>
              
              <?php }else{ ?>  
                     
              <tr>
              <td class="primer"> Примечание</td>
              <td><textarea class="note-form"  name="prim" ></textarea></td>
              <td class="primer"><i>Пример: Позвоните пожалуйста после 10 вечера,до этого времени я на работе </i></td>
              </tr>
              
              <?php } ?>             
             

      </table>

      <input class="botton-zakaz" type="image" src="<?php echo TEMPLATE ?>images/zakazat.jpg" name="zakaz" alt="Заказать!"/>   
 </form>
 <!-- Дальше область контента-->
 
 <?php
 if ($_SESSION['reg']['res']){
	echo $_SESSION['reg']['res']; // показать ошибки
    unset($_SESSION['reg']); // удаление при обновлении страницы
    }
?>
 </div>
 <?php
	}
?>