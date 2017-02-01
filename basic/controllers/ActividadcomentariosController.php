<?php

namespace app\controllers;

use Yii;

use app\models\Actividades;
use app\models\ActividadQuery;
use app\models\Usuarios;
use app\models\UsuariosQuery;
use app\models\ActividadComentarios;
use app\models\ActividadComentariosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ActividadcomentariosController implements the CRUD actions for ActividadComentarios model.
 */
class ActividadcomentariosController extends Controller
{
    /**
     * @inheritdoc
     */
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
     * Lists all ActividadComentarios models.
     * @return mixed
     */
    public function actionIndex()
    {
		if(Yii::$app->user->identity) {
		$u=Usuarios::findOne(Yii::$app->user->identity->id);
		if($u)
		{
			if($u->rol!='A' && $u->rol!='M'){
				$this->redirect(Yii::$app->request->baseURL."\site\login");
			}
		}
        $searchModel = new ActividadComentariosSearch();
     	$actividad_id="0";
		if(isset(Yii::$app->request->queryParams['ActividadComentariosSearch'])){
			 $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
			 $actividad_id=Yii::$app->request->queryParams['ActividadComentariosSearch']['actividad_id'];
		}else{
			 $dataProvider = null;
			 $todos=Actividades::find()->all();
			$actividad_id=array();
			foreach($todos as $c){
				$actividad_id[$c->id]=$c->titulo;
				
			}
		}
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'actividad_id'=>$actividad_id,
        ]);
		}
    }

    /**
     * Displays a single ActividadComentarios model.
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
     * Creates a new ActividadComentarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ActividadComentarios();
		
		if(!isset(Yii::$app->request->queryParams['actividad_id'])){
			return $this->redirect("index");
		}else{
			$model->actividad_id=Yii::$app->request->queryParams['actividad_id'];
			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				return $this->redirect(['view', 'id' => $model->id]);
			} else {
				$model->crea_usuario_id=0;
				if(!Yii::$app->user->isGuest){
					$u=Usuarios::findOne(Yii::$app->user->identity->id);
					if($u && $u->rol=="N"){
						$model->crea_usuario_id=$u->id;
					}
				}
				$model->crea_fecha=date("Y/m/d");
				$model->modi_usuario_id=0;
				$model->num_denuncias=0;
				$model->comentario_id=0;
				return $this->render('create', [
					'model' => $model,
				]);
			}
		}
    }

    /**
     * Updates an existing ActividadComentarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$model->modi_usuario_id=0;
		$model->modi_fecha=date("Y/m/d H:i:s");
		if(!Yii::$app->user->isGuest){
					$u=Usuarios::findOne(Yii::$app->user->identity->id);
					if($u && $u->rol=="N"){
						if($model->crea_usuario_id==$u->id){
							$model->modi_usuario_id=$u->id;
						}else{
							return $this->redirect(['index']);
						}
					}
					if($u && $u->rol=="M"){
						$model->modi_usuario_id=$u->id;
					}
		}		
        if ($model->load(Yii::$app->request->post()) ) {
			$viejo = $this->findModel($model->id);
			if(!$viejo->bloqueado && $model->bloqueado)$model->fecha_bloqueo=date("Y/m/d H:i:s");
			if($viejo->bloqueado && !$model->bloqueado){$model->fecha_bloqueo=null;$model->notas_bloqueo="";}
			if($viejo->num_denuncias==0 && $model->num_denuncias>0)$model->fecha_denuncia1=date("Y/m/d H:i:s");
			$model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ActividadComentarios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		if(!Yii::$app->user->isGuest){
					$u=Usuarios::findOne(Yii::$app->user->identity->id);
					if($u && ($u->rol=="N" || $u->rol=="P")){
						if($model->modi_usuario_id!=$u->id){
							
							return $this->redirect(['index']);
						}
					}
		}
        $this->findModel($id)->delete();
		
        return $this->redirect(['index']);
    }

    /**
     * Finds the ActividadComentarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ActividadComentarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ActividadComentarios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
