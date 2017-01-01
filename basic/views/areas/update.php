<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Areas */

//TÍTULO CON EL NOMBRE DEL ÁREA
$this->title = 'MODIFICAR ÁREA: '.$model->nombre;

//CREACIÓN DEL BREADCRUMB
$this->params['breadcrumbs'][] = ['label' => 'Áreas', 'url' => ['index']];
foreach ($breadcrumb_actual as $tag_model)
{
    $url_enlace = ['areas/update', 'id' => $tag_model->id];
    $this->params['breadcrumbs'][] = ['label' =>$tag_model->nombre, 'url' => $url_enlace];
}
$this->params['breadcrumbs'][] = $model->nombre;
?>
<div class="areas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_modificar', [
        'model' => $model,
    ]) ?>

</div>
