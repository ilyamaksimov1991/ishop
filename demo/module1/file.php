<?php 
//
if ($_POST){//echo 1;
	//echo "файл загружен!";
	$str = "Имя: ".$_POST['name']." Фамилия: ".$_POST['fam'].'</br>';
	$f=fopen('fio.php','a');
	if (fputs($f,$str)){
	
	echo "файл загружен!";
	}
}