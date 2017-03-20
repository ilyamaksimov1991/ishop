<?php
	defined("ISHOP") or die ('Молчание-золото');
?> 
 <!-- НАЧАЛО Сайтбар ЛЕВЫЙ -->
  <div class="saidbar-left">
  
  <!-- Сайтбар ЛЕВЫЙ - КАТАЛОГ -->
  <div class="catalog">
  
       <h2 class="h2-catalog"><a href="?view=hits">Каталог</a></h2>
            <h3 class="new"><a href="?view=new">Новинки</a></h3>
            <h3 class="lider"><a href="?view=hits">Лидеры продаж</a></h3>
            <h3 class="sali"><a href="?view=sale">Распродажа</a></h3>
       
       </div>
       <!-- Сайтбар ЛЕВЫЙ - Мобильные Телефоны -->
      <div class="mobilki">
      <h2 class="h2-mobilki"><a href="<?php echo TEMPLATE ?>">- Мобильные телефоны</a></h2>
         <ul class="spisok" id="accordion">



<?php
# +++ Вывод меню из базы данных ++++#

foreach ($cat as $k => $arr){
if  (count($arr) > 1 ){
?>

<span><li><a href="#"><?php echo $arr[0]; ?></a></li></span>
  
     <ul>
        <li class="spisok-ul-li"><a href="?view=cat&category=<?php echo $k?>">- Все модели</a></li>

           <?php foreach ($arr['sub'] as $k => $arr2){ // прохлжу по второму массивут 5 ?>               
 
      <li class="spisok-ul-li"><a href="?view=cat&category=<?php echo $k ?>">- <?php echo $arr2; ?></a></li>
	                                     
            <?php }	?> 
     </ul> 
 
 
   <?php }else if($arr[0]){  // Если есть нулевой элемент выводи:?>
   <li><a href="?view=cat&category=<?php echo $k ?>"><?php echo $arr[0]; ?></a></li>

<?php } }?>

         </ul>
	                    
                        
                        
                        
                        
                        
                        
      
      </div>
        <!-- Сайтбар ЛЕВЫЙ - Контакты -->
      <div class="work-mode">
      <p class="contact">Контакты:</p><br/>
      <p class="telefon">Телефон:<br/>
            <span> 8 (800) 700-00-01</span></p><br/>

      <p class="job-hours"><b>Режим работы:</b><br />
         Будние дни: <br />
         с 9:00 до 18:00<br />
         Суббота, Воскресенье:<br />
         выходные</p>       
      </div>
      
      <!-- Сайтбар ЛЕВЫЙ - Новости -->
      <div class="news"> <h3>Новости:</h3>
      <?php foreach ($news as $arr){?>
           <span><?php echo $arr['date']?></span><br />
              <p><a href="?view=news&id=<?php echo $arr['news_id'] ?>"><?php echo $arr['title']?></a><br />
                          </p>
        <?php }?>
           
         <p class="batton"><a href="?view=arhive">Архив новостей</a></p>
      </div>
      
  <!-- Сайтбар ЛЕВЫЙ - Способ оплаты -->
  
   
<?php  foreach ($informers as $key => $array){  ?>
           <div class="payment-method"> 
               <p><?php echo $array[0]?></p>
               
    <?php  foreach ($array['sub'] as $key => $arr){  ?> 
	          <ul>
                  <li>- <a href="?view=informer&informer_id=<?=$key?>"><?php echo $arr ?></a></li>
	 
<?php }?>
                </ul></div>
 <?php } ?>
    
       
  </div>