<?php

use yii\helpers\Html;

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
use kartik\file\FileInput;
use kartik\icons\Icon;
use vova07\imperavi\Widget;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Tour */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tour-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'short_description')->textarea(['maxlength' => true,'row'=>3]) ?>

    <?= $form->field($model, 'description')->widget(Widget::className(), [
    'settings' => [
        'lang' => 'ru',
        'minHeight' => 400,
        'plugins' => [
            'fullscreen',                     
        ],        
    ],
])?>

    <?= $form->field($file, 'images[]')->widget(FileInput::classname(), [
        'language' => 'ru',
        'options' => ['multiple' => true, 'accept' => 'image/*'],
        'pluginOptions' => [
            'uploadUrl' =>  urldecode(Url::to(['tour/upload'],true)),
            'deleteUrl' => urldecode(Url::to(['tour/delete-image'],true)),
            'uploadExtraData' => ['tour_id' => $model->id, 'is_post' => $model->isNewRecord ? 'new' : 'update'],
            'initialPreview'=>$initialPreview,
            'initialPreviewAsData'=>$initialPreviewAsData,
            'initialPreviewConfig'=> $initialPreviewConfig,
            'maxFileCount' => 5,
            'maxFileSize' => 10000,
            'showUpload' => false,
            //'showPreview'=>false,
            'overwriteInitial' => true,
            'allowedFileExtensions' => ['jpg', 'png'],
        ]
    ])->label('Изображения') ?>

    <?php
    Modal::begin([
        'title' => 'Как встроить на сайт карту или маршрут?',
        'size' => Modal::SIZE_LARGE,
        'toggleButton' => ['class' => 'btn btn-primary', 'label' => Icon::show('info-circle') . 'Как встроить на сайт карту или маршрут?'],
    ]);
    ?>
    <ol>
        <li>Откройте <a href="https://www.google.com/maps" target="_blank" rel="noopener">Google Карты</a>.</li>
        <li>Откройте маршрут, карту или изображение просмотра улиц, которое хотите встроить.</li>
        <li>В левом верхнем углу экрана нажмите на значок меню Меню.</li>
        <li>Выберите Ссылка/код.</li>
        <li>Откройте вкладку Встраивание карт.</li>
        <li>Чтобы выбрать размер карты, нажмите на стрелку вниз Стрелка вниз слева от поля с кодом.</li>
        <li>Скопируйте текст из поля и вставьте его в поле ниже.</li>
    </ol>
    <?php
    Modal::end();
    ?>
    <?= $form->field($model, 'map_code')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true, 'class' => ' form-control w-25']) ?> 

    <div class="form-group">
        <?= Html::submitButton(Icon::show('save') . 'Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>