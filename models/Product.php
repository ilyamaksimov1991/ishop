<?php
/**
 * Created by PhpStorm.
 * User: Ilya
 * Date: 23.02.2017
 * Time: 0:13
 */

namespace app\models;


use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    public static function tableName()
    {
        return 'products';
    }
    public function getCategoris(){// название любое
       return  $this->hasOne(Category::className(),['id' =>'parent']); // потому что к одному полю может быть связано только
        // одно поле из другой страницы;
    }
}