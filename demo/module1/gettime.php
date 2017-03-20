<?php
/*
** Сценарий возвращает текущее время
*/

// Установка типа данных и кодировки
header("Content-type: text/plain; charset=utf-8");
header("My-Time: ".date("H:i:s"));
// Чтение параметра задержки и задержка в коде
/*if (isset($_GET["delay"]))
{
	$delay = (int) $_GET["delay"];
	$currTime = time();
	while (time() < $currTime + $delay) {}
}*/

// Текущее время
//echo date("H:i:s");
?>