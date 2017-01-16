<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActividadComentariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comentarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actividad-comentarios-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if($dataProvider==null){
		echo "introduzca un id de actividad";
		echo $this->render('_search', ['model' => $searchModel]); 
		}else{
			echo Html::a('Añadir Comentario', ['create?actividad_id='.$actividad_id], ['class' => 'btn btn-success'])."<p></p>";
    
			echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'actividad_id',
            'crea_usuario_id',
            'crea_fecha',
            'modi_usuario_id',
            // 'modi_fecha',
            // 'texto:ntext',
            // 'comentario_id',
            // 'cerrado',
            // 'num_denuncias',
            // 'fecha_denuncia1',
            // 'bloqueado',
            // 'fecha_bloqueo',
            // 'notas_bloqueo:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 
		}?>
</div>
