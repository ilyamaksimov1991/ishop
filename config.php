<?php 
# запрет просмотра этой страницы 
defined("ISHOP") or die ("Молчание-золото!"); // Если константы не существие тогда покажи сообщение и заверши


define ('PATH', 'http://cm92106.tmweb.ru/');  //адрес домена

# MVC
define ('CONTROLLER', 'controller/controller.php'); // адрес сонтролера
define ('MODEL', 'model/model.php'); // адрес модели
define ('VIEW', 'views/'); // адрес вида
define ('TEMPLATE', VIEW.'ishop/');   // активный шаблон    views/ishop/    images/photos/

//define ('GALERY', VIEW.'ishop/')    userfiles/product_img/

define('PRODUCTIMG', PATH.'userfiles/product_img/');// папка с картинками контента     http://mysite.local/ userfiles/product_img/  images/thumbnails/
define('SIZE', 1048576);// максимально допустимый вес загружаемых картинок - 1 Мб

# BD
define ('SERVER_BD', 'localhost'); // имя сервера
define ('USER_BD', 'cm92106_ishop');  // пользователь
define ('PASVORD', '123123123'); // пароль от бд
define ('NAME_BD', 'cm92106_ishop'); // имя базы данных

define ('TITLE', 'Интернет магазин сотовых телефонов'); // название интернет магазна

mysql_connect(SERVER_BD, USER_BD, PASVORD) or die ( 'Нет соединения с сервером'); //соединение с сервером
mysql_select_db(NAME_BD) or die ('База данных не выбрана'); // подключение к БД

mysql_query("SET NAMES 'UTF8'") or die (' Кодировка не та'); // кодировка

define ("ADMIN_EMAIL","maksimov.ilya1@gmail.com"); // Емейл админа сайта
define ('TEMPLATE_ADMIN', 'templates'); // папка административной панели
define ("AMOUNT_PRODUCTS",6); // Колличество выводимых товаров

?>