<?php // это новый шаблон сайта
//$this->title="nomer";
use app\assets\AppAsset2; //1подключение стилей и скрипток
use yii\helpers\Html; // подключение метода Html для ссылок

AppAsset2::register($this); //2подключение стилей и скрипток
?>
<?php $this->beginPage() ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?=$this->title?></title>
        <?php $this->head() ?>

    </head>
    <body>
    <?php $this->beginBody() ?>
    <h1>!Hello, New!</h1>
    <div class="wrap">

        <div class="container">
            <ul class="nav nav-pills">
                <li role="presentation" class="active"><?= Html::a('Главная',"/web/")?></li>
                <li role="presentation" class="active"><?= Html::a('Статьи',["new/new"])?></li>
                <li role="presentation" class="active"><?= Html::a('Статья',["new/page"])?></li>
            </ul>
        </div>
        <?=$content?>
    </div>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>


