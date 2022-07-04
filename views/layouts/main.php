<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Breadcrumbs;
use app\assets\AppAsset;
use kartik\icons\FontAwesomeAsset;
use kartik\icons\Icon;
Icon::map($this);  

AppAsset::register($this);

FontAwesomeAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([        
        //'brandLabel' => Icon::show('route').'БАХМУТСКИЙ ЦЕНТР ТУРИЗМА',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
        'class' => 'navbar navbar-expand-lg navbar-dark bg-primary fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto ' ],
        'encodeLabels' => false,
        'items' => [            
            ['label' => Icon::show('info-circle').'О нас', 'url' => ['/site/about']],
            ['label' => Icon::show('file-signature').'Обратная связь', 'url' => ['/request/create']],
            !Yii::$app->user->isGuest ? (
                ['label' => Icon::show('tools').'Админ панель', 'url' => ['/admin/index']]
            ):''
                
        ]]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>        
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Isaev Ivan diplom work <?= date('Y') ?></p>        
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
