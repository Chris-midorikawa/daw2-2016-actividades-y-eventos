<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Clasificaciones */

//TÍTULO CON EL ID DEL AVISO
$this->title = $model->nombre;

//CREACIÓN DEL BREADCRUMB
$this->params['breadcrumbs'][] = ['label' => 'Clasificaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->nombre;

?>
<div class="avisos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Id',
                'value' => $model->id,
            ],
            [
                'label' => 'Clasificación',
                'value' => $model->nombre,
            ],
        ],
    ]) ?>

</div>
