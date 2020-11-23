<?php

namespace app\controllers;

use Yii;
use app\models\Tour;
use app\models\SearchTour;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\File;
use yii\web\UploadedFile;

/**
 * TourController implements the CRUD actions for Tour model.
 */
class TourController extends Controller
{


    public $enableCsrfValidation = false;

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
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
                    'upload' => ['POST']
                ],
            ],
        ];
    }

    public function actionUpload()
    {
        return true;
    }


    /**
     * удаляет фото 
     * @return boolean
     */
    public function actionDeleteImage()
    {
        if (Yii::$app->request->isPost) {
            $model = Tour::find()->where(['id' => Yii::$app->request->post('tour_id')])->one();
            if (!empty($model->images)) {
                $images = json_decode($model->images);
                $newImages = [];
                foreach ($images as $img) {
                    if ($img->key == Yii::$app->request->post('key')) {
                        if (file_exists($img->path)) {
                            unlink($img->path);
                        }
                    } else {
                        $newImages[] = $img;
                    }
                }
                $model->images = json_encode($newImages);
                $model->save();
            }
        }
        return true;
    }

    /**
     * Lists all Tour models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchTour();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tour model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $wrap = [];
        if (!empty($model->images)) {
            $file = new File();
            $images = $file->getPath($model->images);
            foreach ($images as $img) {
                $wrap[] = '<img  src="' . $img . '"/>';
            }
        }

        return $this->render('view', [
            'model' => $model,
            'images' => $wrap
        ]);
    }

    /**
     * Creates a new Tour model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tour();
        $file = new File();
        $initialPreview = [];
        $initialPreviewAsData = false;
        $initialPreviewConfig = [];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file->images = UploadedFile::getInstances($file, 'images');
            if(!empty($file->images)){
            $model->images = $file->upload($model->id)??null;
            $initialPreview = $file->getPath($model->images)??[];
            $initialPreviewAsData = true;
            $model->save(false);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'file' => $file,
            'initialPreview' => $initialPreview,
            'initialPreviewAsData' => $initialPreviewAsData,
            'initialPreviewConfig' => $initialPreviewConfig
        ]);
    }

    /**
     * Updates an existing Tour model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $file = new File();
        $initialPreview = [];
        $initialPreviewAsData = false;
        $initialPreviewConfig = false;

        if (!empty($model->images)) {
            $initialPreview = $file->getPath($model->images);
            $initialPreviewAsData = true;
            $initialPreviewConfig = json_decode($model->images);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file->images = UploadedFile::getInstances($file, 'images');
            if (!empty($file->images)) {
                $model->images = $file->upload($model->id);
                $model->save(false);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'file' => $file,
            'initialPreview' => $initialPreview,
            'initialPreviewAsData' => $initialPreviewAsData,
            'initialPreviewConfig' => $initialPreviewConfig
        ]);
    }

    /**
     * Deletes an existing Tour model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (!empty($model->images)) {
            $images = json_decode($model->images);
            foreach ($images as $img) {
                if (file_exists($img->path)) {
                    unlink($img->path);
                }
            }
        }
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tour model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tour the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tour::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
