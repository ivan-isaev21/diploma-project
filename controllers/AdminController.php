<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class AdminController extends Controller
{
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }
        return $this->render('index');
    }
}
