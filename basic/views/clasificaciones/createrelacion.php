<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ClasificacionEtiquetas */

$this->title = 'Create Clasificacion Etiquetas';
$this->params['breadcrumbs'][] = ['label' => 'Clasificacion Etiquetas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clasificacion-etiquetas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formrelacion', [
        'model' => $model,
        'etiquetas' => $etiquetas,
        'nombreClasificacion'=>$nombreClasificacion,
    ]) ?>

</div>
