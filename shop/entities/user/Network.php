<?php
namespace shop\entities\user;

use Webmozart\Assert\Assert;
use yii\db\ActiveRecord;

/**
 * @property integer $user_id
 * @property string $identity
 * @property string $network
 * @property int $id [int(11)]
 */

class Network extends ActiveRecord
{

    public static function create($network, $identity, $user_id):self
    {
        Assert::notEmpty($network);
        Assert::notEmpty($identity);

        $item = new static();
        $item->network = $network;
        $item->identity = (string)$identity;
        $item->user_id = $user_id;
        return  $item;
    }

    public static function tableName()
    {
        return '{{%user_networks}}';
    }

    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            ['identity', 'string', 'max' => 255],
            ['network', 'string', 'max' => 16],

        ];
    }

    public function isFor($network, $identity)
    {
        return $this->network == $network && $this->identity == $identity;
    }
}