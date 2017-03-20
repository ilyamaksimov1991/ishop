<?php
# запрет просмотра этой страницы 
defined("ISHOP") or die ("Молчание-золото!"); // Если константы не существие тогда покажи сообщение и заверши

session_start(); //старт сессии

# подключение модели
include MODEL;

# подключение библиотеки функций 
require_once "function/function.php";

// получение массива каталога
$cat = mob_phohe();

// получение массива новостей
$news = news();

// получение массива информеров
$informers = informer_id();

// Если нажата кнопка - авторизоваться/войти
if ($_POST['auth']){
    authorization();
    redirect();
}
// Меню
$menu=menu();

// Если нажата ссылка - выйти
if ($_GET['do'] == 'logout'){
    checking_out_the();
    header("Location:".PATH);
    exit; 
}

if ($_POST['reg']){
    receive_data();
    redirect(); 
}

# Если пустая страница и не пустая
if (empty($_GET['view'])){
    $view = 'hits';
   } else {
    $view= $_GET['view'];
}


switch ($view){
     case 'page':
     // меню
     $page_id_menu =abs((int)$_GET['page_id']);
     if ($page_id_menu){
     $page_menu = menu_page($page_id_menu);
     }
     break;
      // страница hits
     case 'hits':
     $show_phone = catalog_informers('hits');
     break;
     
     // страница sale
     case 'sale':
     $show_phone = catalog_informers('sale');
     break;
     
     // страница new
     case 'new':
     $show_phone = catalog_informers('new');
     break;
     
      // страница cate
     case 'cat':
     $category= abs((int)$_GET['category']);
     
     $bread_crumbs = bread_crumbs($category);
     
     # Показывать колличетсво товаров на странице
     $amount_products = AMOUNT_PRODUCTS;
     
     # Номер страницы
     if ($_GET['page']){
        $page=$_GET['page']; // если существует-$_GET['page'], тогда то что указанно в $_GET['page'];
        if ($_GET['page']< 1){ // если $_GET['page'] меньше 1 тогда присвоить= 1
           $page = 1; 
        }
        }else{ // если $_GET['page'] не сущетвут тогда тоже присвоить= 1
          $page=1;  
        }
        /*+++Сортировка+++*/
        // Массив с параметрами сортировки
        // Ключи то что передается GET параметром
        // значения 0-показываю посетителю 1- в SQL запрос
        
            $sort_category=array(
                                   'namea'=> array('названию: A-Я','name ASC'),
                                   'nameb'=>array('названию: Я-А','name DESC'),
                                   'datea'=>array('дате: недавно добавленные','date ASC'),
                                   'dateb'=>array('дате: давно на сайте','date DESC'),
                                   'pricea'=>array('цене: по возрастанию','price ASC'),
                                   'priceb'=>array('цене: по убыванию','price DESC'),
                                  );
                                  
            if($_GET['sort']){
            $sort= security($_GET['sort']);
            }   
        # если влюч в $_GET совпадает с массивом                     
        if (array_key_exists($sort,$sort_category)){
            $sort_a =$sort_category[$sort][0];
            $sort_b =$sort_category[$sort][1]; 
        }else{
            $sort_a =$sort_category['namea'][0];
            $sort_b =$sort_category['namea'][1];
        }
        
        
     # Всего колличество продуктов  
     $count_products= count_products($category);
    
     # всего колличество страниц округленные в большую сторону
     $amount_page = ceil($count_products/$amount_products);
     
     // ecли нет КОЛЛИЧЕСТВА СТРАНИЦ=Всего продуктов/ колличество товаров на страница то все равно=1  
     if (!$amount_page)$amount_page=1;
     
     // если страница больше чем коолличестов страниц приравнять страницу к колличествам страниц
     if($page>$amount_page)$page=$amount_page;
     
     # С какого продукта показать
     $start_position= ($page-1)*$amount_products; //(№страницы - 1)*колличество показа на странице;
     
     $show = show_phohe($category,$start_position,$amount_products, $sort_b);
     
     
     
     $line=abs((int)$_GET['vid']);
     break;
     
     case 'addtocart':
     $id = abs((int)$_GET['goods_id']); // id товара по нажатию на "добавить в корзину"
     $res= addtocar($id); //  id заказа и Подсчет колличества
     
     recalculation();// пересчет общей суммы + общее колличество
     redirect();
     break;
     
     case 'reg':
     
     break;
     
     case 'informer':
     $informer_id = abs((int)$_GET['informer_id']);
     $informer_show = informer_show ($informer_id);
     break;
     
     case 'news':
     $news_id =abs((int) $_GET['id']);
     $show_news = news_show_id($news_id); 
     break;
     
     case 'arhive':
     
      # Показывать колличетсво товаров на странице
     $amount_products = 2;
      # Номер страницы
     if ($_GET['page']){
        $page=$_GET['page']; // если существует-$_GET['page'], тогда то что указанно в $_GET['page'];
        if ($_GET['page']< 1){ // если $_GET['page'] меньше 1 тогда присвоить= 1
           $page = 1; 
        }
        }else{ // если $_GET['page'] не сущетвут тогда тоже присвоить= 1
          $page=1;  
        }
     
    # Всего колличество продуктов  
     $count_products= arhive_count_news();
    
     # всего колличество страниц округленные в большую сторону
     $amount_page = ceil($count_products/$amount_products);
     
     // ecли нет КОЛЛИЧЕСТВА СТРАНИЦ=Всего продуктов/ колличество товаров на страница то все равно=1  
     if (!$amount_page)$amount_page=1;
     
     // если страница больше чем коолличестов страниц приравнять страницу к колличествам страниц
     if($page>$amount_page)$page=$amount_page;
     
     # С какого продукта показать
     $start_position= ($page-1)*$amount_products; //(№страницы - 1)*колличество показа на странице;
     
     $arhive_news = show_news($start_position,$amount_products);
     
     
     break;
     
     case 'search':
     $result = search_phone();

     # Показывать колличетсво товаров на странице
     $amount_products = 3;
     
     # Номер страницы
     if ($_GET['page']){
        $page=(int)$_GET['page']; // если существует-$_GET['page'], тогда то что указанно в $_GET['page'];
        if ($_GET['page']< 1){ // если $_GET['page'] меньше 1 тогда присвоить= 1
           $page = 1; 
        }
        }else{ // если $_GET['page'] не сущетвут тогда тоже присвоить= 1
          $page=1;  
        }
     # Всего колличество продуктов  
     $count_products= count($result);
    
     # всего колличество страниц округленные в большую сторону
     $amount_page = ceil($count_products/$amount_products);
     
     // ecли нет КОЛЛИЧЕСТВА СТРАНИЦ=Всего продуктов/ колличество товаров на страница то все равно=1  
     if (!$amount_page)$amount_page=1;
     
     // если страница больше чем коолличестов страниц приравнять страницу к колличествам страниц
     if($page>$amount_page)$page=$amount_page;
     
     # С какого продукта показать
     $start_position= ($page-1)*$amount_products; //(№страницы - 1)*колличество показа на странице;
     
     $end_position=$start_position + $amount_products;//до какого элемента выводим
     if ($end_position > $count_products) $end_position=$count_products;
    
     
     break;
     case 'filter':
     // выбор по параметрам
    
     $ot = (int)$_GET['ot'];
     $do = (int)$_GET['do'];
         $line = (int)$_GET['vid'];
     
     $brand_phone= array();
     if($_GET['brand']){
     foreach ($_GET['brand'] as $value){
       $value = (int)$value;
        $brand_phone[$value]= $value;    
    }}
    
    if($brand_phone) $brand= implode(',',$brand_phone);// вывести данные в стороку для подстановки в IN (запрос)) 


         $category= abs((int)$_GET['category']);
         $sort_category = array(
             'namea'=> array('названию: A-Я','name ASC'),
             'nameb'=>array('названию: Я-А','name DESC'),
             'pricea'=>array('цене: по возрастанию','price ASC'),
             'priceb'=>array('цене: по убыванию','price DESC')
         );

         if($_GET['sort']){
             $sort= security($_GET['sort']);
         }
         # если влюч в $_GET совпадает с массивом
         if (array_key_exists($sort,$sort_category)){
             $sort_a =$sort_category[$sort][0];
             $sort_b =$sort_category[$sort][1];
         }else{
             $sort_a =$sort_category['priceb'][0];
             $sort_b =$sort_category['priceb'][1];
         }
         if($_GET['cat']){
             $cate=$_GET['cat'];
             $brand=$cate;
         }
         //$show = show_phohe($category,$start_position,$amount_products, $sort_b);
         $result_searh = search_by_category($brand, $ot, $do, $sort_b);
     break;

     case 'product':
     $good_id = abs((int)$_GET['goods_id']);
     if($good_id){
        $description = detailed_description($good_id);
        if ($description)$bread_crumbs = bread_crumbs($description[0]['goods_brandid']); // Хлебные крошки
       }
     if ($description[0]['img_slide']){
            $desc= explode("|",$description[0]['img_slide']);
     }
     break;

     case 'cart':

     if ($_POST['zakaz_x']){
          # Если не авторизован
          if (!isset($_SESSION['auth']['user'])){
          receive_data_cart();
          }else{
            receive_data_cart_avtoriz();
          }
     }

     $delivery = delivery_methods(); //доставка товара

     if(isset ($_GET['good_id']) AND isset($_GET['value'])){
     $id_cart= abs((int)$_GET['good_id']);
     $val= abs((int)$_GET['value']);

     addtocar2($id_cart,$val);

     recalculation(); //пересчет общей суммы + общее колличество
     header("Location:".PATH."?view=cart"); //редирект
     exit; // выход
     }

     if (abs((int)$_GET['delete_id'])){
        deletion($_GET['delete_id']);
     header("Location:".PATH."?view=cart"); //редирект
     exit; // выход

     }

     break;
     // если сам что то введет то все равно -страница hits
     default:
     $view= 'hits';
}


# подключение вида
include TEMPLATE."index.php";

?>