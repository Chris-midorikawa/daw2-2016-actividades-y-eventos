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




<div class="site-index">

    <div class="jumbotron">

    

        <h1>Bienvenido!</h1>


        <p class="lead">.</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Noticia 1.</p>

                  </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Noticia 2.</p>

                
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Noticia 3.</p>
                
            </div>
        </div>

    </div>


</br>
</br>
</br>

<?php $modelo_actividades = ActividadesSearch::find()->where(['publica'=> '1', 'visible' => '1'])->orderBy(['fecha_celebracion' =>SORT_DESC]) ->limit(10) ->all();  
$active_tab="tab_datos"; 

$modelo_actividades2 = ActividadesSearch::find()->where(['publica'=> '1', 'visible' => '1','edad_id'=>'0'])->orderBy(['fecha_celebracion' =>SORT_DESC]) ->limit(30) ->all();  
$active_tab2="tab_datos";

$modelo_actividades3 = ActividadesSearch::find()->where([ 'visible' => '1',])->orderBy(['votosOK' =>SORT_DESC]) ->limit(10) ->all();  
$active_tab3="tab_datos";

?>


    <!-- CONTENIDO DE LOS TABS -->
 <div class="tab-content">
        <h1 class="col-md-12 text-center"> 10 Actividades públicas recientes (visibles)</h1>
        <div id="menu_mis_datos" class="tab-pane fade in <?php if ($active_tab==="tab_datos") {echo "active";}?>">
            <?= BusquedaActividadesWidget::widget(['modelo_actividades' => $modelo_actividades]) ?>
        </div>
        </br>
        </br>
        </br>
         <h1 class="col-md-12 text-center"> 30 Actividades públicas recientes (visibles) para todos los públicos</h1>
        <div id="menu_mis_datos" class="tab-pane fade in <?php if ($active_tab2==="tab_datos") {echo "active";}?>">
            <?= BusquedaActividadesWidget::widget(['modelo_actividades' => $modelo_actividades2]) ?>
        </div>
        </br>
        </br>
        </br>

         <h1 class="col-md-12 text-center"> Las 10 actividades mas votadas</h1>
        <div id="menu_mis_datos" class="tab-pane fade in <?php if ($active_tab3==="tab_datos") {echo "active";}?>">
            <?= BusquedaActividadesWidget::widget(['modelo_actividades' => $modelo_actividades3]) ?>
        </div>
        
</div>        
        

