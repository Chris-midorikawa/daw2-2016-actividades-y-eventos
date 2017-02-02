<?php

namespace app\controllers;

use Yii;
use app\models\ActividadEtiquetas;
use app\models\ActividadEtiquetasSearch;
use app\models\Actividades;
use app\models\Etiquetas;
use app\models\EtiquetasQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ActividadetiquetasController implements the CRUD actions for ActividadEtiquetas model.
 */
class ActividadetiquetasController extends Controller
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
     * Lists all ActividadEtiquetas models.
     * @return mixed
     */
    public function actionIndex()
    {
		
        $searchModel = new ActividadEtiquetasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		//obtengo la lista de actividades etiquetas como array porque no voy a utilizar el Grid
		$lista = ActividadEtiquetas::find()->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'lista'=> $lista
        ]);
    }

   
    /**
     * Creates a new ActividadEtiquetas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		$this->compruebaUsuario();
        $model = new ActividadEtiquetas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

  
    /**
     * Deletes an existing ActividadEtiquetas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		if($this->compruebaUsuario()){
			$this->findModel($id)->delete();
			return $this->redirect(['index']);
		}
        

        
    }

    /**
     * Finds the ActividadEtiquetas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ActividadEtiquetas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ActividadEtiquetas::findOne($id)) !== null) {
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
		}
		return true;
	}
}
