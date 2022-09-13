<?php

namespace backend\forms\Shop;

use shop\entities\Shop\Brand;
use shop\entities\Shop\Characteristic;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class CharacteristicSearch extends Model
{
    public $id;
    public $name;
    public $type;
    public $required;
    public $default;
    public $sort;

    public function rules(): array
    {
        return [
            [['id', 'sort'], 'integer'],
            [['name', 'type', 'default'], 'safe'],
            [['required'], 'boolean'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Characteristic::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['sort' => SORT_ASC],
            ]
        ]);

        $this->load($params);
        if (!$this->validate()){
            $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'sort' => $this->sort
        ]);
        $query->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 'type', $this->type])
            ->andFilterWhere(['ilike', 'default', $this->default]);

        return $dataProvider;
    }

}