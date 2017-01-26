<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Areas */

$this->title = "Añadir Participante a '$modeloActividad->titulo'";

?>
<div class="actividad-participantes-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (isset($error)){ ?>
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-check"></i>ERROR</h4>
        <?= Yii::$app->session->getFlash('error_add_participante') ?>
    </div>
    <?php }?>

    <?= //Html::activeDropDownList($modeloParticipante, "id", ArrayHelper::map(\app\models\Usuarios::find()->all(), 'id', 'nombre'));
    $this->render('_form_add_participante', [
        'modeloParticipante' => $modeloParticipante,
        'listaUsuarios' => $listaUsuarios,
    ]) ?>

</div>
