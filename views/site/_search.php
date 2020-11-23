<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    'options' => [
        'class' => 'form-group',
        'data-pjax' => 1
    ],
]); ?>    
<?= $form->field($model, 'title')->textInput(['class' => 'form-control '])->label(false) ?>    
<?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>     
<?php ActiveForm::end(); ?>