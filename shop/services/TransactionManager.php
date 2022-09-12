<?php

namespace shop\services;

class TransactionManager
{
    /**
     * @throws \Exception
     */
    public function wrap(callable $function)
    {
        \Yii::$app->db->transaction($function);
    }
}