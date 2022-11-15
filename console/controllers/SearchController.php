<?php

namespace console\controllers;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\Exception\MissingParameterException;
use shop\entities\Shop\Product\Product;
use shop\entities\Shop\Product\Value;
use yii\console\Controller;
use yii\helpers\ArrayHelper;

class SearchController extends Controller
{
    private $client;
    public function __construct($id, $module, Client $client, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->client = $client;
    }

    public function actionReindex()
    {
        $query = Product::find()->active()
            ->with('categoryAssignments', 'tagAssignments', 'values')
            ->orderBy('id');
        $this->stdout('Clearing' . PHP_EOL);
        try {
            $this->client->indices()->delete([
                'index' => 'shop'
            ]);
        } catch (\Exception $e){
            $this->stdout('Index is empty' . PHP_EOL);
        }
        $this->stdout('Indexing of products' . PHP_EOL);
        foreach ($query->each() as $product) {
            /** @var $product Product */
            $this->stdout('Product #' . $product->id . PHP_EOL);
            $this->client->index([
                'index' => 'shop',
                'type' => 'products',
                'id' => $product->id,
                'body' => [
                    'name' => $product->name,
                    'description' => strip_tags($product->description),
                    'price' => (int)$product->price_new,
                    'brand' => (int)$product->brand_id,
                    'categories' => ArrayHelper::merge(
                        [$product->category_id],
                        ArrayHelper::getColumn($product->categoryAssignments, 'category_id')
                    ),
                    'values' => ArrayHelper::map(
                        $product->values,
                        function (Value $value){return 'attr_' . $value->characteristic_id;},
                        function (Value $value){
                            return [
                                'value_string' => (string)$value->value,
                                'value_int' => (int)$value->value
                            ];
                        }
                    )
                ]
            ]);
        }
        $this->stdout('Done!' . PHP_EOL);
    }
}