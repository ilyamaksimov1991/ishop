<?php defined('ISHOP') or die('Access denied');

/*----- Акардион - Мобильные телефоны --------*/
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
  /* Подсветка активной страницы*/
  function activ_str($url=""){
      $str= $_SERVER['QUERY_STRING'];
      if (!$str) {
         $str='view=page';
      }
      $res = explode("&",$str);
      if ($res[1]){
      $str = $res[0]."&".$res[1];
}
 if ($str == $url){
      echo "class='nav-activ'";
  }}
  /* Подсветка активной страницы*/

/* ===Страницы=== */
function pages(){
    $query = "SELECT page_id, title, position FROM pages ORDER BY position";
    $res = mysql_query($query)or die (" Запрс не прошел!");
    
    $pages = array();
    while($row = mysql_fetch_assoc($res)){
        $pages[] = $row;
    }
    return $pages;
}
/* ===Страницы=== */

/* ===Информация о Странице=== */
function page_information($page_id){
    $query = "SELECT * FROM `pages` WHERE page_id=$page_id";
    
    $res = mysql_query($query) or die (" Запрс не прошел!");
    
    $pages = array();
    while($row = mysql_fetch_assoc($res)){
        $pages[] = $row;
    }
    return $pages;
}
/* ===Информация о Странице=== */

/* ===фильтрация вхдящих данных из админ панели=== */
function security_admin($str){
    $str = mysql_real_escape_string(strip_tags($str));
    return $str;
}
/* ===фильтрация вхдящих данных из админ панели=== */


/* ===Изменение страниц меню === */
function change_page($page_id){
    
   $title = trim($_POST["title"]); 
   $keywords = trim( $_POST["keywords"]);
   $description = trim($_POST["description"]);
   $position = (int)$_POST["position"]; 
   $text = trim($_POST["text"]); 
   
   
   
  if (empty($title)){// если пустое название страницы
    $_SESSION['change_page']['res']= "<div class='Text-reg-error'> Не указано имя страницы!</div>";
    return ($_SESSION['change_page']['res']);
   }else{
   $title = mysql_real_escape_string($title);
   $keywords = mysql_real_escape_string( $keywords);
   $description = mysql_real_escape_string($description);
   $position = (int)($position); 
   $text = mysql_real_escape_string($text);
   
   $query ="UPDATE pages SET 
                title ='$title',
                keywords='$keywords',
                description ='$description',
                position ='$position',
                text= '$text'
                   WHERE page_id= $page_id ";
    $res = mysql_query($query)or die (" zaproc");
    
    if (mysql_affected_rows()>0){
    $_SESSION['sacsess']="<div class='Text-reg-sucsess'> Страница обнавлена!</div>";
   return ($_SESSION['sacsess']);
    }else{
    $_SESSION['change_page']['res']= "<div class='Text-reg-error'> Ошибка, или ничего не изменено!</div>";
       return ($_SESSION['change_page']['res']);
    }
                
                   
   }
   
}
/* ===Изменение страниц меню=== */
/* ===Добавление страниц меню=== */
function add_page(){
   $title = trim($_POST["title"]); 
   $keywords = trim( $_POST["keywords"]);
   $description = trim($_POST["description"]);
   $position = (int)$_POST["position"]; 
   $text = trim($_POST["text"]); 
   
   
   $_SESSION['add_page']['keywords'] = $keywords;
   $_SESSION['add_page']['description'] = $description;
   $_SESSION['add_page']['position'] = $position;
   $_SESSION['add_page']['text'] = $text;
   
   if (empty($title)){// если пустое название страницы
    $_SESSION['add_page']['res']= "<div class='Text-reg-error'> Не указано имя страницы!</div>";
    return ($_SESSION['add_page']['res']);
   }else{
   $title = security_admin($title); 
   $keywords = security_admin( $keywords);
   $description = security_admin($description);
   $position = (int)($position); 
   $text = security_admin($text); 
   
   $query ="INSERT INTO pages SET 
                title ='$title',
                keywords='$keywords',
                description ='$description',
                position ='$position',
                text= '$text'";
    $res = mysql_query($query)or die (" zaproc");
    
    if (mysql_affected_rows()>0){
    $_SESSION['sacsess']="<div class='Text-reg-sucsess'> Страница добавлена!</div>";
    return ($_SESSION['sacsess']);
    }else{
    $_SESSION['add_page']['res']= "<div class='Text-reg-error'> Ошибка, или ничего не изменено!</div>";
       return ($_SESSION['add_page']['res']);
    }
}
}
/* ===Добавление страниц меню=== */

/* ===Удаление страниц меню=== */
function delit_page($page_id){
  $query =" DELETE FROM pages WHERE page_id = $page_id";
    $res = mysql_query($query)or die (" zaproc");
    
    if (mysql_affected_rows()>0){
        $_SESSION['sacsess']="<div class='Text-reg-sucsess'> Страница успешно удалена!</div>";
}else {
    $_SESSION['sacsess']="<div class='Text-reg-error'> Ошибка добавления страницы!</div>";
}
}
/* ===Удаление страниц меню=== */

/* ===Список новостей=== */
function news_show($start_position,$amount_products){
    $query = "SELECT * FROM `news` ORDER BY date DESC LIMIT $start_position,$amount_products";
    
    $res = mysql_query($query) or die (" Запрс не прошел!");
    
    $news = array();
    while($row = mysql_fetch_assoc($res)){
        $news[] = $row;
    }
    return $news;
}
/* ===Список новостей=== */
  # Постраничная навигация
   function pagination1($page, $amount_page){
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
   
   /* Всего колличество продуктов*/
   function count_news(){
    $query ="SELECT COUNT(news_id) FROM news";
    $res = mysql_query($query) or die (" Запрс не прошел!");
    //$news = array();
    $news = mysql_fetch_row($res); // если одна строка то не нужно присваивать массив
    
    return $news[0];
   }
     /* Всего колличество продуктов*/

        #+++++++Новости+++++#
     /* == Показ новости=== */
function news($news_id){
    $query = "SELECT * FROM `news` WHERE news_id =$news_id";
    
    $res = mysql_query($query) or die (" Запрс не прошел!");
    
    $news = array();
    while($row = mysql_fetch_assoc($res)){
        $news[] = $row;
    }
    return $news;
}
/* ===Показ новости=== */

 /* == изменение новости=== */
function edit_news($news_id){
   
    $title= $_POST['title'];
    $anons= $_POST['anons'];
    $text= $_POST['text'];
    $date= $_POST['date'];
    
    if (empty($title)){ 
    $_SESSION['edit_news']['res']= "<div class='Text-reg-error'> Не указано имя новости!</div>";
    return ($_SESSION['edit_news']['res']); 
    }else{
   $title = mysql_real_escape_string($title);
   $anons = mysql_real_escape_string($anons);
   $text = mysql_real_escape_string($text);
   $date = ($date); 
   
    $query = "UPDATE `news` SET 
                 title='$title', 
                 anons='$anons', 
                 text='$text', 
                 date='$date' 
                 WHERE news_id=$news_id";
    $res = mysql_query($query) or die (" Запрс не прошел-2!");
     
    if (mysql_affected_rows()>0){
    $_SESSION['sacsess']="<div class='Text-reg-sucsess'> Новость изменена!</div>";
    return ($_SESSION['sacsess']);
    }else{
    $_SESSION['edit_news']['res']= "<div class='Text-reg-error'> Ошибка, или ничего не изменено!</div>";
    return ($_SESSION['edit_news']['res']);
    }
   }
}
/* ===изменение новости=== */
/* ===добавление новости=== */
function add_news(){
    $title=trim($_POST['title']);
    $anons= trim($_POST['anons']);
    $text= trim($_POST['text']);
    $date= date("y-m-d");
   
   
   $_SESSION['add_news']['title'] = $title;
   $_SESSION['add_news']['anons'] = $anons;
   $_SESSION['add_news']['date'] = $date;
   $_SESSION['add_news']['text'] = $text;
   
   if (empty($title)){// если пустое название страницы
    $_SESSION['add_news']['res']= "<div class='Text-reg-error'> Не указано имя новости!</div>";
    return ($_SESSION['add_news']['res']);
   }else{
   $title = security_admin($title); 
   $anons = security_admin($anons);
   $date = $date; 
   $text = security_admin($text); 
   
   $query ="INSERT INTO news SET 
                title='$title', 
                 anons='$anons', 
                 text='$text', 
                 date='$date'";
                 
    $res = mysql_query($query)or die (" zaproc");
    
    if (mysql_affected_rows()>0){
    $_SESSION['sacsess']="<div class='Text-reg-sucsess'> Новость добавлена!</div>";
    return ($_SESSION['sacsess']);
    }else{
    $_SESSION['add_news']['res']= "<div class='Text-reg-error'> Ошибка, или ничего не изменено!</div>";
       return ($_SESSION['add_news']['res']);
    }
}
}
/* ===добавление новости=== */

/* ===удалить новости=== */
function delit_news($id){
    $query = "DELETE FROM news WHERE news_id=$id";
    $res = mysql_query($query)or die (" zaproc");
    
    if (mysql_affected_rows()>0){
    $_SESSION['sacsess']="<div class='Text-reg-sucsess'> Новость Удалена!</div>";
    return ($_SESSION['sacsess']);
    }else{
    $_SESSION['sacsess']= "<div class='Text-reg-error'> Ошибка, или ничего не изменено!</div>";
       return ($_SESSION['add_news']['res']);
    }
}
/* ===удалить новости=== */

  # ++++++ Информеры +++++ #

/* ===показ страниц информеров=== */
function show_ihformers(){// показ информеров
    $query = "SELECT * FROM `informers`i 
                LEFT OUTER JOIN `links`l 
                   ON l.parent_informer=i. informer_id ORDER BY informer_position";
    $res = mysql_query($query)or die (" zaproc");

    $ihformers = array();
    while($row = mysql_fetch_assoc($res)){
        $ihformers[$row['informer_id']][0] = $row['informer_name'];
        $ihformers[$row['informer_id']]['position']=$row['informer_position'];
        $ihformers[$row['informer_id']]['id']=$row['informer_id'];
        if ($row['link_name']){
        $ihformers[$row['informer_id']]['sub'][$row['link_id']] = $row['link_name'];
        //$ihformers[$row['informer_id']]['sub']['position']=$row['link_position'];
       // $ihformers[$row['informer_id']]['sub']['id']=$row['link_id'];

    }}
    return $ihformers;

}
/* ===показ страниц информеров=== */

/* ===Добавление страниц информеров=== */
function add_page_informers(){
    $title = trim($_POST["link_name"]);
    $keywords = trim($_POST["keywords"]);
    $description = trim($_POST["description"]);
    $position = (int)$_POST["links_position"];
    $text = trim($_POST["text"]);
    $inform = (int)($_POST["select"]);


    $_SESSION['add_page_informer']['keywords'] = $keywords;
    $_SESSION['add_page_informer']['description'] = $description;
    $_SESSION['add_page_informer']['links_position'] = $position;
    $_SESSION['add_page_informer']['text'] = $text;
    $_SESSION['add_page_informer']['informer_id'] = $inform;

    if (empty($title)){// если пустое название страницы
        $_SESSION['add_page_informer']['res']= "<div class='Text-reg-error'> Не указано имя страницы информера!</div>";
        return ($_SESSION['add_page_informer']['res']);
    }else{
        $title = security_admin($title);
        $keywords = security_admin( $keywords);
        $description = security_admin($description);
        $position = (int)($position);
        $text = security_admin($text);
        $inform = (int)($inform);


        $query ="INSERT INTO links SET 
                link_name ='$title',
                keywords='$keywords',
                description ='$description',
                links_position ='$position',
                parent_informer = $inform,
                text= '$text'";

        $res = mysql_query($query)or die (" zaproc");

        if (mysql_affected_rows()>0){
            $_SESSION['sacsess']="<div class='Text-reg-sucsess'> Страница в информер добавлена!</div>";
            return ($_SESSION['sacsess']);
        }else{
            $_SESSION['add_page_informer']['res']= "<div class='Text-reg-error'> Ошибка, или ничего не изменено!</div>";
            return ($_SESSION['add_page_informer']['res']);
        }
    }
}
/* ===Добавление страниц информеров=== */

/* == вывод страницы информера=== */
function show_link_page ($link_id){

        $query = "SELECT * FROM `links` WHERE link_id =$link_id";

        $res = mysql_query($query) or die (" Запрс не прошел!");

        $link = array();
        while($row = mysql_fetch_assoc($res)){
            $link[] = $row;
        }
        return ($link);
}
/* == вывод страницы информера=== */

/* == изменение страницы информера=== */
function edit_links($link_id){

    $title = trim($_POST["link_name"]);
    $keywords = trim($_POST["keywords"]);
    $description = trim($_POST["description"]);
    $position = (int)$_POST["links_position"];
    $text = trim($_POST["text"]);
    $inform = (int)($_POST["select"]);

    if (empty($title)){// если пустое название страницы
        $_SESSION['edit_page_informer']['res']= "<div class='Text-reg-error'> Не указано имя страницы информера!</div>";
        return ($_SESSION['edit_page_informer']['res']);
    }else{
        $title = mysql_real_escape_string($title);
        $keywords = mysql_real_escape_string( $keywords);
        $description = mysql_real_escape_string($description);
        $position = (int)($position);
        $text = mysql_real_escape_string($text);
        $inform = (int)($inform);

        $query = "UPDATE `links` SET 
                 link_name ='$title',
                keywords='$keywords',
                description ='$description',
                links_position ='$position',
                parent_informer = $inform,
                text= '$text'
                WHERE link_id=$link_id";

        $res = mysql_query($query) or die (" Запрс не прошел-2!");

        if (mysql_affected_rows()>0){
            $_SESSION['sacsess']="<div class='Text-reg-sucsess'> Страница информера изменена!</div>";
            return ($_SESSION['sacsess']);
        }else{
            $_SESSION['edit_page_informer']['res']= "<div class='Text-reg-error'> Ошибка, или ничего не изменено!</div>";
            return ($_SESSION['edit_page_informer']['res']);
        }
    }
}
/* ===изменение страницы информера=== */

/* ===удалить страницу информера=== */
function delit_links($id){
    $query = "DELETE FROM links WHERE link_id=$id";
    $res = mysql_query($query)or die (" zaproc");

    if (mysql_affected_rows()>0){
        $_SESSION['sacsess']="<div class='Text-reg-sucsess'> Новость Удалена!</div>";
        return ($_SESSION['sacsess']);
    }else{
        $_SESSION['sacsess']= "<div class='Text-reg-error'> Ошибка, или ничего не изменено!</div>";
        return ($_SESSION['add_page_informer']['res']);
    }
}
/* ===страницу информера=== */

/* ===показ информера=== */
function show_edit_informers($id){
    $query = "SELECT * FROM `informers` links WHERE informer_id=$id";
    $res = mysql_query($query)or die (" zaproc");

    $ihformers = array();
    while($row = mysql_fetch_assoc($res)){
        $ihformers[] = $row;
    }
    return $ihformers;
}
/* ===показ информера=== */

/* ===редактировние информера=== */
function edit_informers($id){
    $informer_name = security_admin($_POST['informer_name']);
    $informer_position =(int)$_POST['informer_position'];


    if(empty($_POST['informer_name'])){
        $_SESSION['edit_informer']['res']= "<div class='Text-reg-error'> Не указано имя информера!</div>";
        return ($_SESSION['edit_informer']['res']);
    }else{

    $query = "UPDATE `informers` SET
                informer_name = '$informer_name',
                informer_position = '$informer_position'
                WHERE informer_id=$id";

    $res = mysql_query($query)or die (" zaproc");
        if (mysql_affected_rows()>0){
            $_SESSION['sacsess']="<div class='Text-reg-sucsess'> Название информера изменено!</div>";
            return ($_SESSION['sacsess']);
        }else{
            $_SESSION['edit_informer']['res']= "<div class='Text-reg-error'> Ошибка, или ничего не изменено!</div>";
            return ($_SESSION['edit_page_informer']['res']);
        }
}}
/* ===редактировние  информера=== */

/* ===удаление  информера=== */
function delite_informer($id){
    mysql_query("DELETE FROM `links` WHERE parent_informer='$id'");

    $query = "DELETE FROM `informers` WHERE informer_id='$id'";
    $res = mysql_query($query)or die (" zaproc");

    if (mysql_affected_rows()>0){
        $_SESSION['sacsess']="<div class='Text-reg-sucsess'> Информер удален!</div>";
        return ($_SESSION['sacsess']);
    }else{
        $_SESSION['sacsess']= "<div class='Text-reg-error'> Ошибка, или ничего не изменено!</div>";
        return ($_SESSION['sacsess']);
    }
}
/* ===удаление  информера=== */

/* ===добавление информера=== */
function add_informer(){
    $informer_name = $_POST['informer_name'];
    $informer_position =(int)$_POST['informer_position'];

    if(empty($informer_name)){
        $_SESSION['edit_informer']['res']= "<div class='Text-reg-error'> Не указано имя информера!</div>";
        $_SESSION['edit_informer']['informer_name']= $informer_name;
        $_SESSION['edit_informer']['informer_position']= $informer_position;
        return ($_SESSION['edit_informer']['res']);
    }else{
        $informer_name = security_admin($informer_name);
        $informer_position =(int)$informer_position;

        $query = "INSERT INTO `informers` SET
                informer_name = '$informer_name',
                informer_position = '$informer_position'";

        $res = mysql_query($query)or die (" zaproc");

        if (mysql_affected_rows()>0){
            $_SESSION['sacsess']="<div class='Text-reg-sucsess'> Информер Добавлен!</div>";
            return ($_SESSION['sacsess']);
        }else{
            $_SESSION['sacsess']= "<div class='Text-reg-error'> Ошибка, или ничего не изменено!</div>";
            return ($_SESSION['sacsess']);
        }
    }}
/* ===добавление информера=== */

/* ===добавление информера=== */
function add_category(){
    $brand_name = $_POST['brand_name'];
    $select = $_POST['select'];

    if(empty($brand_name)){
        $_SESSION['add_category']['res']= "<div class='Text-reg-error'> Не указано имя информера!</div>";
        $_SESSION['add_category']['select']= $select;

        return ($_SESSION['add_informer']['res']);
    }else{
        $brand_name = security_admin($brand_name);
        $select = (int)$select;

        $query = "SELECT * FROM `brands` WHERE parent_id= $select AND brand_name = '$brand_name'";
        $res = mysql_query($query)or die (" zaproc");
        if (mysql_affected_rows()>0){
            $_SESSION['add_category']['res']= "<div class='Text-reg-error'> Такая категория уже существует!</div>";
            return ($_SESSION['add_category']['res']);
        }else{

        $query = "INSERT INTO `brands` SET
                   brand_name = '$brand_name',
                   parent_id = '$select'";

        $res = mysql_query($query)or die (" zaproc");

        if (mysql_affected_rows()>0){
            $_SESSION['sacsess']="<div class='Text-reg-sucsess'> Информер Добавлен!</div>";
            return ($_SESSION['sacsess']);
        }else{
            $_SESSION['sacsess']= "<div class='Text-reg-error'> Ошибка, или ничего не изменено!</div>";
            return ($_SESSION['sacsess']);
        }
    }}}
/* ===добавление информера=== */

/* ===редактировние категории=== */
function edit_category($id){
    $brand_name = security_admin($_POST['brand_name']);
    $select =(int)$_POST['select'];


    if(empty($brand_name)){
        $_SESSION['edit_cat']['res']= "<div class='Text-reg-error'> Не указано имя категории!</div>";
        return ($_SESSION['edit_cat']['res']);
    }else{
        if(empty($select)) {
            mysql_query("SELECT * FROM `brands` WHERE parent_id=0 AND brand_name='$brand_name'");
            if (mysql_affected_rows() > 0) {
                $_SESSION['edit_cat']['res'] = "<div class='Text-reg-error'> Такая категории уже существует!</div>";
                //return ($_SESSION['edit_cat']['res']);
            }else {
                $query = "UPDATE `brands` SET  brand_name='$brand_name',parent_id = 0 WHERE brand_id=$id";
                $res = mysql_query($query) or die (" zaproc");
                if (mysql_affected_rows() > 0) {
                    $_SESSION['sacsess'] = "<div class='Text-reg-sucsess'> Название категории изменено!</div>";
                    return ($_SESSION['sacsess']);
                }
            }
        }else{
            mysql_query("SELECT * FROM `brands` WHERE parent_id = $select AND brand_name='$brand_name'");
            if (mysql_affected_rows() > 0) {
                $_SESSION['edit_cat']['res'] = "<div class='Text-reg-error'> Такая категория уже существует!</div>";
                //return ($_SESSION['edit_cat']['res']);
            }else {

            $query = "UPDATE `brands` SET  brand_name='$brand_name', parent_id = $select WHERE brand_id=$id";
            $res = mysql_query($query) or die (" zaproc");
            if (mysql_affected_rows() > 0) {
                $_SESSION['sacsess'] = "<div class='Text-reg-sucsess'> Название категории изменено!</div>";
                return ($_SESSION['sacsess']);
            }}
        }

    }}

/* ===редактировние категории=== */
/* ===удаление  категории=== */
function delite_category($id,$pod_category_isset){

if (isset($pod_category_isset)){
    $_SESSION['sacsess'] = "<div class='Text-reg-error'> Категорию удалить нельзя! У нее есть подкатегории!</div>";
}else{
    mysql_query("DELETE FROM `goods` WHERE goods_brandid='$id'");

    $query = "DELETE FROM `brands` WHERE brand_id='$id'";
    $res = mysql_query($query)or die (" zaproc");

    if (mysql_affected_rows()>0){
        $_SESSION['sacsess']="<div class='Text-reg-sucsess'> Информер удален!</div>";
        return ($_SESSION['sacsess']);
    }else{
        $_SESSION['sacsess']= "<div class='Text-reg-error'> Ошибка, или ничего не изменено!</div>";
        return ($_SESSION['sacsess']);
    }}
}
/* ===удаление  категории=== */

###########
/* === Показ хлебных крошек === */

function bread_crumbs($id){
    $query = "SELECT brand_id, brand_name FROM `brands` 
                WHERE brand_id=(SELECT parent_id   FROM `brands` 
                  WHERE brand_id=$id)
              UNION
               SELECT brand_id, brand_name 
                 FROM `brands` WHERE brand_id=$id";
    $res= mysql_query($query) or die ('Запрос не прошел1');
    $informer=array();
    while($row = mysql_fetch_assoc($res)){
        $informer[] = $row;
    }
    return ($informer);
}

/* === Показ хлебных крошек === */
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


    $res= mysql_query($query) or die ('Запрос не прошел2');


    while ($row = mysql_fetch_array($res)) {
        if ($row['COUNT(goods_id)']){
            $count_products=$row['COUNT(goods_id)'];
        }
    }

    return ($count_products);
}
/*----- Подсчет колличества товаров в категории-------*/
/*----- Вывод страниц с категориями мобильнх телефонов--------*/
function show_phohe($category,$start_position,$amount_products){
    $query = "SELECT * FROM `goods` 
                  WHERE goods_brandid='$category' 
                      
              UNION
              SELECT * FROM `goods` 
                  WHERE goods_brandid 
                    IN (SELECT brand_id FROM brands WHERE parent_id='$category') 
                     LIMIT $start_position,$amount_products ";


    $res= mysql_query($query) or die ('Запрос не прошел3');

    $cat= array();
    while ($row=mysql_fetch_array($res)) {
        $cat[]=$row;
    }

    return ($cat);
}

/*----- Вывод страниц с категориями мобильнх телефонов- конец--------*/
/* ===Ресайз картинок=== */
function resize($target, $dest, $wmax, $hmax, $ext){
    /*
    $target - путь к оригинальному файлу
    $dest - путь сохранения обработанного файла
    $wmax - максимальная ширина
    $hmax - максимальная высота
    $ext - расширение файла
    */
    list($w_orig, $h_orig) = getimagesize($target);
    $ratio = $w_orig / $h_orig; // =1 - квадрат, <1 - альбомная, >1 - книжная

    if(($wmax / $hmax) > $ratio){
        $wmax = $hmax * $ratio;
    }else{
        $hmax = $wmax / $ratio;
    }

    $img = "";
    // imagecreatefromjpeg | imagecreatefromgif | imagecreatefrompng
    switch($ext){
        case("gif"):
            $img = imagecreatefromgif($target);
            break;
        case("png"):
            $img = imagecreatefrompng($target);
            break;
        default:
            $img = imagecreatefromjpeg($target);
    }
    $newImg = imagecreatetruecolor($wmax, $hmax); // создаем оболочку для новой картинки

    if($ext == "png"){
        imagesavealpha($newImg, true); // сохранение альфа канала
        $transPng = imagecolorallocatealpha($newImg,0,0,0,127); // добавляем прозрачность
        imagefill($newImg, 0, 0, $transPng); // заливка
    }

    imagecopyresampled($newImg, $img, 0, 0, 0, 0, $wmax, $hmax, $w_orig, $h_orig); // копируем и ресайзим изображение
    switch($ext){
        case("gif"):
            imagegif($newImg, $dest);
            break;
        case("png"):
            imagepng($newImg, $dest);
            break;
        default:
            imagejpeg($newImg, $dest);
    }
    imagedestroy($newImg);
}
/* ===Ресайз картинок=== */

/* добавление продукта*/
function  add_product($category){
    $name = trim($_POST['name']);
    $price = trim($_POST['price']) ;
    $keywords = trim($_POST['keywords']);
    $description = trim($_POST['description']);
    $anons = trim($_POST['anons']);
    $content = trim($_POST['content']);
    $new =(int)$_POST['new'];
    $hits = (int)$_POST['hits'];
    $sale = (int)$_POST['sale'];
    $visible = $_POST['visible'];

     if (empty($name) OR empty($price)){
         $_SESSION['add_product']['res'] = "<div class='Text-reg-error'> Не указано имя продукта или цена!</div>";
         $_SESSION['add_product']['price'] = $price;
         $_SESSION['add_product']['keywords'] = $keywords;
         $_SESSION['add_product']['description'] = $description;
         $_SESSION['add_product']['anons'] = $anons;
         $_SESSION['add_product']['content'] = $content;
         $_SESSION['add_product']['new'] = $new;
         $_SESSION['add_product']['hits'] = $hits;
         $_SESSION['add_product']['sale'] = $sale;
         $_SESSION['add_product']['visible'] = $visible;
     } else {

         $name = security_admin($name);
         $price = security_admin($price);
         $keywords = security_admin($keywords);
         $description = security_admin($description);
         $anons = trim($anons);
         $content = ($content);
         $date = date('y-m-d');

         $query = "INSERT INTO `goods` SET 
                 name = '$name',
                 keywords = '$keywords',
                 description = '$description',
                 goods_brandid = $category,
                 anons = '$anons',
                 content = '$content',
                 visible = '$visible',
                 hits = '$hits',
                 new = '$new',
                 sale = '$sale',
                 price = '$price',
                 date = '$date',
                img_slide = 0 ";

         $res = mysql_query($query)or die (mysql_error());

         if (mysql_affected_rows()>0){
             $id = mysql_insert_id(); // ID сохраненного товара
             $types = array("image/gif", "image/png", "image/jpeg", "image/pjpeg", "image/x-png"); // массив допустимых расширений
             /* базовая картинка */
             if($_FILES['baseimg']['name']){
                 $baseimgExt = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['baseimg']['name'])); // расширение картинки
                 $baseimgName = "{$id}.{$baseimgExt}"; // новое имя картинки
                 $baseimgTmpName = $_FILES['baseimg']['tmp_name']; // временное имя файла
                 $baseimgSize = $_FILES['baseimg']['size']; // вес файла
                 $baseimgType = $_FILES['baseimg']['type']; // тип файла
                 $baseimgError = $_FILES['baseimg']['error']; // 0 - OK, иначе - ошибка
                 $error = "";

                 if(!in_array($baseimgType, $types)) $error .= "Допустимые расширения - .gif, .jpg, .png <br />";
                 if($baseimgSize > SIZE) $error .= "Максимальный вес файла - 1 Мб";
                 if($baseimgError) $error .= "Ошибка при загрузке файла. Возможно, файл слишком большой";

                 if(!empty($error)) $_SESSION['sacsess'] = "<div class='Text-reg-error'>Ошибка при загрузке картинки товара! <br /> {$error}</div>";

                 // если нет ошибок
                 if(empty($error)){
                     if(@move_uploaded_file($baseimgTmpName, "../userfiles/product_img/tmp/$baseimgName")){
                         resize("../userfiles/product_img/tmp/$baseimgName", "../userfiles/product_img/baseimg/$baseimgName", 120, 185, $baseimgExt);
                         @unlink("../userfiles/product_img/tmp/$baseimgName");
                         mysql_query("UPDATE goods SET img = '$baseimgName' WHERE goods_id = $id");
                     }else{
                         $_SESSION['sacsess'] .= "<div class='Text-reg-success'>Не удалось переместить загруженную картинку. Проверьте права на папки в каталоге /userfiles/product_img/</div>";
                     }
                 }
             }
             /* базовая картинка */
             /////////////////////////
             /* картинки галереи */
             if($_FILES['galleryimg']['name'][0]){
                 for($i = 0; $i < count($_FILES['galleryimg']['name']); $i++){
                     $error = "";
                     if($_FILES['galleryimg']['name'][$i]){
                         // если есть файл
                         $galleryimgExt = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['galleryimg']['name'][$i])); // расширение картинки
                         $galleryimgName = "{$id}_{$i}.{$galleryimgExt}"; // новое имя картинки
                         $galleryimgTmpName = $_FILES['galleryimg']['tmp_name'][$i]; // временное имя файла
                         $galleryimgSize = $_FILES['galleryimg']['size'][$i]; // вес файла
                         $galleryimgType = $_FILES['galleryimg']['type'][$i]; // тип файла
                         $galleryimgError = $_FILES['galleryimg']['error'][$i]; // 0 - OK, иначе - ошибка

                         if(!in_array($galleryimgType, $types)){
                             $error .= "Допустимые расширения - .gif, .jpg, .png <br />";
                             $_SESSION['sacsess'] .= "<div class='Text-reg-error'>Ошибка при загрузке картинки {$_FILES['galleryimg']['name'][$i]} <br /> {$error}</div>";
                             continue;
                         }

                         if($galleryimgSize > SIZE){
                             $error .= "Максимальный вес файла - 1 Мб";
                             $_SESSION['sacsess'] .= "<div class='Text-reg-error'>Ошибка при загрузке картинки {$_FILES['galleryimg']['name'][$i]} <br /> {$error}</div>";
                             continue;
                         }

                         if($galleryimgError){
                             $error .= "Ошибка при загрузке файла. Возможно, файл слишком большой";
                             $_SESSION['sacsess'] .= "<div class='Text-reg-error'>Ошибка при загрузке картинки {$_FILES['galleryimg']['name'][$i]} <br /> {$error}</div>";
                             continue;
                         }

                         // если нет ошибок
                         if(empty($error)){
                             if(@move_uploaded_file($galleryimgTmpName, "../userfiles/product_img/photos/$galleryimgName")){
                                 resize("../userfiles/product_img/photos/$galleryimgName", "../userfiles/product_img/thumbs/$galleryimgName", 45, 45, $galleryimgExt);
                                 if(!isset($galleryfiles)){
                                     $galleryfiles = $galleryimgName;
                                 }else{
                                     $galleryfiles .= "|{$galleryimgName}";
                                 }
                             }else{
                                 $_SESSION['sacsess'] .= "<div class='Text-reg-error'>Не удалось переместить загруженную картинку. Проверьте права на папки в каталоге /userfiles/product_img/</div>";
                             }
                         }
                     }
                 }
                 if(isset($galleryfiles)){
                     mysql_query("UPDATE goods SET img_slide = '$galleryfiles' WHERE goods_id = $id");
                 }
             }
             /* картинки галереи */
             $_SESSION['sacsess'] .= "<div class='Text-reg-success'>Товар добавлен</div>";
             return true;
         }else{
             $_SESSION['add_product']['res'] = "<div class='Text-reg-error'>Ошибка при добавлении товара</div>";
             return false;
         }
     }
}
/* ===Добавление товара=== */

/* Вытащить данные по продукту */
function show_product_id($id){
    $query = "SELECT * FROM goods WHERE goods_id =$id";
    $res = mysql_query($query) or die (mysql_error());

    $product= array ();
    while ($row = mysql_fetch_assoc($res)){
        $product[]=$row;
    }
    return ($product);
}
/* Вытащить данные по продукту */

/* ===AjaxUpload - загрузка картинок галереи=== */
function upload_gallery_img($id){
    $uploaddir = '../userfiles/product_img/photos/';
    $file = $_FILES['userfile']['name'];
    $ext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $file)); // расширение картинки
    $types = array("image/gif", "image/png", "image/jpeg", "image/pjpeg", "image/x-png"); // массив допустимых расширений

    if($_FILES['userfile']['size'] > SIZE){
        $res = array("answer" => "Ошибка! Максимальный вес файла - 1 Мб!");
        exit(json_encode($res));
    }

    if($_FILES['userfile']['error']){
        $res = array("answer" => "Ошибка! Возможно, файл слишком большой.");
        exit(json_encode($res));
    }

    if(!in_array($_FILES['userfile']['type'], $types)){
        $res = array("answer" => "Допустимые расширения - .gif, .jpg, .png");
        exit(json_encode($res));
    }

    $query = "SELECT img_slide FROM goods WHERE goods_id = $id";
    $res = mysql_query($query);
    $row = mysql_fetch_assoc($res);
    if($row['img_slide']){
        // если есть картинки в галерее
        $images = explode("|", $row['img_slide']);
        $lastimg = end($images);
        // получаем номер последней картинки
        $lastnum = preg_replace("#\d+_(\d+)\.\w+#", "$1", $lastimg); // 1_1.ext
        $lastnum += 1;
        $newimg = "{$id}_{$lastnum}.{$ext}"; // имя новой картинки
        $images = "{$row['img_slide']}|{$newimg}"; // строка для записи в БД
    }else{
        $newimg = "{$id}_0.{$ext}"; // имя новой картинки
        $images = $newimg; // строка для записи в БД
    }

    $uploadfile = $uploaddir.$newimg;
    if(@move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)){
        resize($uploadfile, "../userfiles/product_img/thumbs/$newimg", 45, 45, $ext);
        mysql_query("UPDATE goods SET img_slide = '$images' WHERE goods_id = $id");
        $res = array("answer" => "OK", "file" => $newimg);
        exit(json_encode($res));
    }
}
/* ===AjaxUpload - загрузка картинок галереи=== */
/*Удаление картинок*/
function del_img(){
        $goods_id = (int)$_POST['goods_id'];
        $img = $_POST['img'];
        $rel = (int)$_POST['rel'];

        if(!$rel){
            // если удаляется базовая картинка
            $query = "UPDATE goods SET img = 'no_image.jpg' WHERE goods_id = $goods_id";
            mysql_query($query);
            if(mysql_affected_rows() > 0){
                return '<input type="file" name="baseimg" />';
            }else{
                return false;
            }
        }else{ // картинка галереи
        // если удаляется картинка галереи
        $query = "SELECT img_slide FROM goods WHERE goods_id = $goods_id";
        $res = mysql_query($query);
        $row = mysql_fetch_assoc($res);
        // получаем картинки в массив
        $images = explode("|", $row['img_slide']);
        foreach($images as $item){
            // пропускаем удаляемую картинку
            if($item == $img) continue;
            // формируем строку с картинками
            if(!isset($galleryfiles)){
                $galleryfiles = $item;
            }else{
                $galleryfiles .= "|$item";
            }
        }
        mysql_query("UPDATE goods SET img_slide = '$galleryfiles' WHERE goods_id = $goods_id");
        if(mysql_affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
}
/*Удаление картинок*/
/*добавление товара*/
function edit_product ($goods_id){
    $name = mysql_real_escape_string($_POST['name']);
    $price = mysql_real_escape_string($_POST['price']);
    $keywords = mysql_real_escape_string($_POST['keywords']);
    $description = mysql_real_escape_string($_POST['description']);
    $anons =mysql_real_escape_string($_POST['anons']);
    $content = mysql_real_escape_string($_POST['content']);
    $new = (int)$_POST['new'];
    $hits = (int)$_POST['hits'];
    $sale = (int)$_POST['sale'];
    $visible = $_POST['visible'];

    if (empty($name) OR empty($price)) {
        $_SESSION['edit_product']['res'] = "<div class='Text-reg-error'> Не указано имя продукта или цена!</div>";
    } else {

        $date = date('y-m-d');

        $query = "UPDATE `goods` SET 
                 name = '$name',
                 keywords = '$keywords',
                 description = '$description',
                 anons = '$anons',
                 content = '$content',
                 visible = '$visible',
                 hits = '$hits',
                 new = '$new',
                 sale = '$sale',
                 price = '$price',
                 date = '$date' 
                 WHERE goods_id = $goods_id";
        $res = mysql_query($query) or die (mysql_error());


        /* базовая картинка */
        $types = array("image/gif", "image/png", "image/jpeg", "image/pjpeg", "image/x-png"); // массив допустимых расширений
        if($_FILES['baseimg']['name']){
            $baseimgExt = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['baseimg']['name'])); // расширение картинки
            $baseimgName = "{$goods_id}.{$baseimgExt}"; // новое имя картинки
            $baseimgTmpName = $_FILES['baseimg']['tmp_name']; // временное имя файла
            $baseimgSize = $_FILES['baseimg']['size']; // вес файла
            $baseimgType = $_FILES['baseimg']['type']; // тип файла
            $baseimgError = $_FILES['baseimg']['error']; // 0 - OK, иначе - ошибка

            $error = "";
            if(!in_array($baseimgType, $types)) $error .= "Допустимые расширения - .gif, .jpg, .png <br />";
            if($baseimgSize > SIZE) $error .= "Максимальный вес файла - 1 Мб";
            if($baseimgError) $error .= "Ошибка при загрузке файла. Возможно, файл слишком большой";

            if(!empty($error)) $_SESSION['sacsess'] .= "<div class='Text-reg-error'>Ошибка при загрузке картинки товара! <br /> {$error}</div>";

            // если нет ошибок
            if(empty($error)){
                if(@move_uploaded_file($baseimgTmpName, "../userfiles/product_img/tmp/$baseimgName")){
                    resize("../userfiles/product_img/tmp/$baseimgName", "../userfiles/product_img/baseimg/$baseimgName", 120, 185, $baseimgExt);
                    @unlink("../userfiles/product_img/tmp/$baseimgName");
                    mysql_query("UPDATE goods SET img = '$baseimgName' WHERE goods_id = $goods_id");
                }else{
                    $_SESSION['sacsess'] .= "<div class='Text-reg-error'>Не удалось переместить загруженную картинку. Проверьте права на папки в каталоге /userfiles/product_img/</div>";
                }
            }
        }
        /* базовая картинка */
        $_SESSION['sacsess'] .="<div class='Text-reg-sucsess'>Товар обновлен</div>";
        return$_SESSION['sacsess'];

    }
}
/*добавление товара*/
/*колличество заказов*/
function countzakaz(){
    $query = "SELECT COUNT(order_id) as count FROM `orders` WHERE status='0'";
    $res = mysql_query($query) or die (mysql_error());


    while ($row = mysql_fetch_row($res)){
        $_SESSION['auth']['count_zakaz']=$row[0];
    }

    echo "<a style='color: #960b06' href='?view=new_zakaz'>ВСЕГО не обработанных </br> заказов (".($_SESSION['auth']['count_zakaz']).")</a>";
}
/*колличество заказов*/
/*колличество заказов*/
function count_summa(){
    $query = "SELECT COUNT(order_id) as count FROM `orders` WHERE status='0'";
    $res = mysql_query($query) or die (mysql_error());


    while ($row = mysql_fetch_row($res)){
        $_SESSION['auth']['count_summa']=$row[0];
    }

    return $_SESSION['auth']['count_summa'];
}
/*колличество заказов*/
/*вывести заказы*/
function new_zakaz($status){
    $query = "SELECT o.order_id, c.customer_id, c.name, o.date, o.status   
               FROM `orders` o LEFT JOIN `customers`c  
                ON o.customer_id=c.customer_id ".$status;
    //exit($query);
    $res = mysql_query($query) or die (mysql_error());

    $product= array ();
    while ($row = mysql_fetch_assoc($res)){
        $product[]=$row;
    }
    return ($product);
}

/*вывести заказы*/

/*вывести заказы*/
function show_zakaz($id){
    $query = "SELECT
                 customers.name as customer, customers.email, customers.phone, customers.address, 
                 zakaz_tovar.name_phone, zakaz_tovar.quantity, zakaz_tovar.price, zakaz_tovar_id,
                 orders.date, orders.prim, orders.status, 
                 dostavka.name
                 FROM customers
                 LEFT JOIN zakaz_tovar ON customers.customer_id =zakaz_tovar.orders_id
                 LEFT JOIN orders ON  zakaz_tovar.namber_zakaz=orders.order_id 
                 LEFT JOIN dostavka ON dostavka.dostavka_id = orders.dostavka_id 
                 WHERE  orders.order_id=$id";
    $res = mysql_query($query) or die (mysql_error());

    $product= array ();
    while ($row = mysql_fetch_assoc($res)){
        $product[]=$row;
    }
    return ($product);
}
/*вывести заказы*/
/*подтвердить заказ*/
function confirm_zakaz($id){
    $query= "UPDATE orders SET status='1' WHERE order_id=$id";
    //exit($query);
    $res=mysql_query($query) or die (mysql_error());
    if (mysql_affected_rows()>0){
        $_SESSION['sacsess'] ="<div class='Text-reg-sucsess'>Заказ №$id перенесен в список подтвержденых </div>";
        return true;
    }else{
        $_SESSION['sacsess'] = "<div class='Text-reg-error'>Заказ №$id не удалось подтвердить, возможно он уже в списке подтвержденных!</div>";
        return false;
    }
}
/*подтвердить заказ*/
/* вывод постраничной навигации для заказов*/
function navig_confirm_zakaz($start, $end){
    $query= "SELECT o.order_id, c.customer_id, c.name, o.date, o.status   
               FROM `orders` o LEFT JOIN `customers`c  
                ON o.customer_id=c.customer_id ORDER BY status, order_id DESC LIMIT $start, $end ";
    //exit($query);
    $res=mysql_query($query) or die (mysql_error());

    $cat= array();
    while ($row=mysql_fetch_array($res)) {
        $cat[]=$row;
    }

    return ($cat);
}
/* вывод постраничной навигации для заказов*/

