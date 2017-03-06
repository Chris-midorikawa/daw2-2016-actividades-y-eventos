<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Avisos;

/**
 * AvisosSearch represents the model behind the search form about `app\models\Avisos`.
 */
class AvisosSearch extends Avisos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'destino_usuario_id', 'origen_usuario_id', 'actividad_id', 'comentario_id'], 'integer'],
            [['fecha', 'clase_aviso_id', 'texto', 'fecha_lectura', 'fecha_borrado', 'fecha_aceptado'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Avisos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'fecha' => $this->fecha,
            'destino_usuario_id' => $this->destino_usuario_id,
            'origen_usuario_id' => $this->origen_usuario_id,
            'actividad_id' => $this->actividad_id,
            'comentario_id' => $this->comentario_id,
            'fecha_lectura' => $this->fecha_lectura,
            'fecha_borrado' => $this->fecha_borrado,
            'fecha_aceptado' => $this->fecha_aceptado,
        ]);

        $query->andFilterWhere(['like', 'clase_aviso_id', $this->clase_aviso_id])
            ->andFilterWhere(['like', 'texto', $this->texto]);

        return $dataProvider;
    }
 
    //funcion para buscar los recibidos
    public function searchRecibidos($params){
        $query = Avisos::find()->where("clase_aviso_id='".$params['clase_aviso_id']."' and (destino_usuario_id=".$params['destino_usuario_id']." or destino_usuario_id IS NULL) and fecha_borrado IS NULL order by fecha desc");

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;        
    }
    
}
