<?php

namespace app\controllers;

use Yii;
use app\models\Actividades;
use app\models\Usuarios;
use app\models\ActividadParticipantes;
use app\models\ActividadParticipantesSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ActividadParticipantesController implements the CRUD actions for ActividadParticipantes model.
 */
class ActividadParticipantesController extends Controller
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
     * Lists all ActividadParticipantes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActividadParticipantesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ActividadParticipantes model.
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
     * Creates a new ActividadParticipantes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ActividadParticipantes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ActividadParticipantes model.
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
     * Deletes an existing ActividadParticipantes model.
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
     * Finds the ActividadParticipantes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ActividadParticipantes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ActividadParticipantes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionAddParticipante($id_actividad)
    {
        $modeloActividad = Actividades::find()->where(['id' => $id_actividad])->one();
        $modeloParticipante = new ActividadParticipantes();
        $modeloParticipante->actividad_id = $id_actividad;
        $modeloParticipante->fecha_cancelacion = date("Y-m-d H:i:s");
        $modeloParticipante->notas_cancelacion = NULL;
        $listaUsuarios = ArrayHelper::map(Usuarios::find()->all(), 'id', 'nombre');
        

        if ($modeloParticipante->load(Yii::$app->request->post()))
        {
            //Caso en que ya exista una fila en la tabla con ese id
            if (ActividadParticipantes::find()->where(["id" => $modeloParticipante->id])->one()){
                $modeloParticipante->id = null;
                $error = "Id ya existente";
                Yii::$app->getSession()->setFlash("error_add_participante", $error);
                return $this->render('add_participante', [
                    'modeloActividad' => $modeloActividad,
                    'modeloParticipante' => $modeloParticipante,
                    'listaUsuarios' => $listaUsuarios,
                    'error' => true,
                ]);
            }

            //Caso en que ya exista una relación entre ese usuario y esa actividad
            if (ActividadParticipantes::find()->where(["usuario_id" => $modeloParticipante->usuario_id,
                    "actividad_id" => $modeloParticipante->actividad_id])->one()){
               $modeloParticipante->id = null;
                $error = "Relación ya existente";
                Yii::$app->getSession()->setFlash("error_add_participante", $error);
                return $this->render('add_participante', [
                    'modeloActividad' => $modeloActividad,
                    'modeloParticipante' => $modeloParticipante,
                    'listaUsuarios' => $listaUsuarios,
                    'error' => true,
                ]);
            }

        $modeloParticipante->save();
        return $this->redirect(['/actividades/view', 'id' => $modeloParticipante->actividad_id]);
        }

        return $this->render('add_participante', [
                'modeloActividad' => $modeloActividad,
                'modeloParticipante' => $modeloParticipante,
                'listaUsuarios' => $listaUsuarios,
        ]);
    }
}
