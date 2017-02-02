<?php

use yii\helpers\Html;
use app\models\Usuarios; //para abajo poder usar los isAdmin

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = 'Actualizar Usuario: ' . $model->nick;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="usuarios-update">

    <h1><?= Html::encode($this->title) ?></h1>


<?php
//si es admin va al formulario completo, si no al de registro
 if(Usuarios::isAdmin())
{
    echo $this->render('_form', ['model' => $model,]);
}
else
{
	echo $this->render('_reg', ['model' => $model,]);
}
?>


</div>
