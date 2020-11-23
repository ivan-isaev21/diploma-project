<?php

namespace app\controllers;

use Yii;
use app\models\Review;
use app\models\Tour;
use app\models\SearchReview;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
/**
 * ReviewController implements the CRUD actions for Review model.
 */
class ReviewController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Review models.
     * @return mixed
     */
    public function actionIndex()
    {        
        $tour_id=Yii::$app->request->get('tour_id'); 
    
        if(!$tour_id){
           return  $this->goHome();
        }
        $is_exist=Review::find()->where(['ip'=>$_SERVER['REMOTE_ADDR'],'tour_id'=>$tour_id])->count(); 
        $tour = Tour::find()->where(['id'=>$tour_id])->one();
        $searchModel = new SearchReview();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'is_exist'=>$is_exist,
            'tour_id'=>$tour_id,
            'tour'=>$tour
        ]);
    }
  

    /**
     * Creates a new Review model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Review();
      
        $tour_id=Yii::$app->request->get('tour_id');     
        $is_exist=Review::find()->where(['ip'=>$_SERVER['REMOTE_ADDR'],'tour_id'=>$tour_id])->count();    
        if(!$tour_id or $is_exist){
           return  $this->goHome();      
        }

        $tour = Tour::find()->where(['id'=>$tour_id])->one();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Review::setAverageRating($tour_id);
            return $this->redirect(['index', 'id' => $tour_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'tour'=>$tour
        ]);
    }    

    /**
     * Deletes an existing Review model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ip,$tour_id)
    {
        $model=Review::find()->where(['ip'=>$ip,'tour_id'=>$tour_id])->one(); 
        Review::setAverageRating($tour_id);       
        $model->delete();

        return $this->redirect(['index','tour_id'=>$tour_id]);
    }
   
}
