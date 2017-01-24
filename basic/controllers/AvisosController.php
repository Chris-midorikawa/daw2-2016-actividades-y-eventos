<?php

namespace app\controllers;

use Yii;
use app\models\Avisos;
use app\models\AvisosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AvisosController implements the CRUD actions for Avisos model.
 */
class AvisosController extends Controller
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
     * Lists all Avisos models.
     * @return mixed
     */
    public function actionIndex()
    {
        //SE CREA UN AvisosSearch PARA UTILIZAR EN LA VISTA
        $searchModel = new AvisosSearch();

        //SE COMPRUEBA SI VIENE EN LA URL clase_aviso_id PARA SABER QUE PROFUNDIDAD MOSTRAR (Aviso, Notificación, etc)
        $params = Yii::$app->request->queryParams;
        if (!isset($params['clase_aviso_id'])) {
            $params['clase_aviso_id'] = 'A';
        }
        $dataProvider = $searchModel->search(['AvisosSearch'=>['clase_aviso_id'=>$params['clase_aviso_id']]]);
        $dataProvider->setPagination([
            'pageSize' => 5,
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
        $searchModel = new AvisosSearch();

        //SE CREA EL DATAPROVIDER PARA EL GRIDVIEW CON LOS AVISOS
        $dataProvider = $searchModel->search(['AvisosSearch'=>['clase_aviso_id'=>$modelo_actual->id]]);

        //SE CREA EL BREADCRUMB A MOSTRAR EN LA VISTA
        $breadcrumb_actual = $modelo_actual->ClaseAvisoInstancia;

        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'breadcrumb_actual' => $breadcrumb_actual,
        ]);
    }

    /**
     * Creates a new Avisos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        //SE CREA UN NUEVO MODELO
        $model = new Avisos();

        //CASO FORMULARIO DE CREACIÓN ENVIADO (SE REDIRECCIONA A VER ÁREA)
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        //CASO CREACIÓN INICIAL DE LA VISTA
        } else {
            //SE GENERA EL NUEVO ÁREA ID
            $model->id;
            //SE RENDERIZA LA VISTA
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

        //SE CREA EL BREADCRUMB
        $breadcrumb_actual = $model->ClaseAvisoInstancia;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'breadcrumb_actual' => $breadcrumb_actual,
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
        if (($model = Avisos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
