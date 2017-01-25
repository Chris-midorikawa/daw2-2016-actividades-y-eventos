<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "{{%areas}}".
 *
 * @property integer $id
 * @property string $clase_area_id
 * @property string $nombre
 * @property integer $area_id
 */
class Areas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%areas}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[/*'id', */'clase_area_id', 'nombre'], 'required'],
            [['id', 'area_id'], 'integer'],
            [['clase_area_id'], 'string', 'max' => 1],
            [['nombre'], 'string', 'max' => 50],
        ];
    }

    /*Función que devuelve la lista fija de clases de áreas*/
    public static function getClasesAreas()
    {
        return [
            '0' => 'Planeta',
            '1' => 'Continente',
            '2' => 'País',
            '3' => 'Estado',
            '4' => 'Región',
            '5' => 'Provincia',
            '6' => 'Población',
            '7' => 'Barrio',
            '8' => 'Zona',
        ];
    }

    /*Función que, a partir de un id de clase de área, devuelve el nombre de la clase*/
    public static function getClaseArea($id_clase_area)
    {
        $clases_area = self::getClasesAreas();
        if (isset($clases_area)){
            return $clases_area[$id_clase_area];
        } else {
            return false;
        }
    }

    /*Función que devuelve el nombre de la clase de área de la instancia actual*/
    public function getClaseAreaInstancia()
    {
        $clases_area = self::getClasesAreas();
        if (isset($clases_area)){
            return $clases_area[$this->clase_area_id];
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'clase_area_id' => 'Clase Area ID',
            'nombre' => 'Nombre',
            'area_id' => 'Area ID',
        ];
    }

    public function getAreaPadre()
    {
        return $this->hasOne(Areas::className(), ['id' => 'area_id']);
    }


    public function getAreasPadres()
    {
        $padre = $this->areaPadre;
        $breadcrumb = array();
        while ($padre)
        {
            array_unshift($breadcrumb, $padre);
            $padre = $padre->areaPadre;
        }
        return $breadcrumb;
    }


    public function getModeradores()
    {
        return $this->hasMany(Usuarios::className(), ['id' => 'usuario_id'])
            ->viaTable('usuarios_area_moderacion', ['area_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return AreasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AreasQuery(get_called_class());
    }

}
