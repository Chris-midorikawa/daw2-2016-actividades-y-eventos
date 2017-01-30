<?php

namespace app\piezas\actividadesusuario;


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
        return $this->render('actividades_usuario', ['modelo_usuario' => $this->modelo_usuario]);
    }
}