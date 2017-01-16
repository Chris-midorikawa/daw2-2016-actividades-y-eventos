<?php

namespace app\controllers;

use Yii;
use app\models\Usuarios;
use app\models\UsuariosQuery;
use app\models\Actividades;
use app\models\ActividadQuery;
use app\models\ActividadImagenes;
use app\models\ActividadImagenesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ActividadimagenesController implements the CRUD actions for ActividadImagenes model.
 */
class ActividadimagenesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
		if( Yii::$app->user->isGuest ){
			$this->redirect(Yii::$app->request->baseURL."\site\login");
		}else{		
			if(Yii::$app->user->identity->username!="admin"){
				$u=Usuarios::findOne(Yii::$app->user->identity->id);
				if($u->rol!='A' && $u->rol!='N'){
					$this->redirect(Yii::$app->request->baseURL."\site\login");
				}
			}
		}

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
     * Lists all ActividadImagenes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActividadImagenesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ActividadImagenes model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ActividadImagenes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ActividadImagenes();
		$todos=Actividades::find()->all();
		$actividades=array();
		$u=new Usuarios();
		if(Yii::$app->user->identity->username!="admin"){
			$u=Usuarios::findOne(Yii::$app->user->identity->id);
		}else{
			$u->rol='A';
		}
		foreach($todos as $c){
			if($u->rol=='A' || ($u->rol=='N' && $u->id==$c->crea_usuario_id) )
				$actividades[$c->id]=$c->titulo;
		}


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
				'actividades' => $actividades,
            ]);
        }
    }

    /**
     * Updates an existing ActividadImagenes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$actividad = Actividades::findOne($model->actividad_id);
		$u=new Usuarios();
		if(Yii::$app->user->identity->username!="admin"){
			$u=Usuarios::findOne(Yii::$app->user->identity->id);
			if($u->id!=$actividad->crea_usuario_id){
				return $this->redirect(['index']);
			}
		}else{
			$u->rol='A';
		}
		
		$todos=Actividades::find()->all();
		$actividades=array();
		
		foreach($todos as $c){
			if($u->rol=='A' || ($u->rol=='N' && $u->id==$c->crea_usuario_id) )
				$actividades[$c->id]=$c->titulo;
			
		}
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
				'actividades' => $actividades,
            ]);
        }
    }

    /**
     * Deletes an existing ActividadImagenes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
		$actividad = Actividades::findOne($model->actividad_id);
		$u=new Usuarios();
		if(Yii::$app->user->identity->username!="admin"){
			$u=Usuarios::findOne(Yii::$app->user->identity->id);
			if($u->id!=$actividad->crea_usuario_id){
				return $this->redirect(['index']);
			}
		}else{
			$u->rol='A';
		}
		$model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ActividadImagenes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ActividadImagenes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ActividadImagenes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
