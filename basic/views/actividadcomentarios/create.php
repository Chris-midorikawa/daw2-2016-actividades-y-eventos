<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ActividadComentarios */

$this->title = 'Crear Comentario';
$this->params['breadcrumbs'][] = ['label' => 'Actividad Comentarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
if(isset($_GET['actividad_id'])){
	$actividad_id=$_GET['actividad_id'];
}else{
	$actividad_id=0;
	}
?>
<div class="actividad-comentarios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
