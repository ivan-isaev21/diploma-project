<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\icons\Icon;
?>
<div class="row">
    <div class="col-md-12 ">
        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'options' => [
                'class' => 'row mb-2',
                'data-pjax' => 1
            ],
        ]); ?>
        <div class="col-12 col-sm pr-sm-0">
            <?= $form->field($model, 'title')->textInput(['class' => 'form-control mb-2 '])->label(false) ?>
        </div>
        <div class="col-12 col-sm-auto pl-sm-0">
            <?= Html::submitButton(Icon::show('search').' Найти', ['class' => 'btn btn-primary btn-block ml-lg-1 mb-2']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>