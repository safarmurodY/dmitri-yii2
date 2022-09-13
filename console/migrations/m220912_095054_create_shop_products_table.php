<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shop_products}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%shop_categories}}`
 * - `{{%shop_brands}}`
 */
class m220912_095054_create_shop_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shop_products}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'brand_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'price_old' => $this->integer(),
            'price_new' => $this->integer(),
            'rating' => $this->decimal(3, 2),
            'meta_json' => $this->text(),
        ]);

        $this->createIndex(
            '{{%idx-shop_products-code}}',
            '{{%shop_products}}',
            'code',
            true
        );

        // creates index for column `category_id`
        $this->createIndex(
            '{{%idx-shop_products-category_id}}',
            '{{%shop_products}}',
            'category_id'
        );

        // add foreign key for table `{{%shop_categories}}`
        $this->addForeignKey(
            '{{%fk-shop_products-category_id}}',
            '{{%shop_products}}',
            'category_id',
            '{{%shop_categories}}',
            'id'
        );

        // creates index for column `brand_id`
        $this->createIndex(
            '{{%idx-shop_products-brand_id}}',
            '{{%shop_products}}',
            'brand_id'
        );

        // add foreign key for table `{{%shop_brands}}`
        $this->addForeignKey(
            '{{%fk-shop_products-brand_id}}',
            '{{%shop_products}}',
            'brand_id',
            '{{%shop_brands}}',
            'id'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%shop_categories}}`
        $this->dropForeignKey(
            '{{%fk-shop_products-category_id}}',
            '{{%shop_products}}'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            '{{%idx-shop_products-category_id}}',
            '{{%shop_products}}'
        );

        // drops foreign key for table `{{%shop_brands}}`
        $this->dropForeignKey(
            '{{%fk-shop_products-brand_id}}',
            '{{%shop_products}}'
        );

        // drops index for column `brand_id`
        $this->dropIndex(
            '{{%idx-shop_products-brand_id}}',
            '{{%shop_products}}'
        );
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


        $this->dropTable('{{%shop_products}}');
    }
}
