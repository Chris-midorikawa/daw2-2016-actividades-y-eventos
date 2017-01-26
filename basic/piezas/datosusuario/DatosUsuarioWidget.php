<?php

namespace app\piezas\datosusuario;


use yii\base\Widget;

class DatosUsuarioWidget extends Widget
{
    public $modelo_usuario;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('datos_usuario', ['modelo_usuario' => $this->modelo_usuario]);
    }
}