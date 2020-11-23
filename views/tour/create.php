<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Tour */

$this->title = 'Добавить экскурсию ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tour-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [      
        'model' => $model,
        'file' => $file,
        'initialPreview'=>$initialPreview,
        'initialPreviewAsData'=>$initialPreviewAsData,
        'initialPreviewConfig'=> $initialPreviewConfig

    ]) ?>

</div>
