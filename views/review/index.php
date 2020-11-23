<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\rating\StarRating;
use kartik\icons\Icon;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchReview */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отзывы';
$this->params['breadcrumbs'][] = ['label' => $tour->title, 'url' => ['tour/view', 'id' => $tour->id]];
$this->params['breadcrumbs'][] = ['label' => 'Отзывы'];

?>
<div class="review-index">

    <h1><?= Html::encode($tour->title) ?></h1>

    <p>
        <?php if (!$is_exist) : ?>
            <?= Html::a('Добавить отзыв', ['create', 'tour_id' => $tour_id], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>
    </p>
    <?php Pjax::begin(); ?>

    <?php $columns =  [
        ['class' => 'yii\grid\SerialColumn'],
        'name:ntext',
        'comment:ntext',
        [
            'attribute' => 'rating',
            'format' => 'raw',
            'filter' => false,
            'value' => function ($data) {             
                return StarRating::widget([                    
                    'name'=>'rating'.$data->ip,
                    'value' =>$data->rating,                   
                    'pluginOptions' => [                        
                        'displayOnly' => true,//звезды только для показа, но не активны                           
                        'stars' => 5,
                        'step' => 1,
                        'min' => 0,
                        'max' => 5,                            
                        'showClear' => false,// (знак "кирпич")
                        'showCaption' => false,//без подписи количества выбранных
                        'size' => 'xs',//mili
                        'defaultCaption' => 'оценка {rating}',
                        'starCaptions' => [
                            0 => 'Extremely Poor',
                            1 => 'оценка 1',
                            2 => 'оценка 2',
                            3 => 'оценка 3',
                            4 => 'оценка 4',
                            5 => 'оценка 5',                               
                        ]]
                ]);
            }
        ]

    ];

    if (!Yii::$app->user->isGuest) {
        $columns[] = [
            'class' => 'yii\grid\ActionColumn',
            'buttons' => [
                'delete' => function ($url, $model) {                    
                    return Html::a(Icon::show('trash-alt'), $url, [
                        'title' => 'Удалить',
                        'data' => [
                            'confirm' => 'Вы действительно хотите удалить отзыв?',
                            'method' => 'POST'
                        ],
                    ]);
                }
            ]

        ];
    }
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns
    ]); ?>

    <?php Pjax::end(); ?>

</div>