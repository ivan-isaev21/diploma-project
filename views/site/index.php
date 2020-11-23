<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\bootstrap4\Carousel;
use app\models\File;
use app\models\Review;
use yii\bootstrap4\LinkPager;
use kartik\icons\Icon;
use kartik\rating\StarRating;
$this->title = 'Достопримечательности Бахмута';
?>
<main role="main">
  <section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading">Достопримечательности Бахмута</h1>
      <p class="lead text-muted">
        Город Бахмут является одним из старейших донбасских городов, он был основан в 1571 году, за это время город пережил много этапов своего развития и теперь имеет очень богатую историю. Множество архитектурных памятников раскрывают тайную историю города.</p>
    </div>
  </section>
  <section class="text-center">
    <div class="container">   
  <?= $this->render('_search', [
    'model' => $searchModel  
  ]); ?>
   </div>
  </section>
  
  <?php if ($models) : ?>

    <div class="album  ">
      <div class="container">
        <div class="row">
          <?php foreach ($models as $model) : ?>
            <?php $wrap = [];
            if (!empty($model->images)) {
              $file = new File();
              $images = $file->getPath($model->images);
              foreach ($images as $img) {
                $wrap[] = '<img src="' . $img . '"/>';
              }
            }; ?>
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm ">
                <?= Carousel::widget([
                  'items' => $wrap,
                  'options' => [
                    'name' => 'carousel[]'
                  ]
                ]) ?>
                <h5 class="card-title  text-center px-4 fix-height-card-title "><?= $model->title ?></h5>
                <p class="d-flex justify-content-between align-items-center px-4">
                  <?= StarRating::widget([
                    'name' => 'rating[]',
                    'value' => $model->rating,
                    'pluginOptions' => [
                      'displayOnly' => true,                       
                      'stars' => 5,
                      'step' => 1,
                      'min' => 0,
                      'max' => 5,
                      'showClear' => false, 
                      'showCaption' => false, 
                      'size' => 'xs', 
                      'defaultCaption' => 'оценка {rating}',
                      'starCaptions' => [
                        0 => 'Extremely Poor',
                        1 => 'оценка 1',
                        2 => 'оценка 2',
                        3 => 'оценка 3',
                        4 => 'оценка 4',
                        5 => 'оценка 5',
                      ]
                    ]
                  ]) ?>
                  <a class="text-info" href="<?= Url::to(['review/index', 'tour_id' => $model->id]) ?>"> Всего отзывов: (<?= Review::getCount($model->id) ?>)</a></p>

                <div class="card-body ">
                  <p class="card-text fix-height-card-text"><?= $model->short_description ?></p>
                  <div class="d-flex justify-content-between align-items-center ">
                    <div class="btn-group">
                      <a href="<?= Url::to(['tour/view', 'id' => $model->id]) ?>" class="btn btn-sm btn-outline-secondary">Подробнее</a>
                      </div>
                    <small class="text-muted"> <?= Icon::show('money-bill-wave') ?> <?= $model->price ?> грн</small>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        
    </div> <!-- Пагинация -->
    <?= LinkPager::widget([
      'pagination' => $pages,
    ]); ?>

  <?php else : ?>
    <div class="text-center">  <img src="default.jpg" /><br><h2>Ничего не найдено!</h2><div>
  <?php endif; ?>  
</div>
      </div>