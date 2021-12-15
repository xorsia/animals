<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%animals}}`.
 */
class m211214_182529_create_animals_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%animals}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'type' => $this->integer(),
            'age' => $this->float(),
            'status' => $this->integer(),
            'timestamp' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%animals}}');
    }
}
