<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EtiquetasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Etiquetas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="etiquetas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  	echo $msg;
			$template = ($rol=='A') ? '{update} {delete}' : '';?>

    <p>
        <?= Html::a('Crear Etiqueta', ['create'], ['class' => 'btn btn-success']) ?>
		<?= Html::a('Buscar por Etiqueta', ['busqueda'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',

            ['class' => 'yii\grid\ActionColumn', 'template' => $template,],
        ],
    ]); ?>
</div>
                                                                                      