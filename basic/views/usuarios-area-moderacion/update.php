<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UsuariosAreaModeracion */

$this->title = 'Actualizar Usuarios Moderadores de Area: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mantenimiento de Áreas de moderación para Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="usuarios-area-moderacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
