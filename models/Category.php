<?php
namespace app\Models;

use yii\db\ActiveRecord;

class Category extends ActiveRecord {

    # конвенция модель подсталяется имя модели -
    # если имя модели отличается от имени таблицы
    public static function tableName()
    {
        return 'categories';
    }
 public function getProducts(){// по названию после get будет запрашиваться данные
        return $this->hasMany(Product::className(),['parent'=>'id']); //возвращает связь класс::имя
     // (имя класса с которым связываю ['ключом будет имя поля из этой же таблицы' => 'а значение имя поля с той страницы с которой хочу связать')
 }
}