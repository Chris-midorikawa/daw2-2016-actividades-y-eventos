<?php

namespace app\controllers;

use Yii;
use app\models\Configuraciones;
use app\models\ConfiguracionesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Usuarios; //para abajo poder usar los isAdmin

/**
 * ConfiguracionesController. controlador para la parte de configuraciones
 */
class ConfiguracionesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
      
      //solo podrán acceder los admins

        
       if (Yii::$app->user->isGuest || Usuarios::isNormal()){
            $this->goHome();
        }
        else if( Usuarios::isAdmin()){
            $a=1; //variable para no dejarlo en blaco el if y que funcione
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
     * Lists all Configuraciones models.
     * @return mixed
     */

    //accion index

    public function actionIndex()
    {
        $searchModel = new ConfiguracionesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

   //accion ver

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

   //la accion crear no se necesita, ya que al ser variables de configuracion no es conveniente crear nuevas o borrar alguna existente


 
    
    //accion actualizar

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->variable]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }



    //buscar modelo de configuraciones
    protected function findModel($id)
    {
        if (($model = Configuraciones::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('La pagina no existe o no está disponible en este momento');
        }
    }
}
