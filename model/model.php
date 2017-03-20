<?php

defined("ISHOP") or die ('Молчание-золото!'); // Если константы не существие тогда покажи сообщение и заверши

    /*----- Мобильные телефоны --------*/
	function mob_phohe() {
    $query = "SELECT * FROM brands";
    $res = mysql_query($query) or die ('Запрос не прошел');
    
    $category = array();
    while ($row = mysql_fetch_array($res)){
        
        if (!$row['parent_id']) {
        $category[$row['brand_id']][]=$row['brand_name'];
        
        } else {
             $category[$row['parent_id']]['sub'][$row['brand_id']]=$row['brand_name'];
        }     
    }
    
       return ($category);  
}
  /*----- Мобильные телефоны - конец--------*/
  
/*----- Информеры--------*/
	function informer_id() {
    $query = "SELECT * FROM `links` INNER JOIN informers 
                  ON links.parent_informer = informers.informer_id 
                      ORDER BY informer_position, links_position"; // последняя строчка не обязательная
                      
    $res = mysql_query($query) or die ('Запрос не прошел');
    
    $informers = array();
    $name='';
    while ($row = mysql_fetch_array($res)){
        
        # если название "информер" не равно с переменной $name
        if ($row['informer_name'] != $name) {
        
        # в первый массив с названием- "порядковый-номер информера"  кладу его название
        $informers[$row['informer_position']][]=$row['informer_name']; 
        $name = $row['informer_name']; // присваиваю значение $name название информера
        } 
        
        # во второй массив с названием- "порядковый-номер информера"  
        # создаю массив ['sub'] 
        # порядковому номеру места отображения присваиваю ее имя
        $informers[$row['informer_position']]['sub'][$row['link_id']]=$row['link_name'];
             
    }
    
       return ($informers);  
}
/*----- Информеры- конец--------*/

/*----- Страницы ХИТ- ЛИДЕР Продаж -РАСПРОДАЖА--------*/

	function catalog_informers($get_informers) {
    # Выбрать те пункты которые visible='1'- показывать на странице + определенной категории  'hits', 'sali', 'new' 
    $query = "SELECT goods_id, name, img, price, hits, sale, new  FROM goods WHERE visible='1' AND $get_informers='1'"; 
                      
    $res = mysql_query($query) or die ('Запрос не прошел');
    
    $show = array();
    while ($row = mysql_fetch_array($res)){
        $show[]=$row; 
        } 
        
          return ($show);    
    }


/*----- ХИТ- ЛИДЕР Продаж -РАСПРОДАЖА- конец--------*/

/*----- Вывод страниц с категориями мобильнх телефонов--------*/
function show_phohe($category,$start_position,$amount_products, $sort_b){
    $query = "SELECT * FROM `goods` 
                  WHERE goods_brandid='$category' 
                      AND visible='1'
              UNION
              SELECT * FROM `goods` 
                  WHERE goods_brandid 
                    IN (SELECT brand_id FROM brands WHERE parent_id='$category') 
                      AND visible='1' ORDER BY $sort_b LIMIT $start_position,$amount_products ";
                      
                      
    $res= mysql_query($query) or die ('Запрос не прошел');
    
    $cat= array();
    while ($row=mysql_fetch_array($res)) {
        $cat[]=$row;
    }  
    
    return ($cat);       
}

/*----- Вывод страниц с категориями мобильнх телефонов- конец--------*/

/*----- Вывод информации по телефонам выбранным в корзину + Обшая СУММА--------*/
    function information_phone ($goods){
    $total_summ = 0; // сумма общая вначале 0
    if (count($_SESSION['cart'])== 0){
        
            unset($_SESSION['cart']);
            unset($_SESSION['total_summ']);
            unset($_SESSION['summa_phone']);
            
            header("Location:".PATH."?view=cart"); //редирект
            exit; // выход
            
            
         }else{
    $key = implode(',', array_keys($goods)); 
    $query = "SELECT goods_id, price, name, img
                   FROM goods 
                       WHERE goods_id IN ($key)"; 
                      
    $res = mysql_query($query) or die ('Запрос не прошел');
    
    
    while ($row = mysql_fetch_array($res)){
        $_SESSION['cart'][$row['goods_id']]['price']=$row['price'];
        $_SESSION['cart'][$row['goods_id']]['name']=$row['name'];
        $_SESSION['cart'][$row['goods_id']]['img']=$row['img'];
       
        
        # Сумма прибавляется в цикле Цена товара* колличество товара
        $total_summ += $_SESSION['cart'][$row['goods_id']]['price']* $_SESSION['cart'][$row['goods_id']]['amount'];
         
        } }
        
          return ($total_summ); // вернуть значение суммы заказа   
    }    
    
/*----- Вывод информации по телефонам выбранным в корзину- конец--------*/

/*----- функция обработки принимаемых данных от пользователя- конец--------*/
function security($var){
    $var = mysql_real_escape_string(strip_tags(trim($var)));
    return $var;
}
/*----- функция обработки принимаемых данных от пользователя- конец--------*/

/*----- Получение и обработка данных из формы регистрации--------*/
    
    function receive_data(){
        $login= security($_POST['login']);
        $pasvord= trim($_POST['pasvord']);
        $fio= security($_POST['fio']);
        $email= security($_POST['email']);
        $tlf= security($_POST['telefon']);
        $adres= security($_POST['adres']);
        
        $error='';
        
        if(empty($login)) $error .= "<p>* Не заполнено поле- Логин</p>";
        if(empty($pasvord)) $error .= "<p>* Не заполнено поле- Пароль</p>";
        if(empty($fio)) $error .= "<p>* Не заполнено поле- ФИО</p>";
        if(empty($email)) $error .= "<p>* Не заполнено поле- Е-маил</p>";
        if(empty($tlf)) $error .= "<p>* Не заполнено поле- Телефон</p>";
        if(empty($adres)) $error .= "<p>* Не заполнено поле- Адрес доставки</p>";
        
        if (empty($error)){
            // если все поля заполнены
            $query = "SELECT name FROM customers WHERE login ='$login'";
            $res = mysql_query($query) or die ('Запрос не прошел');
            
            
            if (mysql_fetch_row($res)){
             # !!!Если нашел совпадение логиновов!!!
             $_SESSION['reg']['res']="<div class='Text-reg-error'>Пользователь с таким логином уже существует:<br /><br /> 
                                                                                              *Введите новый логин.</div>"; 
              
            }else {
             # ---Если  совпадений логинов нет ---  
            $pas= md5($pasvord); // хеширование пароля]
            $query = "INSERT INTO customers 
                         SET name='$fio', email='$email', address='$adres', phone='$tlf', login='$login', password='$pas'";
            $res = mysql_query($query) or die ('Запрос не прошел');
            
            # ---Если  изменена хоть одна строка в БД --- 
            if (mysql_affected_rows()>0){
              $_SESSION['reg']['res']="<div class='Text-reg-sucsess'>Регистрация прошла успешно!</div>"; 
              $_SESSION['auth']['user']= $fio;
                $id =mysql_insert_id();
                $_SESSION['auth']['id']=$id;
            } else{
                $_SESSION['reg']['res']=" Ошибка, попробуйте еще раз!";
            }
            }
            
             
        }else{
            // если какие то поля не заполнены
            $_SESSION['reg']['res']= "<div class='Text-reg-error'>Не заполнены обязательные поля: <br /><br/> $error</div>";
            $_SESSION['reg']['login']= $login;
            $_SESSION['reg']['pasvord']= $pasvord;
            $_SESSION['reg']['fio']= $fio;
            $_SESSION['reg']['email']= $email;
            $_SESSION['reg']['telefon']= $tlf;
            $_SESSION['reg']['adres']= $adres;
        }
        
    }

/*----- Получение и обработка данных из формы регистрации--------*/

/*----- Проверка при входе-авторизация --------*/
function authorization(){
    $login = mysql_real_escape_string($_POST['login']);
    $pasword =trim($_POST['pasword']);
    
    if(empty ($login) OR empty ($pasword)){ // Если не введено в полк логин/пароль
    $_SESSION['reg']['result']= "<div class='Text-reg-error-reg'>Не заполннены обязательные поля: логин/пароль</div>";
    
    }elseif ($login AND $pasword){

    $pas=md5($pasword);
    $query = "SELECT name,customer_id,email FROM customers WHERE login='$login' AND password='$pas'";
    
    $res = mysql_query($query) or die ('Запрос не прошел');
    
            if (mysql_num_rows($res)==1){
            $row = mysql_fetch_row($res);
            $_SESSION['auth']['user']=$row[0];  
            $_SESSION['auth']['id']=$row[1]; 
            $_SESSION['auth']['email']=$row[2]; 
             
           
           }else {
           $_SESSION['reg']['result']= "<div class='Text-reg-error-reg'>Пользователя с такими данными не существует!</div>";
           }
} 
}

/*-----Проверка при входе- авторизаия--------*/

/*-----Разрегитрирование переменной при нажатии кнопки -выйти--------*/
 function checking_out_the(){
  unset ($_SESSION['auth']['user']); 
   unset ($_SESSION['auth']['email']); 
    unset ($_SESSION['auth']['id']);
 }

/*-----Разрегитрирование переменной при нажатии кнопки -выйти--------*/

/*-----пересчет товаров--------*/
function recalculation(){
     # вывод общей суммы, название товара, цены
     $_SESSION['total_summ'] = information_phone ($_SESSION['cart']);
     
     $_SESSION['summa_phone']=0;
     foreach ($_SESSION['cart'] as $k => $array){ 
// если хитрый пользователь захочет ввести несуществующий id телефона с помощью этого цикла если у номера id нет цены- удалю его        
        if(isset($array['price'])){
           # подсчет колличетва телефонов
           $_SESSION['summa_phone'] += $array['amount'];
            } else{  
                # Удалить категорию с таким ключом
                unset ($_SESSION['cart']['key']);
            }
     }
}
/*-----пересчет товаров--------*/
/*----- Удаление из корзины --------*/
function deletion($id){    
unset ($_SESSION['cart'][$id]);
recalculation();
}
/*----- Удаление из корзины--------*/

/*----- способы доставки --------*/
function delivery_methods(){
    $query = "SELECT * FROM `dostavka`";                   
                      
    $res= mysql_query($query) or die ('Запрос не прошел');
    
    $cat= array();
    while ($row=mysql_fetch_array($res)) {
        $cat[]=$row;
    }  
    
    return ($cat);       
}
/*----- способы доставки--------*/

/*----- Проверка введенных данных--------*/
  function receive_data_cart(){
        
        $fio= security($_POST['fio']);
        $email= security($_POST['email']);
        $tlf= security($_POST['telefon']);
        $adres= security($_POST['adres']);
        $prim= security($_POST['prim']);
        
        $error='';
        
       
        if(empty($fio)) $error .= "<p>* Не заполнено поле- ФИО</p>";
        if(empty($email)) $error .= "<p>* Не заполнено поле- Е-маил</p>";
        if(empty($tlf)) $error .= "<p>* Не заполнено поле- Телефон</p>";
        if(empty($adres)) $error .= "<p>* Не заполнено поле- Адрес доставки</p>";
       ///-------------------------------------------------ЕСЛИ НЕТ ОШИБОК в заполнении -----------------/// 
        if (empty($error)){
            
            # способ доставки
            $dostavka_id=abs((int)$_POST['name_radio']);
            if(!$_POST['name_radio']){
                $dostavka_id=0;
            } 
            
            # Добавление неавторизованного пользователя
            $query = "INSERT INTO customers 
                         SET name='$fio', email='$email', address='$adres', phone='$tlf'";
            $res = mysql_query($query) or die ('Запрос не прошел');
            # Вывод id последного запроса
            $id = mysql_insert_id();
            # ---Если  изменена хоть одна строка в БД --- 
            if (mysql_affected_rows()>0){
                
              # +++++++отправка данных способ доставки + примечание ++++++++
            $query = "INSERT INTO orders
                         SET customer_id='$id', date=NOW(), dostavka_id='$dostavka_id', prim='$prim'";
            $res = mysql_query($query) or die ('Запрос не прошел');
            //exit($query);
            # ----------отправка данных способ доставки + примечание --------
                $id1 = mysql_insert_id();

             # +++++++добавление товаров в заказ ++++++++
            foreach ($_SESSION['cart'] as $key => $array){
            $var .="({$id},{$key},{$array['amount']},'{$array['name']}',{$array['price']},{$id1}),";
            }

            $var=substr($var,0,-1);
            $query = "INSERT INTO zakaz_tovar (orders_id, goods_id, quantity, name_phone, price, namber_zakaz)
                         VALUES $var";
            //exit($query);
            $res = mysql_query($query) or die ('Запрос не прошел');
            $id_zakaz = mysql_insert_id();
               
            # ----------добавление товаров в заказ --------
            
            $_SESSION['reg']['res']="<div class='sucsess_inform'>Спасибо за заказ! Менеджер свяжется с вами в ближайшее время.</div>"; 
            
            email_order($email,$id_zakaz);// отправка емейла с уведомлением
            
            unset($_SESSION['cart']);
            unset($_SESSION['total_summ']);
            unset($_SESSION['summa_phone']); 
              
            header("Location:".PATH."?view=cart"); //редирект
            exit; // выход
            } else{
                $_SESSION['reg']['res']=" Ошибка, попробуйте еще раз!";
            }
    
           ///------------------------------------------------- ЕСЛИ НЕТ ОШИБОК в заполнении -----------------///   
             
        }else{
            // если какие то поля не заполнены
            $_SESSION['reg']['res']= "<div class='Text-reg-error'>Не заполнены обязательные поля: <br /><br/> $error</div>";
            
            $_SESSION['reg']['fio']= $fio;
            $_SESSION['reg']['email']= $email;
            $_SESSION['reg']['telefon']= $tlf;
            $_SESSION['reg']['adres']= $adres;
           
        }
        
    }
/*----- Проверка введенных данных--------*/

/*----- Заказ авторизованного пользователя--------*/
  function receive_data_cart_avtoriz(){

            $prim= security($_POST['prim']);
       
            # способ доставки
            $dostavka_id=abs((int)$_POST['name_radio']);
            if(!$_POST['name_radio']){
                $dostavka_id=0;
            }
            $id=$_SESSION['auth']['id'];
                                    
                
              # +++++++отправка данных способ доставки + примечание ++++++++
            $query = "INSERT INTO orders
                         SET customer_id='$id', date=NOW(), dostavka_id='$dostavka_id', prim='$prim'";
            $res = mysql_query($query) or die ('Запрос не прошел-1');   
            # ----------отправка данных способ доставки + примечание --------
            $id1 = mysql_insert_id();
             # +++++++добавление товаров в заказ ++++++++
            if ($_SESSION['cart']){
                foreach ($_SESSION['cart'] as $key => $array){
                    $var .="({$id},{$key},{$array['amount']},'{$array['name']}',{$array['price']},{$id1}),";
                }

                $var=substr($var,0,-1);
                $query = "INSERT INTO zakaz_tovar (orders_id, goods_id, quantity, name_phone, price, namber_zakaz)
                         VALUES $var";
                //exit($query);
            $res = mysql_query($query) or die ('Запрос не прошел-2');
            $id_zakaz = mysql_insert_id();
               
            # ----------добавление товаров в заказ --------
            
            $_SESSION['reg']['res']="<div class='sucsess_inform'>Спасибо за заказ! Менеджер свяжется с вами в ближайшее время.</div>"; 
            
            email_order($_SESSION['auth']['email'],$id_zakaz); // отправка емейла с уведомлением
            
            unset($_SESSION['cart']);
            unset($_SESSION['total_summ']);
            unset($_SESSION['summa_phone']); 
              
            header("Location:".PATH."?view=cart"); //редирект
            exit; // выход
                  
    }}
/*----- Заказ авторизованного пользователя--------*/
/*----- отправка уведомления о сообщении на почту--------*/
function email_order($email,$id_zakaz){
// форма записи емейла (емейл, тема письма, письмо[, кодировка, тип])

# Тема письма
$subject = "Заказ в интернет магазине";
 
# Заголовки 
$headers .="Content-type: text/plain; charset=utf-8\r\n";
$headers .=" From: ISHOP";

# Тело письма
$body= "Благодарим Вас за заказ!\r\nНомер вашего заказа-$id_zakaz.
\r\n\r\nЗаказанные товары:\r\n\r\n";
foreach ($_SESSION['cart'] as $array){
$body.= "Наименование: {$array['name']}, Цена: {$array['price']}, Колличество: {$array['amount']}\r\n";
}
$body.= "\r\nИТОГО: {$_SESSION['summa_phone']} на сумму: {$_SESSION['total_summ']}";
   
mail($email, $subject, $body, $headers);
mail(ADMIN_EMAIL, $subject, $body, $headers);    
}
/*----- отправка уведомления о сообщении на почту--------*/
/*----- Подсчет колличества товаров в категории-------*/
function count_products($category){
    $query = "SELECT COUNT(goods_id) FROM `goods` 
                  WHERE goods_brandid=$category 
                      AND visible='1'
              UNION
              SELECT COUNT(goods_id) FROM`goods` 
                  WHERE goods_brandid 
                    IN (SELECT brand_id FROM brands WHERE parent_id=$category) 
                      AND visible='1'";
                      
                      
    $res= mysql_query($query) or die ('Запрос не прошел');
    
    
    while ($row = mysql_fetch_array($res)) {
        if ($row['COUNT(goods_id)']){
          $count_products=$row['COUNT(goods_id)'];  
        }     
    }  
    
    return ($count_products);   
}
/*----- Подсчет колличества товаров в категории-------*/

/*----- Поиск по телефонам-------*/
function search_phone(){
    $search = $_GET['look'];
    
    // результат поиска явно указать вверху потому что функция должна массив давать на ввыходе, хотябы пустой     
    $result_phone= array(); 
    if (mb_strlen($search,'UTF-8') < 4 ){
       $_SESSION['search'] = "<div class='Text-reg-error-1'>Поисковый запрос должен содержать не менее4-х символов!</div>"; 
    }else{
    
     $query = "SELECT * FROM `goods` 
                  WHERE MATCH(name) AGAINST('$search*' IN BOOLEAN MODE)
                      AND visible='1'";
     $res= mysql_query($query) or die ('Запрос не прошел');
     
     if (mysql_affected_rows()>0){
     
     while ($row = mysql_fetch_array($res)) {
       $result_phone[]=$row;           
    }  
    } else{
     $_SESSION['search'] = "<div class='Text-reg-error-1'>По Вашему запросу ничего не найдено!</div>"; 
    }
}
return ($result_phone); 
}
/*----- Поиск по телефонам-------*/
/*----- Поиск по категориям-------*/
function search_by_category($category, $ot, $do, $sortb){
    $products = array();
    # если есть выбор по категориям и по цене
    if($category OR $do){
        $predicat1 = "visible='1'";
        # 1.если есть выбор по категориям
        if($category){
            $predicat1 .= " AND goods_brandid IN($category)";
            $predicat2 = "UNION
                        (SELECT goods_id, name, anons, img, price, hits, new, sale
                        FROM goods
                            WHERE goods_brandid IN
                            (
                                SELECT brand_id FROM brands WHERE parent_id IN($category)
                            ) AND visible='1'";
           
            # 1-2.если есть выбор по цене                
            if($do) $predicat2 .= " AND price BETWEEN $ot AND $do";
            
            $predicat2 .= ")";
        }
        # 2.если есть только цена
        if($do){
            $predicat1 .= " AND price BETWEEN $ot AND $do";
        }
        
        $query = "(SELECT goods_id, name, anons, img, price, hits, new, sale
                    FROM goods
                        WHERE $predicat1)
                         $predicat2 ORDER BY $sortb";
         // echo $query;
        //exit($query);
        $res = mysql_query($query) or die(mysql_error());
        if(mysql_num_rows($res) > 0){
            while($row = mysql_fetch_assoc($res)){
                $products[] = $row;
            }
        }else{
            $products['notfound'] = "<div class='Text-reg-error-1'>По указанным параметрам ничего не найдено!</div>";
        }       
    }else{
        $products['notfound'] = "<div class='Text-reg-error-1'>Вы не указали параметры подбора!</div>";
    }
    return($products);
}
/* ===Выбор по параметрам=== */

/* ===Детальное описание=== */
function detailed_description($good_id){
    
     $query = "SELECT * FROM goods
                WHERE goods_id ='$good_id' AND visible='1'";
      $res= mysql_query($query) or die ('Запрос не прошел');
      if (mysql_affected_rows()>0){
            $products=array();
            while($row = mysql_fetch_assoc($res)){
                $products[] = $row;
            }
    return ($products);
      }else{
          return false;
      }
}
/* ===Детальное описание=== */

/* === Вывод меню === */
function menu(){
    
     $query = "SELECT * FROM pages
                ORDER BY position";
      $res= mysql_query($query) or die ('Запрос не прошел');           
            $products=array();
            while($row = mysql_fetch_assoc($res)){
                $products[] = $row;
            }
            return ($products);
}
/* === Вывод меню === */

/* === вывод контента страниц-меню === */
function menu_page($page_id_menu){
    
     $query = "SELECT * FROM pages WHERE page_id = $page_id_menu
                ORDER BY position";
      $res= mysql_query($query) or die ('Запрос не прошел');           
            $products=array();
            while($row = mysql_fetch_assoc($res)){
                $products[] = $row;
            }
            return ($products);
}
/* === вывод контента страниц-меню === */

/* === вывод Новости-левый сайт-бар === */
function news(){
    
     $query = "SELECT * FROM `news` 
                   ORDER BY date DESC 
                         LIMIT 2";
                   
      $res= mysql_query($query) or die ('Запрос не прошел');           
            
            $news=array();
            while($row = mysql_fetch_assoc($res)){
                $news[] = $row;
            }
            return ($news);
   }         
/* === вывод Новости-левый сайт-бар === */
/* === Показать новость === */
function news_show_id($news_id){
   $query = "SELECT * FROM `news` 
                   WHERE news_id=$news_id";
                   
      $res= mysql_query($query) or die ('Запрос не прошел');           
            
            $news=array();
            while($row = mysql_fetch_assoc($res)){
                $news[] = $row;
            }
            return ($news);  
    
}

/* === Показать новость === */

/* === [Архив новостей] === */
function arhive_news(){
   $query = "SELECT * FROM `news` 
                  ORDER BY date DESC";
                   
      $res= mysql_query($query) or die ('Запрос не прошел');           
            
            $news=array();
            while($row = mysql_fetch_assoc($res)){
                $news[] = $row;
            }
            return ($news);  
    
}

/* === [Архив новостей] === */


/* === [УЗНАТЬ Колличество новостей] === */
function arhive_count_news(){
   $query = "SELECT COUNT(news_id) FROM `news`";
                   
      $res= mysql_query($query) or die ('Запрос не прошел');           
            
            $row = mysql_fetch_row($res);
            
                return $row[0];
         }   
/* === [УЗНАТЬ Колличество новостей] === */

/* === Показ определенного колличества новостей === */
function show_news($start_position,$amount_products){
    
   $query = "SELECT * FROM `news`
               ORDER BY news_id DESC LIMIT $start_position, $amount_products";
                   
      $res= mysql_query($query) or die ('Запрос не прошел');           
            
            $news=array();
            while($row = mysql_fetch_assoc($res)){
                $news[] = $row;
            }
            return ($news); 
}

/* === Показ определенного колличества новостей === */

/* === Показ информации информера === */
function informer_show ($informer_id){
    $query = "SELECT l.link_name,  l.text, l.link_id, i.informer_id, i.informer_name FROM `links` l 
                 LEFT OUTER JOIN`informers` i
                    ON  i.informer_id =l.parent_informer 
                       WHERE l.link_id= $informer_id";
   $res= mysql_query($query) or die ('Запрос не прошел'); 
    
       $informer=array();
            while($row = mysql_fetch_assoc($res)){
                $informer[] = $row;
            }
            return ($informer); 
}

/* === Показ хлебных крошек === */

function bread_crumbs($id){
    $query = "SELECT brand_id, brand_name FROM `brands` 
                WHERE brand_id=(SELECT parent_id   FROM `brands` 
                  WHERE brand_id=$id)
              UNION
               SELECT brand_id, brand_name 
                 FROM `brands` WHERE brand_id=$id"; 
    $res= mysql_query($query) or die ('Запрос не прошел'); 
       $informer=array();
            while($row = mysql_fetch_assoc($res)){
                $informer[] = $row;
            }
            return ($informer); 
}

/* === Показ хлебных крошек === */
?>