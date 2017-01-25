<?php

namespace app\models;

use Yii;

/**
 * Modelo tabla "{{%configuraciones}}". */

class Configuraciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%configuraciones}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['valor'], 'required'],
            [['valor','variable'], 'string'],
            [['variable'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'variable' => 'Variable',
            'valor' => 'Valor',
        ];
    }
}
