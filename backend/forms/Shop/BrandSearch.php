<?php

namespace backend\forms\Shop;

use shop\entities\Shop\Brand;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class BrandSearch extends Model
{
    public $id;
    public $name;
    public $slug;

    public function rules(): array
    {
        return [
            [['id'], 'integer'],
            [['name', 'slug'], 'safe']
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Brand::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['name' => SORT_ASC],
            ]
        ]);

        $this->load($params);
        if (!$this->validate()){
            $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
        ]);
        $query->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 'slug', $this->slug]);

        return $dataProvider;
    }

}