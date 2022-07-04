<?php

use yii\helpers\Html;
$this->title = 'Обратная связь';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-create">
   
        <h1>Заполните поля ниже:</h1>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>    
</div>