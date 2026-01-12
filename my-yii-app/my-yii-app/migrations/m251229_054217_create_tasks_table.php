<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tasks}}`.
 */
class m251229_054217_create_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("{{%tasks}}",[
            'id' => $this->primaryKey(),
            "user_id" => $this->integer()->notNull(),
            "title" => $this->string(255)->notNull(),
            "description" => $this->string(),
            "status" => $this->string(20)->notNull(),
            "created_at" => $this->timestamp()->defaultExpression("CURRENT_TIMESTAMP")->notNull(),
            "updated_at" => $this->timestamp()->defaultExpression("CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP")->notNull()
        ]
        );

        $this->createIndex('idx-tasks-user_id',"{{%tasks}}",'user_id');

        $this->addForeignKey(
            'fk-tasks-user_id',
            '{{%tasks}}',
            'user_id',
            '{{%users}}',
            'id',
            "CASCADE",
            "RESTRICT"
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-tasks-user_id','{{%tasks}}');
        $this->dropTable("{{%tasks}}");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251229_042226_create_tasks_models cannot be reverted.\n";

        return false;
    }
    */
}