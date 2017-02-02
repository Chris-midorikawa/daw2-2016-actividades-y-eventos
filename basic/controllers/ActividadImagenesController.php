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
    //se realiza lo primero de todo, redirige a login a los no registrados
    public function behaviors()
    {
		if( Yii::$app->user->isGuest ){
			$this->redirect(Yii::$app->request->baseURL."\site\login");
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
		if(Yii::$app->user->identity){
			$searchModel = new ActividadImagenesSearch();
			$u=Usuarios::findOne(Yii::$app->user->identity->id);
			if($u)
			{
				if($u->rol!='A'){//solo los administradores puede acceder a la vista global de imagenes
					$this->redirect(Yii::$app->request->baseURL."\site\login");
				}
			}
			
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
			 return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]);
		}
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
		if(Yii::$app->user->identity){
        $model = new ActividadImagenes();
		$todos=Actividades::find()->all();
		$actividades=array();
		$u=Usuarios::findOne(Yii::$app->user->identity->id);
		if(!$u)
		{
			$u= new Usuarios();
			$u->rol='A';
		}
		foreach($todos as $c){
			if($u->rol=='A' || ($u->rol=='N' && $u->id==$c->crea_usuario_id) )//si el usuario es admin, moderador o ha creado esa actividad
				$actividades[$c->id]=$c->titulo;//incluir el titulo de la actividad
		}

        //redirigir a la vista de ver si recibe datos, sino a la vista crear
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [//se llama a crear con la lista de actividades que tiene acceso ese usuaario
                //todas si son admin o mod, y las propietaria en caso de usuario normal (bucle foreach)
                'model' => $model,
				'actividades' => $actividades,
            ]);
        }}
    }

    /**
     * Updates an existing ActividadImagenes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
		if(Yii::$app->user->identity){
        $model = $this->findModel($id);
		$actividad = Actividades::findOne($model->actividad_id);
		$u=new Usuarios();
		if(Yii::$app->user->identity->username!="admin"){
			$u=Usuarios::findOne(Yii::$app->user->identity->id);
			if($u->id!=$actividad->crea_usuario_id){//si el usuario no es el que creo la actividad, redirigir a index
				return $this->redirect(['index']);
			}
		}else{
			$u->rol='A';
		}
		
		$todos=Actividades::find()->all();
		$actividades=array();//array para almacenar los titulos de las actividades
		
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
        }}
    }

    /**
     * Deletes an existing ActividadImagenes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */

    //solo pueden eliminar los admin o el usuario que ha creado esa actividad
    public function actionDelete($id)
    {
		if(Yii::$app->user->identity){
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
		}
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
