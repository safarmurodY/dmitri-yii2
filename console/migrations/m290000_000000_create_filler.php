<?php

use yii\db\Migration;
use yii\helpers\Json;

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
        /****************** Shop brands ****************/

        $js_file = file_get_contents(__DIR__ . '/filler/shop_brands.json');

        $js_data = json_decode($js_file, true);

        $bulkInsertArray = array();
        foreach ($js_data as $datum) {
            $bulkInsertArray[] = [
                'id' => $datum['id'],
                'name' => $datum['name'],
                'slug' => $datum['slug'],
                'meta_json' => Json::encode($datum['meta_json']),
            ];
        }
        $tableName = 'shop_brands';

        if (count($bulkInsertArray) > 0) {
            $columnNameArray = [
                'id',
                'name',
                'slug',
                'meta_json',
            ];
            // below line insert all your record and return number of rows inserted
            $insertCount = Yii::$app->db->createCommand()
                ->batchInsert(
                    $tableName, $columnNameArray, $bulkInsertArray
                )
                ->execute();
            echo '~~~~~~~~~~~~~~~~~~~~' . $insertCount . " Brands  inserted ~~~~~~~~~~~~\n";
        }
        /****************** Shop categories ****************/

        $js_file = file_get_contents(__DIR__ . '/filler/shop_categories.json');

        $js_data = json_decode($js_file, true);

        $bulkInsertArray = array();
        foreach ($js_data as $datum) {
            $bulkInsertArray[] = [
                'id' => $datum['id'],
                'name' => $datum['name'],
                'slug' => $datum['slug'],
                'title' => $datum['title'],
                'description' => $datum['description'],
                'meta_json' => Json::encode($datum['meta_json']),
                'left' => $datum['left'],
                'right' => $datum['right'],
                'depth' => $datum['depth'],
            ];
        }
        $tableName = 'shop_categories';

        if (count($bulkInsertArray) > 0) {
            $columnNameArray = [
                'id',
                'name',
                'slug',
                'title',
                'description',
                'meta_json',
                'left',
                'right',
                'depth',
            ];
            // below line insert all your record and return number of rows inserted
            $insertCount = Yii::$app->db->createCommand()
                ->batchInsert(
                    $tableName, $columnNameArray, $bulkInsertArray
                )
                ->execute();
            echo '~~~~~~~~~~~~~~~~~~~~' . $insertCount . " Categories  inserted ~~~~~~~~~~~~\n";
        }
        /****************** Shop characteristics ****************/

        $js_file = file_get_contents(__DIR__ . '/filler/shop_characteristics.json');

        $js_data = json_decode($js_file, true);

        $bulkInsertArray = array();
        foreach ($js_data as $datum) {
            $bulkInsertArray[] = [
                'id' => $datum['id'],
                'name' => $datum['name'],
                'type' => $datum['type'],
                'required' => $datum['required'],
                'default' => $datum['default'],
                'variants_json' => Json::encode($datum['variants_json']),
                'sort' => $datum['sort'],
            ];
        }
        $tableName = 'shop_characteristics';

        if (count($bulkInsertArray) > 0) {
            $columnNameArray = [
                'id',
                'name',
                'type',
                'required',
                'default',
                'variants_json',
                'sort',
            ];
            // below line insert all your record and return number of rows inserted
            $insertCount = Yii::$app->db->createCommand()
                ->batchInsert(
                    $tableName, $columnNameArray, $bulkInsertArray
                )
                ->execute();
            echo '~~~~~~~~~~~~~~~~~~~~' . $insertCount . " Characteristics  inserted ~~~~~~~~~~~~\n";
        }
        /****************** Shop Tags ****************/

        $js_file = file_get_contents(__DIR__ . '/filler/shop_tags.json');

        $js_data = json_decode($js_file, true);

        $bulkInsertArray = array();
        foreach ($js_data as $datum) {
            $bulkInsertArray[] = [
                'id' => $datum['id'],
                'name' => $datum['name'],
                'slug' => $datum['slug'],
            ];
        }
        $tableName = 'shop_tags';

        if (count($bulkInsertArray) > 0) {
            $columnNameArray = [
                'id',
                'name',
                'slug',
            ];
            // below line insert all your record and return number of rows inserted
            $insertCount = Yii::$app->db->createCommand()
                ->batchInsert(
                    $tableName, $columnNameArray, $bulkInsertArray
                )
                ->execute();
            echo '~~~~~~~~~~~~~~~~~~~~' . $insertCount . " Tags  inserted ~~~~~~~~~~~~\n";
        }


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }

}
