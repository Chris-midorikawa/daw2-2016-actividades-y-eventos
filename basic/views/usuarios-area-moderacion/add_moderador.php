<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Areas */

$this->title = "Añadir Moderador de $modelo_area->nombre";
$this->params['breadcrumbs'][] = ['label' => 'Áreas', 'url' => ['/areas']];
$this->params['breadcrumbs'][] = ['label' => $modelo_area->nombre, 'url' => ['/areas/view', 'id' => $modelo_area->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="areas-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (isset($error)){ ?>
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-check"></i>ERROR</h4>
        <?= Yii::$app->session->getFlash('error_add_moderador') ?>
    </div>
    <?php }?>

    <?= //Html::activeDropDownList($modelo_usuario_area, "id", ArrayHelper::map(\app\models\Usuarios::find()->all(), 'id', 'nombre'));
    $this->render('_form_add_moderador', [
        'modelo_usuario_area' => $modelo_usuario_area,
        'usuarios' => $usuarios,
    ]) ?>

</div>
