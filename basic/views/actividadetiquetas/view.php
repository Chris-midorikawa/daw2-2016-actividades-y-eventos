<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Etiquetas;
use app\models\Actividades;
/* @var $this yii\web\View */
/* @var $model app\models\ActividadEtiquetas */

$this->title = "";
$this->params['breadcrumbs'][] = ['label' => 'Actividad Etiquetas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="actividad-etiquetas-view">
    <?= $this->render('_form', [
        'model' => $model,
		'disabled'=>'true',
    ]) ?>
	<?= '<td>'.Html::a('Desetiquetar', ['delete', 'id' => $model->id], [
           'data' => [
                'confirm' => '¿está seguro?',
                'method' => 'post',
            ],
        ]).'</td>' ?>

</div>
