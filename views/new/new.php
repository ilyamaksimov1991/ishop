
<?php
use yii\widgets\ActiveForm; // 7.подключение виджета формы
use yii\helpers\Html; // 8.для кнопки?>
<h1>Hello, New!!!</h1>

<?php $form= ActiveForm::begin(['options'=>['id' =>'testForm']]) // 9.запускает форму объявляет тег начала формы ?>

<?php if( Yii::$app->session->hasFlash('succses')){
           echo Yii::$app->session->getFlash('succses');
} ?>
<?php if( Yii::$app->session->hasFlash('error')){
   ?>
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Warning!</strong> ошибка.
    </div>

<?php
} ?>
<?=
 # 11.создание полей формы
 $form->field($posts,'name') ?>
<?= $form->field($posts,'email')->input('email') ?>
<?= $form->field($posts,'text')->textarea(['rows'=>5]) ?>
<?= yii\jui\DatePicker::widget(['name' => 'attributeName']) ?>
<?= Html::submitButton('Отправить', ['class'=> 'btn btn-success']) ?>
<?php ActiveForm::end() // 10.закрывает форму ?>


