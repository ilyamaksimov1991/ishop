<?php 
// Передаем заголовки
header('Content-type: text/plain; charset=utf-8');
header('Cache-Control: no-store, no-cache');
header('Expires: ' . date('r'));


gbdtn;
// Читаем GET параметр
if (!empty($_GET['cat'])){
	$cat = abs((int) $_GET['cat']);
	//$cat = 3;
	// Открытие БД
	function NewBaza($cat){
	$db = new SQLite3("books.db");
	
	// Создание и выполнение запроса
	$sql = "SELECT * FROM book WHERE category=$cat";
	$result = $db->query($sql);

	// Вывод результата запроса
	$f='';
	//$f = array();
	while ($row = $result->fetchArray(SQLITE3_ASSOC))
		 //$f[]= $row;
	 $f .= $row['author'];
	return $f;
	}	
	$z=NewBaza($cat);
	print_r($z);

	// Закрытие БД
	unset($db);


// Рекурсивная функция возвращает строку кодов подкатегории разделенных запятой
function getChildCategoryList(){
	//$result = '';
	$db = new SQLite3("books.db");
	$sql = 'SELECT * FROM category';
	$res = $db->query($sql);
	$result=array();
	while ($row = $res->fetchArray(SQLITE3_ASSOC))
		$result[] =  $row;
	return $result;
}

$x=getChildCategoryList();
//print_r($x);
}
?>