<?php

namespace app\controllers;

use Yii;
use app\models\Clasificaciones;
use app\models\ClasificacionesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClasificacionesController implements the CRUD actions for Clasificaciones model.
 */
class ClasificacionesController extends Controller
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
     * Lists all Clasificaciones models.
     * @return mixed
     */
    public function actionIndex()
    {
        //SE CREA UN ClasificacionesSearch PARA UTILIZAR EN LA VISTA
        $searchModel = new ClasificacionesSearch();

        //SE COMPRUEBA SI VIENE EN LA URL id
        $params = Yii::$app->request->queryParams;
        if (!isset($params['id'])) {
            $params['id'] = '';
        }
        $dataProvider = $searchModel->search(['ClasificacionesSearch'=>['id'=>$params['id']]]);
        $dataProvider->setPagination([
            'pageSize' => 10,
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Avisos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        //SE RECUPERA EL MODELO ACTUAL DE LA VISTA Y SU SEARCHMODEL
        $modelo_actual = $this->findModel($id);
        $searchModel = new ClasificacionesSearch();

        //SE CREA EL DATAPROVIDER PARA EL GRIDVIEW CON LOS AVISOS
        $dataProvider = $searchModel->search(['ClasificacionesSearch'=>['id'=>$modelo_actual->id]]);
   
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Clasificaciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        //SE CREA UN NUEVO MODELO
        $model = new Clasificaciones();

        //CASO FORMULARIO DE CREACIÓN ENVIADO (SE REDIRECCIONA A VER CLASIFICACIÓN)
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        //CASO CREACIÓN INICIAL DE LA VISTA
        } else {
            //SE GENERA LA NUEVA CLASIFICACIÓN
            $model->id;
            //SE RENDERIZA LA VISTA
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Clasificaciones model.
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
     * Finds the Avisos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Avisos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Clasificaciones::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}