<?php

use yii\helpers\Html;

use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model app\models\Actividades */

$this->title = 'Actividad: ' . $model->titulo;
?>
<div class="actividades-view">

<?= Html::a('VOLVER', ['/usuarios/mostrar-perfil', 'id_usuario' => Yii::$app->user->identity->id], ['class' => 'btn btn-success']) ?>

    <h1><?= Html::encode($this->title) ?></h1>
  
    <?= $this->render('_form', [
        'model' => $model,
		'disabled'=>true,
    ]) ?>

<?= Html::a('VOLVER', ['/usuarios/mostrar-perfil', 'id_usuario' => Yii::$app->user->identity->id], ['class' => 'btn btn-success']) ?>

</div>