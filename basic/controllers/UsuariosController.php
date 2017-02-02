<?php

namespace app\controllers;

use Yii;
use app\models\Usuarios;
use app\models\UsuariosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsuariosController implements the CRUD actions for Usuarios model.
 */
class UsuariosController extends Controller
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
     * Lists all Usuarios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuariosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //al index de usuarios solo accederá los admin. Se hará con el isadmin
        /*if (Yii::$app->user->isGuest || Yii::$app->user->identity->username!='admin'){      
            $this->goHome();
        }
        else 
        {*/
	        return $this->render('index', [
	            'searchModel' => $searchModel,
	            'dataProvider' => $dataProvider,
	        ]);
	        /*
    	}
    	*/
    }


    /**
     * Displays a single Usuarios model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
    	//vista diferente para usuario normal o usuario admin. Con el isadmin
    	if (Yii::$app->user->identity->username!='admin')
    	{  
	        return $this->render('vistanormal', [
	            'model' => $this->findModel($id),]);
    	}
    	else
    	{
    		return $this->render('vistaadmin', [
	            'model' => $this->findModel($id),]);
    	}
    }

    /**
     * Creates a new Usuarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Usuarios();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
 		return $this->render('regok');
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    //funcion para el portal, que será diferente según sea usuario normal o admin
    public function actionPortal()
    {

    	//si es usuario normal. Comprobar con el isadmin
    	if ( Yii::$app->user->identity->username!='admin')
    	{
			return $this->render('portalnormal');
		}
		//si es admin
		else
		{
			return $this->render('portaladmin');
		}
    }
 
  

    /**
     * Updates an existing Usuarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
        	//muestra diferentes vistas. con el isadmin
        	if (Yii::$app->user->identity->username!='admin')
        	{
			return $this->redirect(['view', 'id' => $model->id]);
			}
			else
			{
				return $this->redirect(['view', 'id' => $model->id]);
			}
        } 
        else 
        {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Usuarios model.
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
     * Finds the Usuarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Usuarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuarios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /* Acción  utilizada para mostrar el perfil de un usuario*/
    public function actionMostrarPerfil($id_usuario, $active_tab="tab_datos"){

            $modelo_usuario = UsuariosSearch::find()->where(['id' => $id_usuario])->one();

            return $this->render('mostrar_perfil', [
                    'modelo_usuario' => $modelo_usuario,
                    'active_tab' => $active_tab,
                ]);
    }

    /* Acción para actualizar datos de usuario desde su vista de perfil*/
    public function actionUpdateDatosPerfil($id) {
        $modelo_usuario=$this->findModel($id);
        $modelo_search = new UsuariosSearch($modelo_usuario);
        $modelo_search->setIsNewRecord(false);

        if ($modelo_search->load(Yii::$app->request->post()) && $modelo_search->save()) {
            Yii::$app->session->setFlash('kv-detail-success', 'Datos guardados correctament');
            return $this->redirect(['/usuarios/mostrar-perfil',
                'id_usuario' =>$id,
                'active_tab' => "tab_datos"]);
        }

        return ("ERROR EN LA ACTUALIZACIÓN");
    }
}
