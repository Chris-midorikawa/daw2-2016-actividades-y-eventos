<?php

use yii\helpers\Html;

$rol='N';

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = 'Actualizar Usuario: ' . $model->nick;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="usuarios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php//dependiendo del tipo de usuario,irá a _form o a _reg?>

   
    <?php if($rol=='N'){
    echo $this->render('_reg', ['model' => $model,]);
	}
    else if($rol=='A'){
    echo $this->render('_form', ['model' => $model,]);

     }?>


</div>
