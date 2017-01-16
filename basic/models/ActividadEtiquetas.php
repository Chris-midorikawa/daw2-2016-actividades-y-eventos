<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "actividad_etiquetas".
 *
 * @property string $id
 * @property string $actividad_id
 * @property string $etiqueta_id
 */
class ActividadEtiquetas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'actividad_etiquetas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['actividad_id', 'etiqueta_id'], 'required'],
            [['actividad_id', 'etiqueta_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'actividad_id' => 'Actividad relacionada',
            'etiqueta_id' => 'Etiqueta relacionada.',
        ];
    }

    /**
     * @inheritdoc
     * @return ActividadEtiquetasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ActividadEtiquetasQuery(get_called_class());
    }
}
