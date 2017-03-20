<?php
/*
** Скрипт возварщает список категорий книг
*/

// Передаем заголовки
header('Content-type: text/plain; charset=utf-8');
header('Cache-Control: no-store, no-cache');
header('Expires: ' . date('r'));

// Открытие БД


// Вывод категорий
$x = getChildCategories();
print_r($x);

function getChildCategories()
{$db = new SQLite3("books.db");
	
	$sql = 'SELECT * FROM category';
	$res = $db->query($sql);
$result = '';
	while ($row = $res->fetchArray(SQLITE3_ASSOC))
	{
		$result .= $row['title']."-".$row['id'].':';
	}
	return $result;
}
?>