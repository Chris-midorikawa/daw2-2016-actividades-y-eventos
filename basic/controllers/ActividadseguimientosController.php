<?php

namespace app\controllers;

use Yii;
use app\models\Actividades;
use app\models\ActividadSeguimientos;
use app\models\ActividadSeguimientosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ActividadseguimientosController implements the CRUD actions for ActividadSeguimientos model.
 */
class ActividadseguimientosController extends Controller
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
     * Lists all ActividadSeguimientos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActividadSeguimientosSearch();
        $dataProvider = $searchModel->search(['ActividadseguimientosController'=>['usuario_id'=>Yii::$app->user->identity->id]]);
		$seguimientos=$dataProvider->getModels();
		$actividades=array();
		foreach($seguimientos as $s){
			$actividades[$s->id]=Actividades::findOne($s->actividad_id);
		}	
        return $this->render('index', [
            'seguimientos' => $seguimientos,
            'actividades' => $actividades,
        ]);
    }

    /**
     * Displays a single ActividadSeguimientos model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->redirect(Yii::$app->request->baseURL."/actividades/view?id=".$id);
    }

    /**
     * Creates a new ActividadSeguimientos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed,
	 
     */
    public function actionCreate()
    {
        $model = new ActividadSeguimientos();
		$model->fecha_seguimiento=date('Y/m/d H:i:s');
		$model->usuario_id=Yii::$app->user->identity->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
			$todos=Actividades::find()->all();
			$seguimientos=ActividadSeguimientos::find()->all();
			$actividades=array();
			foreach($todos as $c){
				$repetido = 0;
				foreach($seguimientos as $s){
					if($s->actividad_id==$c->id && $s->usuario_id==Yii::$app->user->identity->id){
						$repetido=true;
						break;
					}
				}
				if(!$repetido){
					$actividades[$c->id]=$c->titulo;
				}
			}
            return $this->render('create', [
                'model' => $model,
				'actividades'=>$actividades,
				
            ]);
        }
    }

    

    /**
     * Deletes an existing ActividadSeguimientos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ActividadSeguimientos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ActividadSeguimientos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ActividadSeguimientos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
