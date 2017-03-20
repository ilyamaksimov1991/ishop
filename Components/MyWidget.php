<?php

namespace  app\components;
use yii\base\Widget;

class MyWidget extends Widget {
    # Виджеты это логика которую используется в видах для реализации повторяющихся частей которые
    //повторяется от страницы к странице
    # метода Init - занимается иноциализацией выполняет нормализацию свойств виджета (может быть опущен)
    // и Run-возврат результата работы виджета
    public $name;

    public function init()
    {
         parent::init();
         ob_start();// начать буферизацию

    }

    public function run()
    {
        $content1=ob_get_clean();// вывод того что в буфере находится;
       $content1= mb_strtoupper($content1, 'utf-8');
        return $this->render('my', compact('content1'));
    }
}