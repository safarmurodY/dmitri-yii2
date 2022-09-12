<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shop_photos}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%shop_products}}`
 */
class m220912_110132_create_shop_photos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shop_photos}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'file' => $this->string()->notNull(),
            'sort' => $this->integer()->notNull(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            '{{%idx-shop_photos-product_id}}',
            '{{%shop_photos}}',
            'product_id'
        );

        // add foreign key for table `{{%shop_products}}`
        $this->addForeignKey(
            '{{%fk-shop_photos-product_id}}',
            '{{%shop_photos}}',
            'product_id',
            '{{%shop_products}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%shop_products}}`
        $this->dropForeignKey(
            '{{%fk-shop_photos-product_id}}',
            '{{%shop_photos}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            '{{%idx-shop_photos-product_id}}',
            '{{%shop_photos}}'
        );

        $this->dropTable('{{%shop_photos}}');
    }
}
