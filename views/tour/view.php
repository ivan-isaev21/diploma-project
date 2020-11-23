<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Review;
use yii\widgets\DetailView;
use yii\bootstrap4\Carousel;
use kartik\rating\StarRating;
use yii\bootstrap4\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Tour */

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tour-view">
    <?php if((!Yii::$app->user->isGuest)):?>
    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить экскурсию?',
                'method' => 'post',
            ],
        ]) ?>

    </p>
        <?php endif;?>

    <div class="card mb-4">
        <?php if (!empty($images)) : ?>
            <figure>
                <?= Carousel::widget([
                    'items' => $images,
                    'options' => [
                        'id' => 'viewCarousel'
                    ]
                ]) ?>
            </figure>
        <?php endif; ?>
        <div class="card-body">
            <h2 class="card-title"><?= Html::encode($model->title) ?></h2>
            <?=StarRating::widget([                        
                        'model' => $model,
                        'attribute' => 'rating',                        
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
                        ])?>  <a  class="text-info" href="<?= Url::to(['review/index', 'tour_id' => $model->id]) ?>">
                         Всего отзывов: (<?=Review::getCount($model->id)?>)</a>
            <p class="card-text">
                <?= Html::decode($model->description) ?>
            </p>
            <p class="text-center">
                <?= Html::decode($model->map_code) ?>
            </p>
        </div>
        <div class="card-footer text-muted">
            <a href="#">заказать</a>
        </div>
    </div>



</div>