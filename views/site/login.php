<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Админ панель';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-login">
    
    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="form-group my-5">
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'password')->passwordInput() ?>    
        <?= Html::submitButton('Авторизоваться', ['class' => 'btn btn-primary my-2 text-center col-lg-3 offset-lg-1 ', 'name' => 'login-button']) ?>          
    <?php ActiveForm::end(); ?> 
    </div>   
</div>
