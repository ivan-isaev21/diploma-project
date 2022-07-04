<?php

use yii\bootstrap4\Html;
use yii\helpers\Url;
?>
<div class="my-3 p-3 bg-white rounded shadow-sm">
    <h1 class="border-bottom border-gray pb-2 mb-0">Админ панель</h1>
    <div class="media text-muted pt-3">
        <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
            <title>Placeholder</title>
            <rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text>
        </svg>
        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <a class="text-info" href="<?= Url::to(['tour/index']) ?>"> Управление экскурсиями </a>
        </p>
    </div>
    <div class="media text-muted pt-3">
        <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
            <title>Placeholder</title>
            <rect width="100%" height="100%" fill="#e83e8c"></rect><text x="50%" y="50%" fill="#e83e8c" dy=".3em">32x32</text>
        </svg>
        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <a class="text-info" href="<?= Url::to(['request/index']) ?>"> Управление заказами </a>
        </p>
    </div>
    <div class="media text-muted pt-3">
        <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
            <title>Placeholder</title>
            <rect width="100%" height="100%" fill="#6f42c1"></rect><text x="50%" y="50%" fill="#6f42c1" dy=".3em">32x32</text>
        </svg>
        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">            
            <?= Html::a(
                'Выход',
                ['site/logout'],
                [   
                    'class'=>"text-info",
                    'data-method' => 'POST',
                    'data-params' => [
                        'csrf_param' => \Yii::$app->request->csrfParam,
                        'csrf_token' => \Yii::$app->request->csrfToken,
                    ],
                ]
            ) ?>
        </p>
    </div>

</div>