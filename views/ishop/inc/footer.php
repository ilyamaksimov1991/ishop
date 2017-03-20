<?php
	defined("ISHOP") or die ('Молчание-золото'); 
?> 
   <!-- ФУТЕР НАЧАЛО-->   
      
      <div class="footer">
                <!-- футер-1-->
      <div class="footer-1">
      <div class="internet-magazin">
      <span>Интернет магазин </span><br /> <h2>Сотовых телефонов</h2> <br /> Сopyright © 2012
      </div>
      </div>
                <!-- футер-2-->
      <div class="footer-2"> 
      <div class="menu-footer"> 
      <span>Меню:</span>
     
             <ul class="ul-1">
               <li><a href="?view=hits">Главная </a></li>
               <?php for($i=0; $i<2; $i++){ ?>
                       <li><a href="?view=page&page_id=<?php echo $menu[$i]['page_id']?>"><?php echo $menu[$i]['title']?></a></li>
               <?php }?>         
               </ul>
               
               
               <ul class="ul-2">
               <?php for($i=2; $i<count($menu); $i++){ ?>
                       <li><a href="?view=page&page_id=<?php echo $menu[$i]['page_id']?>"><?php echo $menu[$i]['title']?></a></li>
               <?php }?> 
            </ul>
      </div>
      </div>
                 <!-- футер-3-->
      <div class="footer-3"> 
      <div class="head-contact-footer">
                      <p><b>Телефон:</b><br/><span>8 (800) 700-00-01</span></p><br/>
                      <p><b>Режим работы:</b><br/>
                      <h5>Будние дни: с 9:00 до 18:00 <br/> 
                      Суббота, Воскресенье - выходные</h5>  </p>
         </div>
         </div>
      <!-- ФУТЕР КОНЕЦ-->  