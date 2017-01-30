<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActividadSeguimientosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Seguimientos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actividad-seguimientos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  ?>

    <p>
        <?= Html::a('Crear Seguimiento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	<p></p>
	<p></p><p></p><p></p>
	<table width="100%">
    <?php foreach($seguimientos as $s){
			echo "<tr><td><a href='view?id=".$actividades[$s->id]->id."'>".$actividades[$s->id]->titulo.'</a></td>';
			echo '<td>siguiendo desde '.$s->fecha_seguimiento.'</td>';
			echo '<td>'.Html::a('Dejar de seguir', ['delete', 'id' => $s->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿seguro?',
                'method' => 'post',
            ],
        ]).'</td>';
			echo '</tr>';
	}?>
	</table>
</div>
