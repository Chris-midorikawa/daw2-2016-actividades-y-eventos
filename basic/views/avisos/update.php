<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Avisos */

//TÍTULO CON EL NOMBRE DE LA AVISO
$this->title = 'MODIFICAR AVISO: '.$model->claseAvisoInstancia;

//CREACIÓN DEL BREADCRUMB
$this->params['breadcrumbs'][] = ['label' => 'Avisos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->claseAvisoInstancia;
?>

<div class="avisos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_modificar', [
        'model' => $model,
    ]) ?>

</div>
