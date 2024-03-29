<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shop_categories}}`.
 */
class m220909_095802_create_shop_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shop_categories}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'title' => $this->string(),
            'description' => $this->string(),
            'meta_json' => 'JSON NOT NULL',
            'left' => $this->integer()->notNull(),
            'right' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            '{{%idx-shop_categories-slug}}',
            '{{%shop_categories}}',
            'slug',
            true
        );
        $this->insert('{{%shop_categories}}', [
            'id' => 1,
            'name' => '',
            'slug' => 'root',
            'title' => null,
            'description' => null,
            'meta_json' => '{}',
            'left' => 1,
            'right' => 2,
            'depth' => 0,
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shop_categories}}');
    }
}
