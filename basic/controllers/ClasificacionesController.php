<?php

namespace app\controllers;

use Yii;
use app\models\Usuarios;
use app\models\Etiquetas;
use app\models\Clasificaciones;
use app\models\ClasificacionesSearch;
use app\models\ClasificacionEtiquetas;
use app\models\ClasificacionEtiquetasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClasificacionesController implements the CRUD actions for Clasificaciones model.
 */
class ClasificacionesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {

        if( Yii::$app->user->isGuest )
            $this->redirect(Yii::$app->request->baseURL."\site\login");

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
     * Lists all Clasificaciones models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClasificacionesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Clasificaciones model.
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
     * Creates a new Clasificaciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Clasificaciones();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
public function actionCreaterelacion($id)
    {
        $model = new ClasificacionEtiquetas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        } else {
            $model->clasificacion_id = $id;
            $tabla=Etiquetas::find()->all();
            $existentes=ClasificacionEtiquetas::find()->where('clasificacion_id='.$id)->all();
            $etiquetas = array();
            foreach($tabla as $fila){
                $repetida = false;
                foreach ($existentes as $existente) {
                    
                    if($existente->etiqueta_id==$fila->id and $existente->clasificacion_id==$id){
                        $repetida=true;
                        break;
                    }

                }
                if(!$repetida) $etiquetas[$fila->id]=$fila->nombre;
                    
            }
             $modeloClasificacion = $this->findModel($id);

            return $this->render('createrelacion', [
                'model' => $model,
                'etiquetas' => $etiquetas,
                'nombreClasificacion' => $modeloClasificacion->nombre,
            ]);
        }
    }
    /**
     * Updates an existing Clasificaciones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
                $searchModel = new ClasificacionEtiquetasSearch();
                $params = Yii::$app->request->queryParams;
                $params['ClasificacionEtiquetasSearch']['clasificacion_id']=$id;
                $dataProvider = $searchModel->search($params);


            return $this->render('update', [
                'model' => $model,
                'dataProvider' => $dataProvider,
        ]);
           
        }
    }

    /**
     * Deletes an existing Clasificaciones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleterelacion($id)
    {
        ClasificacionEtiquetas::findOne($id)-delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Clasificaciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Clasificaciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Clasificaciones::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
