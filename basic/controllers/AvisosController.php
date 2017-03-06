<?php

namespace app\controllers;

use Yii;

use app\models\Usuarios;
use app\models\Avisos;
use app\models\AvisosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AvisosController implements the CRUD actions for Avisos model.
 */
class AvisosController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        //si es un usuario invitado sera redirigido al login
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
     * Lists all Avisos models.
     * @return mixed
     */
    public function actionIndex()
    {
        //SE CREA UN AvisosSearch PARA UTILIZAR EN LA VISTA
        $searchModel = new AvisosSearch();

        //SE COMPRUEBA SI VIENE EN LA URL clase_aviso_id PARA SABER QUE PROFUNDIDAD MOSTRAR (Aviso, Notificación, etc)
        $params = Yii::$app->request->queryParams;
        if (!isset($params['clase_aviso_id'])) {
            $params['clase_aviso_id'] = 'A';
        }

        //filtro para que solo aparezcan los avisos del usuario que tiene iniciada sesion 
        $params['destino_usuario_id'] = Yii::$app->user->identity->id;
        $dataProvider = $searchModel->searchRecibidos($params);
        $dataProvider->setPagination([
            'pageSize' => 5,
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Avisos model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
     $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {

            $post = Yii::$app->request->post();

            if(isset($post['noleido'])) {
                $model->fecha_lectura=null;
            }

            if(isset($post['aceptado'])) {

                $model->fecha_aceptado=date("Y/m/d H:i:s");

                if($model->destino_usuario_id == null) {
                    $model->destino_usuario_id = Yii::$app->user->identity->id;
                }
            }

            if(isset($post['borrar'])) {
                $model->fecha_borrado=date("Y/m/d H:i:s");    
            }
            $model->save();
            return $this->redirect(['index']);
        }
        else
        {
            if($model->fecha_lectura==null) {
                $model->fecha_lectura= date("Y/m/d H:i:s");
                $model->save();
            }
            return $this->render('update', [
                'model' => $model,
                'usuarios' => $this->vistaUsuarios(),
            ]);
        }
    }

    //funcion para mostrar todos los usuarios
    public function vistaUsuarios()
    {
            $filas = Usuarios::find()->all();
            $usuarios = array();
            $usuarios["0"]= "Para todos";
            foreach ($filas as $fila) {
                $usuarios[$fila->id]=$fila->nick;
            }
            return $usuarios;
    }

    /**
     * Creates a new Avisos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        //SE CREA UN NUEVO MODELO
        $model = new Avisos();

        //CASO FORMULARIO DE CREACIÓN ENVIADO (SE REDIRECCIONA A VER ÁREA)
        if ($model->load(Yii::$app->request->post()) ) {
            $model->fecha = date("Y/m/d H:i:s");
            $model->origen_usuario_id = Yii::$app->user->identity->id;
            $model->destino_usuario_id = $model->destino_usuario_id==0 ? null : $model->destino_usuario_id;
            $model->actividad_id = null;
            $model->comentario_id = null;
            $model->fecha_lectura = null;
            $model->fecha_borrado = null;
            $model->fecha_aceptado = null;
            if($model->save() )
                       return $this->redirect(['index']);
            else{
                var_dump($model);
            }
        //CASO CREACIÓN INICIAL DE LA VISTA
        } else {
            //SE GENERA EL NUEVO ÁREA ID
            return $this->render('create', [
                'model' => $model,
                'usuarios' => $this->vistaUsuarios(),
            ]);
        }
    }

    /**
     * Updates an existing Avisos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {

            $post = Yii::$app->request->post();

            if(isset($post['noleido'])) {
                $model->fecha_lectura=null;
            }

            if(isset($post['aceptado'])) {
                
                $model->fecha_aceptado=date("Y/m/d H:i:s");
                
                if($model->destino_usuario_id == null) {
                    $model->destino_usuario_id = Yii::$app->user->identity->id;
                }
            }

            if(isset($post['borrar'])) {
                $model->fecha_borrado=date("Y/m/d H:i:s");
            }
            $model->save();
            return $this->redirect(['index']);
        }
        else 
        {
            if($model->fecha_lectura==null) {
                $model->fecha_lectura= date("Y/m/d H:i:s");
                $model->save();
            }
            return $this->render('update', [
                'model' => $model,
                'usuarios' => $this->vistaUsuarios(),
            ]);
        }
    }

    /**
     * Deletes an existing Avisos model.
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
     * Finds the Avisos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Avisos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Avisos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
