<?php 
//
if ($_POST){//echo 1;
	//echo "���� ��������!";
	$str = "���: ".$_POST['name']." �������: ".$_POST['fam'].'</br>';
	$f=fopen('fio.php','a');
	if (fputs($f,$str)){
	
	echo "���� ��������!";
	}
}