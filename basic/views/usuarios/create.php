<?php

use yii\helpers\Html;
/* Por defecto usuario normal */
$rol='N';
/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = 'Registro de Usuario';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-create">

    <h1><?= Html::encode($this->title) ?></h1>

<?php /*  admin ir  a _form*/
if(isset($model->rol)) {
    $rol=$model->rol;
}?>

<?php if($rol=='N'){
    echo $this->render('_reg', ['model' => $model,]);
}
    else if($rol=='A'){
    echo $this->render('_form', ['model' => $model,]);

     }?>

</div>
