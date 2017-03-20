<?php
namespace app\models;
use yii\base\Model;
use yii\db\ActiveRecord;// 1.расширение класса ActiveRecord

class TestForm extends ActiveRecord  // 2.class TestForm расширяет ActiveRecord
{
    # 3.Создание атрибутов\полей формы - НЕ ОБЯЗАТЕЛЬНО в АсtivRecords - создадутся(автоматически Yii сделает это
    // за меня) сами за счет служебных запросов
    /*
    public $name;
    public $email;
    public $text;
    */

    # получение данных из формы - заполнять свойство либо массовая загрузка

public static function tableName(){ return 'posts';}

    public function attributeLabels()
    {return [
            'name' => 'Имя',
            'email' => 'E-mail',
            'text' => 'Текст',
        ];      }

    public function rules() // АТРИБУТЫ должны быть безопасными
    {
        return [
            [['name','email', 'text'],'required'],
            ['email', 'email']
        ];
    }


}