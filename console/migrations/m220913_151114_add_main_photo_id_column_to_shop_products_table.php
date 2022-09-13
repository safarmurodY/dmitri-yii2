<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%shop_products}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%shop_photos}}`
 */
class m220913_151114_add_main_photo_id_column_to_shop_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%shop_products}}', 'main_photo_id', $this->integer());

        // creates index for column `main_photo_id`
        $this->createIndex(
            '{{%idx-shop_products-main_photo_id}}',
            '{{%shop_products}}',
            'main_photo_id'
        );

        // add foreign key for table `{{%shop_photos}}`
        $this->addForeignKey(
            '{{%fk-shop_products-main_photo_id}}',
            '{{%shop_products}}',
            'main_photo_id',
            '{{%shop_photos}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%shop_photos}}`
        $this->dropForeignKey(
            '{{%fk-shop_products-main_photo_id}}',
            '{{%shop_products}}'
        );

        // drops index for column `main_photo_id`
        $this->dropIndex(
            '{{%idx-shop_products-main_photo_id}}',
            '{{%shop_products}}'
        );

        $this->dropColumn('{{%shop_products}}', 'main_photo_id');
    }
}
