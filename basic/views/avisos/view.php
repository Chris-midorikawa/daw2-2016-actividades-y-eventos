<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Avisos */

//TÍTULO CON EL ID DEL AVISO
$this->title = $model->claseAvisoInstancia;

//CREACIÓN DEL BREADCRUMB
$this->params['breadcrumbs'][] = ['label' => 'Avisos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->clase_aviso_id;

?>
<div class="avisos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Id Aviso',
                'value' => $model->id,
            ],
            [
                'label' => 'Clase Aviso',
                'value' => $model->claseAvisoInstancia,
            ],
            [
                'label' => 'Fecha',
                'value' => $model->fecha,
            ],
            [
                'label' => 'Origen',
                'value' => $model->origen_usuario_id,
            ],
            [
                'label' => 'Destino',
                'value' => $model->destino_usuario_id,
            ],
            [
                'label' => 'Texto',
                'value' => $model->texto,
            ],
            [
                'label' => 'Actividad',
                'value' => $model->actividad_id,
            ],
            [
                'label' => 'Comentario',
                'value' => $model->comentario_id,
            ],
            [
                'label' => 'Lectura',
                'value' => $model->fecha_lectura,
            ],
            [
                'label' => 'Borrado',
                'value' => $model->fecha_borrado,
            ],
            [
                'label' => 'Aceptado',
                'value' => $model->fecha_aceptado,
            ],
        ],
    ]) ?>

</div>
