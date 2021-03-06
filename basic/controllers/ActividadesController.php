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
use app\models\ActividadImagenes;
use app\models\ActividadImagenesSearch;
use app\models\ActividadComentarios;
use app\models\ActividadComentariosSearch;


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
	
	/*** GRUPO3 - NO BORRAR
	Pieza pública de visualización del formulario de Búsqueda detallada de Actividades. 
	Acción para el Filtrado de resultados por los datos introducidos en la búsqueda y 
	mostrar los resultados usando la pieza realizada de la lista de Actividades con 
	"ficha resumida".
	****/
	
	
	public function actionBusqueda()
    {
		$resultado=array();
		$modelo = new Actividades();
		if(isset(Yii::$app->request->queryparams['Actividades'])){
			$searchModel = new ActividadesSearch();
			$dataProvider=$searchModel->search(Yii::$app->request->queryparams);
			$resultado= $dataProvider->getModels();
		}
			
			return $this->render('buscar', [
            'resultado' => $resultado,
			'modelo'=>$modelo,
			]);
		
    }
	
	/***
	FIN-GRUPO3
	**/

    /**
     * Lists all Actividades models.
     * @return mixed
     */
    public function actionIndex()
    {
		$searchModel = new ActividadesSearch();
        //$rol=$this->compruebaUsuario();
		//--if($rol=='A'){
		if(Usuarios::isAdmin()){
			//realiza la búsqueda si tenemos parámetros en el get, sino muestra todos
			$dataProvider=$searchModel->search(Yii::$app->request->queryparams);
			return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'template' => '{view}{update}{delete}',
			]);
		}else{ if(!Yii::$app->user->isGuest){
			//no busca por el get, directamente muestra solo las actividades creadas por el usuario no admin logueado 
		$dataProvider = $searchModel->search(['ActividadesSearch'=>['crea_usuario_id'=>Yii::$app->user->identity->id]]);
				return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				'template' => '{view}{update}{delete}',
						]);
						
				}else{
					//no logueados, al index publico
					return $this->redirect(['indexpublico']);
				}
		}
        
    }
	public function actionIndexpublico()
    {
		$searchModel = new ActividadesSearch();
		//no busca por el get, busca las visibles no bloqueadas
			$dataProvider = $searchModel->search(['ActividadesSearch'=>['visible'=>1,'bloqueada'=>0]]);
				return $this->render('indexpublica', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				'template' => '{view}',]);
			
        
    }

    

    /**
     * Displays a single Actividades model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
    //Cosas necesarias para motrar los participantes de actividad (vista de actividad-participantes)
	//mostrará la view pública si el usuario no está logueado o si se viene del botón de ficha pública, que añade al get el parámetro pública
 	
		$modeloActual = $this->findModel($id);	
 	    $searchModelActividadParticipantes = new ActividadParticipantesSearch();
        $dataProviderParticipantes = $searchModelActividadParticipantes->search(['ActividadParticipantesSearch' =>['actividad_id' => $modeloActual->id]]);
 		
		$rol=$this->compruebaUsuario();
		if(Yii::$app->user->isGuest || isset($_GET['publica'])){
			//buscamos las imágenes por actividad
			$searchModel = new ActividadImagenesSearch();
			$dataProvider = $searchModel->search(['ActividadImagenesSearch'=>['actividad_id'=>$id]]);
			$imagenes = $dataProvider->getModels();
			//buscamos los comentarios por actividad
			$searchModel = new ActividadComentariosSearch();
			$dataProvider = $searchModel->search(['ActividadComentariosSearch'=>['actividad_id'=>$id]]);
			$comentarios = $dataProvider->getModels();
			return $this->render('viewpublica', [
				'model' => $modeloActual,
				'imagenes'=>$imagenes,
				'comentarios'=>$comentarios,
				]);
		
			
		}else{	if($rol=='A' || $modeloActual->crea_usuario_id==Yii::$app->user->identity->id){
			//se ven los datos de la tabla actividades
					return $this->render('view', [
					'model' => $modeloActual,
					'dataProviderParticipantes' => $dataProviderParticipantes,
					]);
			}else{
				$this->redirect(Yii::$app->request->baseURL."\site\login");
			}
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
		//crea una actividad después de comprobar el usuario

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
		//cargo los datos en dos modelos para, si vengo del formulario, poder comparar los datos anteriores con los nuevos
		$antes =$this->findModel($id);
		$model= $this->findModel($id);
		$rol=$this->compruebaUsuario();
		if($rol=='A' || $antes->crea_usuario_id==Yii::$app->user->identity->id){
			if ($model->load(Yii::$app->request->post())) {
				if(!$antes->bloqueada && $model->bloqueada){
					$model->fecha_bloqueo=date('Y/m/d H:i:s');
				}
				$model->save();
				return $this->redirect(['view', 'id' => $model->id]);
			} else {//al mostrar el formulario, le paso a la vista el rol para que muestre el update de admin o el de los demás
				return $this->render('update', [
					'model' => $antes,'rol'=>$rol,
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
	 
	 public function actionDenunciar($id)
    {
		$model =$this->findModel($id);
		$model->num_denuncias++;
		if($model->num_denuncias==1){
			$model->fecha_denuncia1=date('Y/m/d H:i:s');
		}
		
			$model->save();
				return $this->redirect(['view', 'id' => $model->id,'publica'=>1]);
			
		
		 
    }
	public function actionDenunciacomentario($id,$comentario_id)
    {
		$model =ActividadComentarios::findOne($comentario_id);
		$model->num_denuncias++;
		if($model->num_denuncias==1){
			$model->fecha_denuncia1=date('Y/m/d H:i:s');
		}
		
			$model->save();
				return $this->redirect(['view', 'id' => $id,'publica'=>1]);
			
		
		 
    }
	public function actionVotarok($id)
    {
		$model =$this->findModel($id);
		$model->votosOK++;
		
			$model->save();
				return $this->redirect(['view', 'id' => $model->id,'publica'=>1]);
			
		
		 
    }
	public function actionVotarko($id)
    {
		$model =$this->findModel($id);
		$model->votosKO++;
		
			$model->save();
				return $this->redirect(['view', 'id' => $model->id,'publica'=>1]);
			
		
		 
    }

	 
    public function actionDelete($id)
    {
		$model =$this->findModel($id);
		$rol=$this->compruebaUsuario();
		if($rol=='A' || $model->crea_usuario_id==Yii::$app->user->identity->id){
            $model->delete();
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
		//si  no está logueado devuelve falso y redirige al loguin
		if(Yii::$app->user->isGuest)
		{
			$this->redirect(Yii::$app->request->baseURL."\site\login");
			return false;
			
		}else{
			//si está logueado, con el modelo de Usuarios busca el usuario y devuelve el rol
			//en el caso de que el usuario no esté en la base de datos, es un usuario de prueba y devuelve administrador
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
