<?php

namespace app\controllers;

use Yii;
use app\models\Etiquetas;
use app\models\EtiquetasSearch;
use app\models\Usuarios;
use app\models\UsuarioAvisos;
use app\models\ActividadEtiquetas;
use app\models\ActividadEtiquetasQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EtiquetasController implements the CRUD actions for Etiquetas model.
 */
class EtiquetasController extends Controller
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
     * Lists all Etiquetas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EtiquetasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$msg="";
		if(isset($_SESSION['msg'])){
			$msg=$_SESSION['msg'];
			unset($_SESSION['msg']);
		}
		$rol='A';
		if(Yii::$app->user->identity){
			$u=Usuarios::findOne(Yii::$app->user->identity->id);
			if($u){
				$rol=$u->rol;
			}
		}
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'msg'=>$msg,
			'rol'=>$rol,
        ]);
    }


    /**
     * Creates a new Etiquetas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Etiquetas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			$aviso=new UsuarioAvisos();
			$aviso->fecha=date("Y/m/d");
			$aviso->clase_aviso_id='N';
			$aviso->texto="Nueva etiqueta creada ".$model->id." ".$model->nombre;
			$aviso->destino_usuario_id=0;
			$aviso->origen_usuario_id=0;
			if(Yii::$app->user->identity){
				$u=Usuarios::findOne(Yii::$app->user->identity->id);
				if($u){
					$aviso->origen_usuario_id=$u->id;
				}
			}
			$aviso->save();
             return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Etiquetas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
		if(Yii::$app->user->identity){
			$u=Usuarios::findOne(Yii::$app->user->identity->id);
			if($u){
				if($u->rol!='A') $this->redirect(Yii::$app->request->baseURL."\site\login");
			}
		}
		
        $model = $this->findModel($id);
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
			$etiquetas = Etiquetas::find()->all();
			$todas = array();
			foreach($etiquetas as $e){
				if($e->id!=$id)
					$todas[$e->id]=$e->nombre;
			}
            return $this->render('update', [
                'model' => $model,
				'todas' => $todas
            ]);
        }
    }
	public function actionUnifica($id)
    {
		
		if(Yii::$app->user->identity){
			$u=Usuarios::findOne(Yii::$app->user->identity->id);
			if($u){
				if($u->rol!='A') $this->redirect(Yii::$app->request->baseURL."\site\login");
			}
		}
        $searchModel = new EtiquetasSearch();
        $dataProvider = $searchModel->search([]);
		$relaciones=ActividadEtiquetas::find()->all();
		foreach($relaciones as $relacion){
			if($relacion->etiqueta_id==Yii::$app->request->queryParams['iduni']){
				$relacion->etiqueta_id=Yii::$app->request->queryParams['id'];
				$relacion->save();
			}
		}
		$this->findModel(Yii::$app->request->queryParams['iduni'])->delete();
		$msg="etiquetas unificadas";
		
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Etiquetas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		if(Yii::$app->user->identity){
			$u=Usuarios::findOne(Yii::$app->user->identity->id);
			if($u){
				if($u->rol!='A') $this->redirect(Yii::$app->request->baseURL."\site\login");
			}
		}
		$todos=ActividadEtiquetas::find()->all();
		$sepuede=true;
		foreach($todos as $c){
			if($c->etiqueta_id==$id){
				$sepuede=false;
				
			}
		}
		if($sepuede){
			$this->findModel($id)->delete();
			return $this->redirect(['index']);
		}else{
			$_SESSION['msg']="No se puede eliminar, la etiqueta tiene actividades relacionadas";
				return $this->redirect(['index']);
		}
   
    }

    /**
     * Finds the Etiquetas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Etiquetas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Etiquetas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
