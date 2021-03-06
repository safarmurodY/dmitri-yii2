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

    public static function create($network, $identity):self
    {
        Assert::notEmpty($network);
        Assert::notEmpty($identity);
        $item = new static();
        $item->network = $network;
        $item->identity = $identity;
        return  $item;
    }

    public static function tableName()
    {
        return '{{%user_networks}}';
    }
}