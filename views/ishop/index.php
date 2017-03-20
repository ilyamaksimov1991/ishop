<?php
# подключение ШАПКи
include "inc/heder.php";

?> 
 <div class="wraper">
<?php
# подключение левого сайт бара
include "inc/leftbar.php";
?>
<!-- блок КОНТЕНТ -->
<div class="content">
  <!-- Начало --> 
<?php
	//echo print_array($_SESSION);
    //echo print_array($_POST);
    
?>
 <?php include $view.'.php'; ?>

  
  <!-- КОНЕЦ -->
  </div>
<!-- блок КОНТЕНТ  -->  
<!-- НАЧАЛО  НЕ ТРОГАТЬ -->
  </div>
<!-- НЕ ТРОГАТЬ КОНЕЦ -->
  
<?php
# подключение правого сайт бара
include "inc/ridthbar.php";
    
# подключение ФУТЕРа
include "inc/footer.php";
?>
        
      </div>
         </div>
 
 </body>
</html>