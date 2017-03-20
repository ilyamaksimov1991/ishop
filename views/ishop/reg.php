<?php
	defined("ISHOP") or die ('Молчание-золото'); 
?> 
 <!--форма -->
 <div class="order-registration-reg">
 <div class="registration-form">
 <form class="order-registration-form-reg"  method="POST">

     <?php
     if ($_SESSION['reg']['res']){
         echo $_SESSION['reg']['res']; // показать ошибки
         unset($_SESSION['reg']); // удаление при обновлении страницы
     }
     ?>

      <h4>Регистрация</h4>  
        
   <table class="Information-for-delivery-reg">
              <tr>
              <td><label for="log">Логин*:</label></td>
              <td><input type="text" name="login" id="log" value="<?php echo $_SESSION['reg']['login']; ?>"/></td>
              <td ><i>Пример: Иванов Сергей Александрович</i></td>
              </tr>

              <tr>
              <td><label for="pasvord">Пароль*:</label></td>
              <td><input type="password" name="pasvord" id="pasvord" value=""/></td>
              <td ><i>Пример: 123fgUm</i></td>
              </tr>
              
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
              
             

      </table>

     <input class="knopca" type="submit" name="reg"  value=" Зарегистрироваться "/>   
 </form>
 <!-- Дальше область контента-->
 

 </div></div>
 
 