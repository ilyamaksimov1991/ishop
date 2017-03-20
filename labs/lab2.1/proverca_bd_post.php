<?php
/*
** Скрипт возварщает список категорий книг
*/

// Передаем заголовки
header('Content-type: text/plain; charset=utf-8');
header('Cache-Control: no-store, no-cache');
header('Expires: ' . date('r'));

// Открытие БД

if ($_POST['cat']){
	$cat= $_POST['cat'];
	//echo $cat;
	
// Вывод категорий
//$x = Categories($cat);
//print_r($x);

//function Categories($cat){
	$db = new SQLite3("books.db");
	
	$sql = "SELECT * FROM book WHERE category=$cat";
	$res = $db->query($sql);
$result= "";
	while ($row = $res->fetchArray(SQLITE3_ASSOC))
	{
		$result .= $row['title'].":";
	}
	echo $result;
//}
}