<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m251229_052937_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(50)->notNull(),
            "created_at" => $this->timestamp()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),          
        ]);

        $this->createIndex("idx-users-username_index",'{{%users}}','username');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
