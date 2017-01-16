<?php

namespace app\controllers;

use Yii;
use app\models\Etiquetas;
use app\models\EtiquetasSearch;
use app\models\Actividades;
use app\models\ActividadesQuery;
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
		}else{		
			if(Yii::$app->user->identity->username!="admin"){
				$u=Usuarios::findOne(Yii::$app->user->identity->id);
				if($u->rol!='A'){
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
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'msg'=>$msg
        ]);
    }

    /**
     * Displays a single Etiquetas model.
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
     * Creates a new Etiquetas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Etiquetas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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
     * Deletes an existing Etiquetas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
		/*$todos=Actividades::find()->all();
		foreach($todos as $c){
			if($c->clasificacion_id==$id  || $c->clasificacion_etiqueta_id==$id){
				$_SESSION['msg']="No se puede eliminar, la clasificación tiene etiquetas relacionadas";
				return $this->redirect(['index']);
			}
		}*/
    
        return $this->redirect(['index']);
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
