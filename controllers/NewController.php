<?php
namespace app\controllers;
use app\Models\Category;
use yii\base\Controller;
use yii;
use app\models\TestForm; // 4.импортирование модели

class NewController extends Controller{

public function actionNew(){
    # Создание / изменение / удаления данны
    # работа с DELETE

    $posts= new TestForm();
    $posts->deleteAll(['>','id',7]);

    # либо
   // TestForm::deleteAll();

    # Виджеты это логика которую используется в видах для реализации повторяющихся частей которые
    //повторяется от страницы к странице
//2 метода Init - занимается иноциализацией выполняет нормализацию свойств виджета (может быть опущен)
// и Run-возврат результата работы виджета





    // если данные были загруженны методом POST
    if ($posts->load(Yii::$app->request->post())){ //Yii::$app - объект приложения
        if ( $posts->save()){ // вместо validate() ставить Save()-все равно автоматически провалидирует и заодно добавит в БЛ
            Yii::$app->session->setFlash('succses','Данные приняты'); //ключ-значение
            return Yii::$app->response->refresh();// Ответ клиенту, отсылаемый сервером, содержит заголовки, куки и
                                                 // данные. Все эти данные доступны в классе Yii::$app->response
        }else{
            Yii::$app->session->setFlash('error', 'ошибка');
        }
    }

    $this->layout = 'basic';
    $this->view->title='2сайт';
    return $this->render('new', compact('posts')); // 6.передача объекта в вид
}


public function actionPage()
{ $this->layout = 'basic';

//$cat= Category::find()->orderBy(['id'=>SORT_DESC])->all(); // равняется "SELECT * FROM данные из модели с классом с которой работает таблицей
# 3 этапа
    // 1. создат объект запроса - find()
    // 2. настроить объект запроса - ТИПО, WHERE ORDER BY - у каждого свои методы
    // 3. метод получения данных - в виде объекта

    // между find() методы можно в любом порядке ->all();

    # рекомендуется вытаскивать данные в виде сассива- потредляют меньше памяти
   // $cat= Category::find()->asArray()->all(); // вытаскивание данных в в иде массива
    // вместо обращения $cat->title обращаться просто $cat[title]

    # Where параметр можно в виде троки, массива, масив с вариантами
    //$cat= Category::find()->asArray()->where('parent=691')->all();
    //$cat= Category::find()->asArray()->where(['parent'=>691])->all();
   # найти поля (Like) в которых в title встречается 'pp'
    //$cat= Category::find()->asArray()->where(['like','title','pp'])->all();
    # все записи у которых id меньше или равно 695
    //$cat= Category::find()->asArray()->where(['<=','id', 695])->all();
     # только одну запись
    //$cat= Category::find()->asArray()->where(['<=','id', 695])->limit(1)->all();
   // $cat= Category::find()->asArray()->where(['<=','id', 695])->one();// збыточный запрос лучше limit
    # колличество записей
     //$cat=Category::find()->asArray()->where('parent=691')->count();
    #извлечение данных по первичному ключу или значениям отдельных столбцов достаточно распространённая задача, Yii предоставляет два коротких метода для её решения:

    # findOne -1 строку
    # findAll
    //$cat= Category::findOne(691);
    //$cat= Category::findAll(['parent'=> 692])->one();

    #findBySql
   // $query = "SELECT * FROM categories WHERE title LIKE '%pp%'";
    //$cat = Category::findBySql($query)->all();
    // так как в базу данных попадает информация от пользователя и там может быть SQL- иньекция
    // '%pp%'- должно все экранироваться. для этого придумываю параметр :search
    // и записываю следующее -'массив параметров'
   // $query = "SELECT * FROM categories WHERE title LIKE :search";
   // $cat = Category::findBySql($query,[':search' => "%pp%"])->all();



  /*

    # отложенная и жадная загрузка данных - связывание hasMany() hasOne()
     2 метода для связи таблиц моделей допустим нужно связать модель категорий с моделью продуктов
     если к одному полю может к примеру id может подходить несколько полей из других таблиц тогда использовать hasMany()
     если к одному полю подходит  только одно поле из другой таблицы тогда hasOne()
     hasMany-массив объектов, hasOne-один объект.

    # (отложенная загрузка) ленивая загрузка- если прописана связь между 2 моделями то она срабатывает только в момент обращения к этой модели
     + нет лишних запросов - для каждлго объекта будет свой запрос 10 если 10 запросов (полезно при малом колличестве запросов)

    $cat=Category::find()->all(); // 41 запрос

    # жадная загрузка -  позволяет получить все данные
    $cat=Category::find()->with()->all();// 6 запросов with('products')

  */





    return $this->render('page', compact('cat'));
}
}