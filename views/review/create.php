<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Review */

$this->title = 'Добавить отзыв';
$this->params['breadcrumbs'][] = ['label' => $tour->title, 'url' => ['tour/view', 'id' => $tour->id]];
$this->params['breadcrumbs'][] = ['label' => 'Отзывы', 'url' => ['index','tour_id' => $tour->id]];

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="review-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tour'=>$tour        
    ]) ?>

</div>
