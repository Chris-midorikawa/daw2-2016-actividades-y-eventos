<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\ActividadesSearch;
use app\models\Areas;
use app\models\AreasQuery;
use app\piezas\busquedaActividades\BusquedaActividadesWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActividadesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>

        <h1 class="col-md-12 text-center">BIENVENIDO A NUESTRA WEB!</h1><br/><BR/><BR/><BR/>


<?php $modelo_actividades = ActividadesSearch::find()->where(['publica'=> '1', 'visible' => '1'])->orderBy(['fecha_celebracion' =>SORT_DESC]) ->limit(10) ->all();  
$active_tab="tab_datos"; 

$modelo_actividades2 = ActividadesSearch::find()->where(['publica'=> '1', 'visible' => '1','edad_id'=>'0'])->orderBy(['fecha_celebracion' =>SORT_DESC]) ->limit(30) ->all();  
$active_tab2="tab_datos";

$modelo_actividades3 = ActividadesSearch::find()->where([ 'visible' => '1',])->orderBy(['votosOK' =>SORT_DESC]) ->limit(10) ->all();  
$active_tab3="tab_datos";

?>


    <!-- CONTENIDO DE LOS TABS -->
 <div class="tab-content">
     <?php if($modelo_actividades ){ ?>
        <h1 class="col-md-12 text-center"> <u>Actividades públicas recientes</u></h1>
        <div id="menu_mis_datos" class="tab-pane fade in <?php if ($active_tab==="tab_datos") {echo "active";}?>">
            <?= BusquedaActividadesWidget::widget(['modelo_actividades' => $modelo_actividades]) ?>
        </div>
     <?php } ?>
        </br>
        </br>
        </br>
     <?php if($modelo_actividades2){ ?>
         <h1 class="col-md-12 text-center"><u> Actividades públicas recientes para todos los públicos</u></h1>
        <div id="menu_mis_datos" class="tab-pane fade in <?php if ($active_tab2==="tab_datos") {echo "active";}?>">
            <?= BusquedaActividadesWidget::widget(['modelo_actividades' => $modelo_actividades2]) ?>
        </div>
     <?php } ?>
        </br>
        </br>
        </br>
     <?php if($modelo_actividades3){ ?>
         <h1 class="col-md-12 text-center"><u> Las Actividades mas votadas</u></h1>
        <div id="menu_mis_datos" class="tab-pane fade in <?php if ($active_tab3==="tab_datos") {echo "active";}?>">
            <?= BusquedaActividadesWidget::widget(['modelo_actividades' => $modelo_actividades3]) ?>
        </div>
     <?php } ?>
</div>        
        

