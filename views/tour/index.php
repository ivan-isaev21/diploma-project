<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\icons\Icon;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchTour */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Экскурсии';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="tour-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           
            'title',                       
            'price',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a(Icon::show('eye'), $url, [
                                   
                        ]);
                    },
     
                    'update' => function ($url, $model) {
                        return Html::a(Icon::show('edit'), $url, [
                                    'title' => 'Редактировать',
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a(Icon::show('trash-alt'), $url, [
                            'title' => 'Удалить',
                            'data' => [
                                'confirm' => 'Вы действительно хотите удалить экскурсию?',
                                'method'=>'POST'
                            ],
                        ]);
                    }]
        
        ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
