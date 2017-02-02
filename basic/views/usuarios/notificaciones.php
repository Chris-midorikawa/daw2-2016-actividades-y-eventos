<?php

use yii\helpers\Html;
use app\models\Usuarios; //para abajo poder usar los isAdmin

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = 'Configuracion de Notificaciones';
?>
<div class="usuarios-update">

    <h1><?= Html::encode($this->title) ?></h1>


<?php
//va al formulario de notificaciones

    echo $this->render('_noti', ['model' => Yii::$app->user->identity]);

?>


</div>