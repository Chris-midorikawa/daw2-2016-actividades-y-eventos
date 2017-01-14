<?php

namespace app\controllers;

use app\models\Areas;
use app\models\Usuarios;
use Yii;
use app\models\UsuariosAreaModeracion;
use app\models\UsuariosAreaModeracionSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsuariosAreaModeracionController implements the CRUD actions for UsuariosAreaModeracion model.
 */
class UsuariosAreaModeracionController extends Controller
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
     * Lists all UsuariosAreaModeracion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuariosAreaModeracionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UsuariosAreaModeracion model.
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
     * Creates a new UsuariosAreaModeracion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UsuariosAreaModeracion();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UsuariosAreaModeracion model.
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


    public function actionAddModerador($id_area)
    {
        $modelo_usuario_area = new UsuariosAreaModeracion();
        $modelo_area = Areas::find()->where(['id' => $id_area])->one();
        $modelo_usuario_area->area_id = $modelo_area->id;
        $usuarios = ArrayHelper::map(Usuarios::find()->all(), 'id', 'nombre');

        if ($modelo_usuario_area->load(Yii::$app->request->post())){
            //Caso en que ya exista una fila en la tabla con ese id
            if (UsuariosAreaModeracion::find()->where(["id" => $modelo_usuario_area->id])->one()){
                $modelo_usuario_area->id = null;
                $error = "Id ya existente";
                Yii::$app->getSession()->setFlash("error_add_moderador", $error);
                return $this->render('add_moderador', [
                    'modelo_area' => $modelo_area,
                    'modelo_usuario_area' => $modelo_usuario_area,
                    'usuarios' => $usuarios,
                    'error' => true,
                ]);
            }

            //Caso en que ya exista una relación entre ese usuario y ese área
            if (UsuariosAreaModeracion::find()->where(["usuario_id" => $modelo_usuario_area->usuario_id,
                    "area_id" => $modelo_usuario_area->area_id])->one()){
                $modelo_usuario_area->id = null;
                $error = "Relación ya existente";
                Yii::$app->getSession()->setFlash("error_add_moderador", $error);
                return $this->render('add_moderador', [
                    'modelo_area' => $modelo_area,
                    'modelo_usuario_area' => $modelo_usuario_area,
                    'usuarios' => $usuarios,
                    'error' => true,
                ]);
            }

            $modelo_usuario_area->save();
            return $this->redirect(['/areas/view', 'id' => $modelo_area->id]);
        }
        return $this->render('add_moderador', [
            'modelo_area' => $modelo_area,
            'modelo_usuario_area' => $modelo_usuario_area,
            'usuarios' => $usuarios,
        ]);
    }


    /**
     * Deletes an existing UsuariosAreaModeracion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id, $id_area)
    {
        $this->findModel($id)->delete();
        //ARREGLAR REDIRECT!!!!!!!
        return $this->redirect(['/areas/view', 'id' => $id_area]);
    }

    /**
     * Finds the UsuariosAreaModeracion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return UsuariosAreaModeracion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UsuariosAreaModeracion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



}
