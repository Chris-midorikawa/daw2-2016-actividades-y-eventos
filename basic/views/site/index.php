<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\ActividadesSearch;
use app\models\Areas;
use app\models\AreasQuery;

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


<div class="actividades-index">

    <h1>Actividades Públicas</h1>
    
    <?php
    $searchModel = new ActividadesSearch();
    $dataProvider = $searchModel->search(['ActividadesSearch'=>['publica'=>'1',]]);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            

            'titulo:ntext',
            'descripcion:ntext',
            'fecha_celebracion',
            'duracion_estimada',

        ],
    ]); ?>
</div>


<div class="actividades-index">

    <h1>Actividades para todos los públicos</h1>
    
    <?php
    $searchModel2 = new ActividadesSearch();
    $dataProvider2 = $searchModel2->search(['ActividadesSearch'=>['publica'=>'1','edad_id'=>'0']]);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider2,
        'columns' => [
            

            'titulo:ntext',
            'descripcion:ntext',
            'fecha_celebracion',
            'duracion_estimada',

        ],
    ]); ?>
</div>



</div>
