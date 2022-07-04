<?php

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
  <section class=" text-center">
    <div class="container">
      <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          Спасибо за ваше обращение! Наши менеджеры свяжутся с вами в ближайшее время!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>
      
    </div>
  </section>
  <section class="text-center">
    <div class="container">
    <h2 class="text-wrap text-break my-3" > <?=Icon::show('route')?>БАХМУТСКИЙ ЦЕНТР ТУРИЗМА</h2>
      <p class="lead text-muted">
        Город Бахмут является одним из старейших донбасских городов, он был основан в 1571 году, за это время город пережил много этапов своего развития и теперь имеет множество архитектурных памятников и богатую историю</p>
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
                $wrap[]='<div class="item-responsive item-16by9">
                <div class="content" style="background: url('.$img.');"></div>
              </div>';
              }
            }; ?>
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm ">
                <?= Carousel::widget([
                  'items' => $wrap,
                  'options' => [
                    'name' => 'carousel[]',                    
                  ],
                  'controls' => [
                    '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>',
                    '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>'
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
                    <small class="text-muted"> </small>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <?= LinkPager::widget([
          'pagination' => $pages,
        ]); ?>

      <?php else : ?>
        <div class="text-center"> <img src="default.jpg" /><br>
          <h2>Ничего не найдено!</h2>
          <div>
          <?php endif; ?>
          </div>
        </div>