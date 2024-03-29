<?php

namespace shop\helpers;

use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class UserHelper
{
    public static function statusList():array
    {
        return [
            User::STATUS_ACTIVE => 'Active',
            User::STATUS_INACTIVE => 'Inactive',
        ];
    }

    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    public static function statusLabel($status): string
    {
        switch ($status){
            case User::STATUS_INACTIVE:
                $class = 'label label-default';
                break;
            case User::STATUS_ACTIVE:
                $class = 'label label-success';
                break;
            default:
                $class = 'label label-default';
        }
        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }
}