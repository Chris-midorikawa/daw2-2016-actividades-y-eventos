<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clasificacion_etiquetas".
 *
 * @property string $id
 * @property string $clasificacion_id
 * @property string $etiqueta_id
 * @property string $clasificacion_etiqueta_id
 */
class ClasificacionEtiquetas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clasificacion_etiquetas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clasificacion_id', 'etiqueta_id'], 'required'],
            [['clasificacion_id', 'etiqueta_id', 'clasificacion_etiqueta_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'clasificacion_id' => 'Clasificacion ID',
            'etiqueta_id' => 'Etiqueta ID',
            'clasificacion_etiqueta_id' => 'Clasificacion Etiqueta ID',
        ];
    }

    /**
     * @inheritdoc
     * @return ClasificacionEtiquetasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClasificacionEtiquetasQuery(get_called_class());
    }
}
