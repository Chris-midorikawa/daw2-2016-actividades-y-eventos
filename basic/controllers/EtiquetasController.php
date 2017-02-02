<?php

namespace app\controllers;

use Yii;
use app\models\Actividades;
use app\models\Etiquetas;
use app\models\EtiquetasSearch;
use app\models\ActividadEtiquetas;
use app\models\ActividadetiquetasSearch;
use app\models\Usuarios;
use app\models\UsuarioAvisos;
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
		if( Yii::$app->user->isGuest ){//redirigir a busqueda si el usuario no ha realizado login
			$this->redirect(['busqueda']);
		}
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
		//llamamos a la vista index con los datos obtenidos
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'msg'=>$msg,
			'rol'=>$rol,
        ]);
    }

public function actionBusqueda()
    {
		 
        $datos = null;
		$post=Yii::$app->request->post();

		//se realiza las busquedas si recibimos datos por POST
        if (isset($post['Etiquetas']['id'])){
			
		 $searchModel = new ActividadEtiquetasSearch();
		 //se rellena la estructura de datos con los datos de las etiquetas y sus actividades relacionadas
			$dataProvider = $searchModel->search(['ActividadEtiquetasSearch'=>['etiqueta_id'=>$post['Etiquetas']['id']]]);
			$relaciones=$dataProvider->getModels();
			$datos=array();
			foreach($relaciones as $r){
				//se recorren todos los datos obteniendo las id de las actividades
				  $model = Actividades::findOne($r->actividad_id);
				  $datos[$model->id]=$model;
			}
			
		}
		//se envian a la vista buscar el array datos que contiene las ids de las etiquetas y las actividades
			return $this->render('buscar', ['datos'=>$datos,
           ]);
		
		
       
		
        
    }
    /**
     * Creates a new Etiquetas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		if( Yii::$app->user->isGuest ){//redirigir a login si no ha hecho login
			$this->redirect(Yii::$app->request->baseURL."\site\login");
		}
        $model = new Etiquetas();

//se intenta cargar los datos de post y guardarlos en el modelo de datos
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	//se crea un aviso en el sistema de avisos con la fecha, la id de la etiqueta y la id del
        	//usuario que la ha creado
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
			$aviso->save();//confirmar el guardado del aiso y redirigir a index
             return $this->redirect(['index']);
        } else {//si aun n ha recibido datos por post redirigir a a la vista de creacion
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
		if( Yii::$app->user->isGuest ){//invitados a la pagina de login
			$this->redirect(Yii::$app->request->baseURL."\site\login");
		}
		if(Yii::$app->user->identity){
			$u=Usuarios::findOne(Yii::$app->user->identity->id);
			if($u){//si el usuario no tiene permisos de administrador redirigir a login
				if($u->rol!='A') $this->redirect(Yii::$app->request->baseURL."\site\login");
			}
		}
		
        $model = $this->findModel($id);
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	//redirigir a index si recibe datos por post
            return $this->redirect(['index']);
        } else {//al no recibirlos mostrar todas las etiquetas
			$etiquetas = Etiquetas::find()->all();
			$todas = array();
			foreach($etiquetas as $e){
				if($e->id!=$id)
					$todas[$e->id]=$e->nombre;
			}
			//llamar a la vista update on el array de las etiquetas
            return $this->render('update', [
                'model' => $model,
				'todas' => $todas
            ]);
        }
    }

    //esta accion unifica des etiquetas
    //elimina una segunda etiqueta y mueve las relaciones que tiene a la
    //primera etiqueta
	public function actionUnifica($id)
    {
		if( Yii::$app->user->isGuest ){
			$this->redirect(Yii::$app->request->baseURL."\site\login");
		}
		if(Yii::$app->user->identity){
			$u=Usuarios::findOne(Yii::$app->user->identity->id);
			if($u){
				if($u->rol!='A') $this->redirect(Yii::$app->request->baseURL."\site\login");
			}
		}
		//se encuentran todas las relaciones de etiquetas y actividades y todas las etiquetas
        $searchModel = new EtiquetasSearch();
        $dataProvider = $searchModel->search([]);
		$relaciones=ActividadEtiquetas::find()->all();
		foreach($relaciones as $relacion){//cambiar la relacion de la etiqueta unificada 
			if($relacion->etiqueta_id==Yii::$app->request->queryParams['iduni']){
				$relacion->etiqueta_id=Yii::$app->request->queryParams['id'];
				$relacion->save();//confirmar los cambios
			}
		}
		//eliminar la etiqueta unificada despues de cambiar su relacion
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
		if( Yii::$app->user->isGuest ){
			$this->redirect(Yii::$app->request->baseURL."\site\login");
		}
		if(Yii::$app->user->identity){
			$u=Usuarios::findOne(Yii::$app->user->identity->id);
			if($u){//solo pueden eliminar etiquetas los administradores
				if($u->rol!='A') $this->redirect(Yii::$app->request->baseURL."\site\login");
			}
		}
		$todos=ActividadEtiquetas::find()->all();//se almacenan todas las etiquetas relacionadas con
		//una actividad
		$sepuede=true;
		foreach($todos as $c){
			if($c->etiqueta_id==$id){
				//si encuentra una etiqueta en todos, es que esta relacionada
				//no s epuede eliminar al estar relacionada
				$sepuede=false;
				
			}
		}
		if($sepuede){//se procede al borrado si no ha encontrado coincidencias
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
