<?php

namespace app\controllers;

use Yii;
use app\models\Areas;
use app\models\AreasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AreasController implements the CRUD actions for Areas model.
 */
class AreasController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Areas models.
     * @return mixed
     */
    public function actionIndex()
    {
        //SE CREA UN AreasSearch PARA UTILIZAR EN LA VISTA
        $searchModel = new AreasSearch();

        //SE COMPRUEBA SI VIENE EN LA URL clase_area_id PARA SABER QUE PROFUNDIDAD MOSTRAR (País, Región, etc)
        $params = Yii::$app->request->queryParams;
        if (!isset($params['clase_area_id'])) {
            $params['clase_area_id'] = 1;
        }
        $dataProvider = $searchModel->search(['AreasSearch'=>['clase_area_id'=>$params['clase_area_id']]]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Areas model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        //SE RECUPERA EL MODELO ACTUAL DE LA VISTA Y SU SEARCHMODEL
        $modelo_actual = $this->findModel($id);
        $searchModel = new AreasSearch();

        //SE CREA EL DATAPROVIDER PARA EL GRIDVIEW CON LOS "HIJOS" DEL ÁREA
        $dataProvider = $searchModel->search(['AreasSearch'=>['area_id'=>$modelo_actual->id]]);

        //SE CREA EL BREADCRUMB A MOSTRAR EN LA VISTA CON LA CADENA DE "PADRES"
        $breadcrumb_actual = $modelo_actual->areasPadres;

        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'breadcrumb_actual' => $breadcrumb_actual,
        ]);
    }

    /**
     * Creates a new Areas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Areas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Areas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Areas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Areas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Areas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Areas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
