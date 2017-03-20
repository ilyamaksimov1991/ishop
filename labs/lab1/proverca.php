<?php
# Декоратор 
 interface Itext {
	 public function show();
 }

class Text_one implements Itext {
	protected $value;
	
	public function __construct(Itext $text){
		$this->value=$text;
	}

	public function show(){
		 echo "Hello";
		 $this->value->show();
	}
}	

class Text_two implements Itext {
	protected $value;
	
	public function __construct(Itext $text){
		$this->value=$text;
	}

	public function show(){
		 echo " ----- ";
		 $this->value->show();
	} 
}

class Text_three implements Itext {
	protected $value;
	
	public function __construct(Itext $text){
		$this->value=$text;
	}

	public function show(){
		 echo  "World";
		 $this->value->show();
	} 
}

class Emptu implements Itext {
	

	public function show(){
		 //echo "World";
	} 
}

$obj=new Text_one(new Text_two(new Text_three(new Emptu())));
echo $obj->show();
echo "<br>";
$obj=new Text_three(new Text_one(new Text_two(new Emptu())));
echo $obj->show();








/*
abstract class Composit {
	protected $name;
	
	public function __construct($x) {
		 $this->name=$x;
	}
	
	abstract public function add(Composit $y);
	abstract public function remove(Composit $z);
	abstract public function display();
}

class Component extends Composit {
	
	public $arr = array();
	
	 public function add( Composit $y){
		 $this->arr[$y->name]=$y;
		 //return $this->arr;
	 }
	public function remove(Composit $z){
		unset($this->arr[$z->name]);
	}
	public function display(){
		echo "<pre>";
		foreach ($this->arr as $item){
			echo $item->display()."<br>";
		}
		echo "</pre>";
	}
	
}

class Lissen extends Composit {
	
	 public function add(Composit $y){
		 return "Вот тут я добавляю объект";
	 }
	 public function remove(Composit $z){
		 print ("Удаляю");
	 }
	 public function display(){
		 return $this->name;
	 }
}


$one_obj = new Component("Спартанцы");
$one_obj->add(new Lissen ("Воины"));
$one_obj->add(new Lissen ("Лучники"));
$one_obj->add(new Lissen ("Пехотинцы"));

$one_obj1 = new Component("Асасины");
$one_obj1->add(new Lissen ("Воины"));
$one_obj1->add(new Lissen ("Лучники"));
$one_obj1->add(new Lissen ("Пехотинцы"));

$one_obj3 = new Component("Викинги");
$one_obj3->add(new Lissen ("Воины"));
$one_obj3->add(new Lissen ("Лучники"));
$one_obj3->add(new Lissen ("Пехотинцы"));


$one_obj->add($one_obj1);
$one_obj->add($one_obj3);
$one_obj->display();

$one_obj->remove($one_obj3);
$one_obj->display();




*/






/*
abstract class Территория{}

class Земля extends Территория {}
   class Море_Земля extends Земля {}
   class Лес_Земля extends Земля {}
   class Равнина_Земля extends Земля {}
   
class Марс extends Территория {}
   class Море_Марс extends Марс {}
   class Лес_Марс extends Марс {}
   class Равнина_Марс extends Марс {}
   
class Венера extends Территория {}
   class Море_Венера extends Венера {}
   class Лес_Венера extends Венера {}
   class Равнина_Венера extends Венера {}
   
   class ЛОГИКА {
	   public $зем;
	   public $мар;
	   public $вен;
	   
	   public function __construct($x, $y, $z){
	   $this->зем = $x;
	   $this->мар = $y;
	   $this->вен = $z;
	   }
	   
	   public function Земля(){
		  return clone $this->зем;
	   }
	   
	   public function Марс(){
		  return clone $this->мар;
	   }
	   
	   public function Венера(){
		  return clone $this->вен;
	   }
	   
   }
   
  $obj= new ЛОГИКА ( new Море_Земля, new Лес_Марс, new Равнина_Венера);
print_r($obj);

$x= $obj->Венера();
print_r($x);

*/





/*
# Абстрактная фабрика
class Config{
	# !-СТАТИЧЕСКое-! свойство;
	public static $nomer = 1;
}

abstract class Fabrica {
	# !-СТАТИЧЕСКАЯ-! функция для выбора
	public static function get_Factoru(){
	switch(Config::$nomer){
		# выбор фабрик
		case 1:
		return new Chokolad_Fabrica();
		break;
		
		case 2:
		return new Car_Fabrica();
		break;
	}
	}
	
	abstract function getProduct();
	
}

class Chokolad_Fabrica extends Fabrica { // 1 фабрика
	function getProduct(){
		return new Product_nomer_one();
	}
}

class Car_Fabrica extends Fabrica { // 2 фабрика
	function getProduct(){
		return new Product_nomer_two();
	}
}


abstract class Product { 
	abstract function get_Name();
}

class Product_nomer_one extends Product { // 1 продукт
	public function get_Name(){
		echo " Тут продукт шоколадок<br> ";
	}
}
class Product_nomer_two extends Product { // 2 продукт
	public function get_Name(){
		echo "Тут продукт машин<br> ";
	}
}

$obj=Fabrica::get_Factoru();
Config::$nomer=2;
$obj->getProduct()->get_Name();

$obj2=Fabrica::get_Factoru();
Config::$nomer=1;
$obj2->getProduct()->get_Name();

*/










/*
 class Синглтон {
# приватное СТАТИЧЕСКОЕ свойство - в которое записывается объект
private static $name; //сюда записываю объект 
//private $param;

# чтобы нельзя было переопределить
private function __construct(){}
private function  __clone(){}

# публичный СТАТИЧЕСКИЙ метод в которой создается объект если еще пустой/возврат если еще не пустой
public static function getInstanse(){
	if (empty(self::$name)){
		// если еще нет объекта
		//echo 1;
		return self::$name = new Синглтон(); //---- например для подключ к базе данных
	//echo 1;
	}
	// если уже есть объект
	return self::$name;
	echo 2;
}
 }

$odj=Синглтон::getInstanse(); // Singleton::get_instanse() -нужно вставить в нужне место
//$odj2= Singleton::get_instanse(); 
print_r($odj);
*/
/*
abstract class интерфейс_Продукты {
	abstract function Фабрика();
}

class Продукты extends интерфейс_Продукты{
	function Фабрика(){
		echo "Вот тут создается продукт";
	}
	
}

abstract class интерфейс_код {
	abstract function func1();
	abstract function создание_продукта();
	abstract function func3();
}

class Код extends интерфейс_код {
	function func1(){ echo "Верхний колонтилум <br><br>";}
	function создание_продукта(){ $product= new Продукты; $product->Фабрика();}
	function func3(){ echo "<br><br>Нижний колонтилум <br>";}
}

$cod=new Код();
$cod->func1();
$cod->создание_продукта();
$cod->func3();
*/
?>