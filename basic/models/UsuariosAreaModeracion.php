<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%usuarios_area_moderacion}}".
 *
 * @property string $id
 * @property string $usuario_id
 * @property string $area_id
 */
class UsuariosAreaModeracion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%usuarios_area_moderacion}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'usuario_id', 'area_id'], 'required'],
            [['id', 'usuario_id', 'area_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario_id' => 'Usuario relacionado con un Area para su moderación.',
            'area_id' => 'Area relacionada con el Usuario que puede moderarla.',
        ];
    }

    /**
     * @inheritdoc
     * @return UsuariosAreaModeracionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsuariosAreaModeracionQuery(get_called_class());
    }
}
