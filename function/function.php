<?php
defined("ISHOP") or die ('Молчание-золото!'); // Если константы не существие тогда покажи сообщение и заверши

    # Распечатка массива
	function print_array($arr) {
	   echo "<pre>";
       print_r ($arr);
       echo "</pre>";
	}
    
    # Подсчет id заказа и колличества
    function addtocar($id){
        if ($_SESSION['cart'][$id]){
        $_SESSION['cart'][$id]['amount'] += 1;
        } else{
        $_SESSION['cart'][$id]['amount'] = 1;
    }
    return ($_SESSION['cart']);
    }
    
    
    # пересчет корзины
    function addtocar2($id,$val){
        if ($_SESSION['cart'][$id]){
        $_SESSION['cart'][$id]['amount'] = $val;
        
        
     }
    
    }
    
    # Редирект
    function redirect(){
        
        $res = $_SERVER['HTTP_REFERER'];
        if (isset ($res)){
        header("Location: $res");
        exit;
        } else{
            
          header("Location:".PATH);
          exit;  
        }
    }
   
   
   # Постраничная навигация
   function pagination($page, $amount_page){
    if ($_SERVER['QUERY_STRING']){ // это то что выводится в строке браузере
        
        # отобрать для дальнейшей подстановки необходимые параметры
        foreach ($_GET as $key => $array){ 
            if($key != 'page') $url .= "$key={$array}&amp;"; // кроме номера страницы
        } 
        }
        
    
    // формипрвание ссылок
    
    $bask = ''; // ссылка НАЗАД
    $forvard = ''; // ссылка ВПЕРЕД
    $start_page = ''; // ссылка в НАЧАЛО
    $end_page = ''; // ссылка в КОНЕЦ
    $page_1_left = ''; // первая страница влево
    $page_2_left = ''; // вторая страница влево
    $page_1_right = ''; // первая страница вправо
    $page_2_right = ''; // вторая страница вправо
    
    #ссылка НАЗАД
    if ($page > 1) $bask = "<a href='?{$url}page=".($page-1)."'>&lt;</a>";
   
    #ссылка ВПЕРЕД
    if ($page < $amount_page) $forvard ="<a href='?{$url}page=".($page+1)."'>&gt;</a>";
    
    #ссылка в НАЧАЛО
    if ($page > 3 ) $start_page ="<a href='?{$url}page=1'>&laquo;</a>";
    
    #ссылка в КОНЕЦ
    if ($page < ($amount_page-2)) $end_page ="<a href='?{$url}page={$amount_page}'>&raquo;</a>";
    
    #первая страница влево
    if ($page-1 > 0) $page_1_left ="<a href='?{$url}page=".($page-1)."'>".($page-1)."</a>";
    
    #вторая страница влево
    if ($page-2 > 0) $page_2_left ="<a href='?{$url}page=".($page-2)."'>".($page-2)."</a>";
    
    # первая страница вправо
    if ($page+1 <= $amount_page ) $page_1_right ="<a href='?{$url}page=".($page+1)."'>".($page+1)."</a>";
    
    # вторая страница вправо
    if ($page+2 <= $amount_page ) $page_2_right ="<a href='?{$url}page=".($page+2)."'>".($page+2)."</a>";
   
   
   #+++++++Вывод навигации+++++#
   echo "<div class='Pagination'><p>".$start_page.$bask.$page_2_left.$page_1_left.$page.$page_1_right.$page_2_right.$forvard.$end_page."</p></div>";
   }
   
?>