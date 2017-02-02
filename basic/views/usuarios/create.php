<?php

use yii\helpers\Html;
use app\models\Usuarios; //para abajo poder usar los isAdmin
/* Por defecto usuario normal */

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = 'Registro de Usuario';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-create">

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
