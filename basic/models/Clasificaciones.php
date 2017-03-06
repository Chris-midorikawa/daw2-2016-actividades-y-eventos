<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clasificaciones".
 *
 * @property string $id
 * @property string $nombre
 * @property string $descripcion
 */
class Clasificaciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clasificaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string'],
            [['nombre'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre de la Clasificación',
            //'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @inheritdoc
     * @return ClasificacionesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClasificacionesQuery(get_called_class());
    }
}
