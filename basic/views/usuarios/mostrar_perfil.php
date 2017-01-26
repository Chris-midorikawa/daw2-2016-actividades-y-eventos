<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\piezas\datosusuario\DatosUsuarioWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
/*$this->title = $modelo_usuario->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;*/
?>


<!--SISTEMA DE PESTAÑAS BOOTSTRAP:
        1ª DATOS DE USUARIO
        2ª ACTIVIDADES DE USUARIO (PROPIAS, EN SEGUIMIENTO Y COMO PARTICIPANTE)
        3ª AVISOS Y NOTIFICACIONES
        4ª ALERTAS Y NOTAS
        DENTRO DE CADA UNA SE MOSTRARÁ UN WIDGET CON EL CONTENIDO Y LOS ENLACES A LAS
            ACCIONES CORRESPONDIENTES-->
<div>
    <!-- TABS DEL MENÚ -->
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#menu_mis_datos">MIS DATOS</a></li>
        <li><a data-toggle="tab" href="#menu_actividades">ACTIVIDADES</a></li>
        <li><a data-toggle="tab" href="#menu_avisos_notificaciones">AVISOS Y NOTIFICACIONES</a></li>
        <li><a data-toggle="tab" href="#menu_alertas_notas">ALERTAS Y NOTAS</a></li>
    </ul>

    <!-- CONTENIDO DE LOS TABS -->
    <div class="tab-content">
        <div id="menu_mis_datos" class="tab-pane fade in active">
            <?= DatosUsuarioWidget::widget(['modelo_usuario' => $modelo_usuario]) ?>
        </div>
        <div id="menu_actividades" class="tab-pane fade">
            <!--AQUÍ IRÁ EL ECHO DEL WIDGET DE ACTIVIDADES-->
        </div>
        <div id="menu_avisos_notificaciones" class="tab-pane fade">
            <!--AQUÍ IRÁ EL ECHO DEL WIDGET DE AVISOS Y NOTIFICACIONES-->
        </div>
        <div id="menu_alertas_notas" class="tab-pane fade">
            <!--AQUÍ IRÁ EL ECHO DEL WIDGET DE ALERTAS Y NOTAS-->
        </div>
    </div>
</div>
