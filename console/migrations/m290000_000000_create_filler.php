<?php

use yii\db\Migration;

/**
 * Class m220912_110504_create_filler
 */
class m290000_000000_create_filler extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
//authority category
        $js_file = file_get_contents(__DIR__ . '/filler/user.json');

        $js_data = json_decode($js_file, true);

        $bulkInsertArray = array();
        foreach ($js_data as $datum) {
            $bulkInsertArray[] = [
                'id' => $datum['id'],
                'username' => $datum['username'],
                'auth_key' => $datum['auth_key'],
                'password_hash' => $datum['password_hash'],
                'password_reset_token' => $datum['password_reset_token'],
                'email' => $datum['email'],
                'status' => $datum['status'],
                'created_at' => $datum['created_at'],
                'updated_at' => $datum['updated_at'],
                'verification_token' => $datum['verification_token'],
            ];
        }
        $tableName = 'user';

        if (count($bulkInsertArray) > 0) {
            $columnNameArray = [
                'id',
                'username',
                'auth_key',
                'password_hash',
                'password_reset_token',
                'email',
                'status',
                'created_at',
                'updated_at',
                'verification_token',
            ];
            // below line insert all your record and return number of rows inserted
            $insertCount = Yii::$app->db->createCommand()
                ->batchInsert(
                    $tableName, $columnNameArray, $bulkInsertArray
                )
                ->execute();
            echo '~~~~~~~~~~~~~~~~~~~~' . $insertCount . " Users  inserted ~~~~~~~~~~~~\n";
        }

        /****************** User Networks ****************/

        $js_file = file_get_contents(__DIR__ . '/filler/user_networks.json');

        $js_data = json_decode($js_file, true);

        $bulkInsertArray = array();
        foreach ($js_data as $datum) {
            $bulkInsertArray[] = [
                'id' => $datum['id'],
                'user_id' => $datum['user_id'],
                'identity' => $datum['identity'],
                'network' => $datum['network'],
            ];
        }
        $tableName = 'user_networks';

        if (count($bulkInsertArray) > 0) {
            $columnNameArray = [
                'id',
                'user_id',
                'identity',
                'network',
            ];
            // below line insert all your record and return number of rows inserted
            $insertCount = Yii::$app->db->createCommand()
                ->batchInsert(
                    $tableName, $columnNameArray, $bulkInsertArray
                )
                ->execute();
            echo '~~~~~~~~~~~~~~~~~~~~' . $insertCount . " User Networks  inserted ~~~~~~~~~~~~\n";
        }


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }

}
