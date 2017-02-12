<?php

namespace app\piezas\busquedaActividades;


use yii\base\Widget;

class BusquedaActividadesWidget extends Widget
{
    public $modelo_actividades;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('busqueda_actividades', ['modelo_actividades' => $this->modelo_actividades]);
    }
}