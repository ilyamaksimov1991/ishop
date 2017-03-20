<?php
class NewsDB{
	const DB_NAME = 'books.db';
	const ERROR = " ОШИБКА!!! ";
	private $db; // создаю приватное свойство
	
	function __construct($cat){
		 $this->db = new SQLite3(self::DB_NAME);
		 $sql = 'SELECT * FROM book WHERE category IN (' . 
		  $this->getChildCategoryList($cat, $db) . $cat . ')';
	      $result = $this->db->exec($sql);
		  while ($row = $result->fetch(SQLITE_ASSOC))
		  echo $row['title'], "\n";
	}
	
	
	public function getChildCategoryList($categoryId, $database)
{
	$result = '';
	$sql = 'SELECT id, parent FROM category WHERE parent = ' . $categoryId;
	$res =$this->db->query($sql);
	while ($row = $res->fetch(SQLITE_ASSOC))
		$result = $result . $row['id'] . ', ' . getChildCategoryList($row['id'], $database);
	return $result;
}
}