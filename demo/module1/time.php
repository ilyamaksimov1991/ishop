<?php
/* <form action='file.php' method="post">
Name: <input type="text" name="name"/><br><br>
Familia: <textarea name="fam"></textarea><br>
<input type="submit" value="load"/>
</form>  */






echo "<br>";
$z=array(2,5,7,8,12,34,66,76,66,76,3,443,233,44,40,90,65,45,999,30);
$ki='';
foreach($z as $k){
	if ($ki<$k){
		$ki=$k;
		
	}
}
 echo $ki;
echo "<br>";
$q='4';
$q[$q]='8';
echo $q;


echo "<br>";
$a= mt_rand(0,3);
$b= mt_rand(0,3);
$c=  mt_rand(0,3);

$res=$a+$b+$c;
if($res !=9 && $res !=6){
	echo $res;
	echo "=".$a."+".$b."+".$c;
}

echo "<br>";
$x=3;

switch($x){ 

case 2:
echo "Это число 2";
break;

case 3:
echo  "Это число 3";
break;

default:
echo  "Это другок число";
break;
}
echo "<br>";

$z=array(2,5,7,8,12,34,66,76,66,76,3,443,233,44,40,90,65,45,30);
for($i=0; $i<count($z); $i++){
	if(($z[$i]%5)==0){
		echo $z[$i].",";
	}
}

echo "<br>";

echo date("H : m : s "); 


$var = 56;
$x="privet";
echo "<br>";
echo $var,$x;
echo "<br>";
print $var;
echo "<br>";
$z=array('h', 'e', 'l', 'o', 'y');
print_r($z);
print_r(array_reverse($z));
$sas=count($z)-1;
echo $sas;
echo "<br>";
$revers=array();
for($i=$sas; $i>=0; $i--){
	$revers[]= $z[$i];
}
print_r($revers);
echo "<br>";

$str = "stroka dlya reversa";
echo strrev($str);
echo "<br>";

$str = "stroka dlya reversa-2";

for($i=(strlen($str)-1); $i>=0; $i--){
	echo $str[$i];
}
echo "<br>";

$str = "stroka dlya reversa-3";
$b='';
for($i=(strlen($str)-1); $i>=0; $i--){
	$b.= $str[$i];
}
echo $b;

echo "<br>";

function fun($x){
	if ($x == 0){
		return 1;
	}else {
		return ($x*fun($x-1));
	}
	
}

echo fun(5);
echo "<br>";

function fiban($n){
	if ($n < 3){
		return 1;
	}else{
		return fiban($n-1)+fiban($n-2);
	}
}
	for($n=1; $n <= 16; $n++){
	echo (fiban($n).",");
	}

echo fiban(7);

echo "<br>";

$a="0";

if($a==false){
	echo "Yes";
}




























