<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Управление заказами';
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => ['/admin/index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'text:ntext',
            'email',
            'phone_number',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>