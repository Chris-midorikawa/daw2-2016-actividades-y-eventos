<?php

namespace app\controllers;

use app\models\Actividades;
use app\models\ActividadesSearch;
use app\models\ActividadParticipantesSearch;
use app\models\Usuarios;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ActividadesController implements the CRUD actions for Actividades model.
 */
class ActividadesController extends Controller
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
     * Lists all Actividades models.
     * @return mixed
     */
    public function actionIndex()
    {
		$searchModel = new ActividadesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		//$rol=$this->compruebaUsuario();
		//--if($rol=='A'){
		if(Usuarios::isAdmin()){
			$dataProvider=$searchModel->search("");
		}else{
			$dataProvider = $searchModel->search(['ActividadesSearch'=>['crea_usuario_id'=>Yii::$app->user->identity->id]]);
		}
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Actividades model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
    //Cosas necesarias para motrar los participantes de actividad (vista de actividad-participantes)
 	
		$modeloActual = $this->findModel($id);	
 	    $searchModelActividadParticipantes = new ActividadParticipantesSearch();
        $dataProviderParticipantes = $searchModelActividadParticipantes->search(['ActividadParticipantesSearch' =>['actividad_id' => $modeloActual->id]]);
 		
		$rol=$this->compruebaUsuario();
		if($rol=='A' || $modeloActual->crea_usuario_id==Yii::$app->user->identity->id){
			return $this->render('view', [
            'model' => $modeloActual,
            'dataProviderParticipantes' => $dataProviderParticipantes,
			]);
		}else{
			$this->redirect(Yii::$app->request->baseURL."\site\login");
		}
    }

    /**
     * Creates a new Actividades model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		$this->compruebaUsuario();
        $model = new Actividades();
		

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Actividades model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
		$model =$this->findModel($id);
		$rol=$this->compruebaUsuario();
		if($rol=='A' || $model->crea_usuario_id==Yii::$app->user->identity->id){
			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				return $this->redirect(['view', 'id' => $model->id]);
			} else {
				return $this->render('update', [
					'model' => $model,
				]);
			}
		}else{
			$this->redirect(Yii::$app->request->baseURL."\site\login");
		}
		 
    }

    /**
     * Deletes an existing Actividades model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		$model =$this->findModel($id);
		$rol=$this->compruebaUsuario();
		if($rol=='A' || $model->crea_usuario_id==Yii::$app->user->identity->id){
            $this->$model->delete();
        }
		return $this->redirect(['index']);
    }

    /**
     * Finds the Actividades model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Actividades the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Actividades::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	protected function compruebaUsuario()
	{
		if(Yii::$app->user->isGuest)
		{
			$this->redirect(Yii::$app->request->baseURL."\site\login");
			return false;
			
		}else{
			$usuario=Usuarios::findOne(Yii::$app->user->identity->id);
			if($usuario)
			{
				if($usuario->rol!='A'){
					return 'N';
				}
			}
		}
		return 'A';
	}
}
