<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_networks}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m220726_093611_create_user_networks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_networks}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'identity' => $this->string()->notNull(),
            'network' => $this->string(16)->notNull(),
        ]);
        $this->createIndex('{{%idx-user_networks-identity-name}}',
            '{{%user_networks}}',
            ['identity', 'network'],
            true);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-user_networks-user_id}}',
            '{{%user_networks}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-user_networks-user_id}}',
            '{{%user_networks}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-user_networks-user_id}}',
            '{{%user_networks}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-user_networks-user_id}}',
            '{{%user_networks}}'
        );
        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-user_networks-identity-name}}',
            '{{%user_networks}}'
        );

        $this->dropTable('{{%user_networks}}');
    }
}
