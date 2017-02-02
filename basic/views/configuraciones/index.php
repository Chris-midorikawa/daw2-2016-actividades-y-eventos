<?php

use yii\helpers\Html;
use yii\grid\GridView;

//vista principal de la parte de configuraciones

$this->title = 'Variables de Configuración';
$this->params['breadcrumbs'][] = $this->title;


?>

 <?= Html::a(Yii::t('app', 'Volver'), ['/usuarios/portal'], ['class' => 'btn btn-primary']) ?>
<div class="configuraciones-index">

    <h1><?= Html::encode($this->title) ?></h1>

    
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'variable',
            'valor:ntext',

            ['class' => 'yii\grid\ActionColumn2'],
        ],
    ]); ?>
</div>
