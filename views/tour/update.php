<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Tour */

$this->title = 'Изменить экскурсию: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => ['/admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Управление экскурсиями', 'url' => ['/tour/index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="tour-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'file' => $file,
        'initialPreview'=>$initialPreview,
        'initialPreviewAsData'=>$initialPreviewAsData,
        'initialPreviewConfig'=>$initialPreviewConfig
    ]) ?>

</div>
