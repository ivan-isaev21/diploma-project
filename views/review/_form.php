<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\rating\StarRating;

/* @var $this yii\web\View */
/* @var $model app\models\Review */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="review-form">


    <?php $form = ActiveForm::begin(['options' => ['style' => 'margin:0 auto;']]) ?>

    <?= $form->field($model, 'ip')->hiddenInput(['maxlength' => true,'value'=>$_SERVER['REMOTE_ADDR']])->label(false) ?>

    <?= $form->field($model, 'tour_id')->hiddenInput(['value'=>$tour->id])->label(false) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6,'maxlength' => true]) ?>

    <?= $form->field($model, 'rating')->widget(StarRating::classname(), [
        'language' => 'ru',
        'options' => ['style' => 'margin:0 auto;'],
        'pluginOptions' => [
            'stars' => 5,
            'step' => 1,
            'min' => 0,
            'max' => 5,
            'showClear' => false,
            'showCaption' => false,
            'size' => 'xs',
            'defaultCaption' => 'оценка {rating}',
            'starCaptions' => [
                0 => 'Extremely Poor',
                1 => 'оценка 1',
                2 => 'оценка 2',
                3 => 'оценка 3',
                4 => 'оценка 4',
                5 => 'оценка 5'
            ],
        ],
    ])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>