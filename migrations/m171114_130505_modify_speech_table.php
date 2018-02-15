<?php

use yii\db\Migration;

class m171114_130505_modify_speech_table extends Migration
{
    public function up()
    {
        $this->renameTable('svb_movlennja', 'speech');

        $this->renameColumn('speech', 'dostup', 'role');

        $this->alterColumn('speech', 'role', $this->smallInteger(1));
    }

    public function down()
    {
        $this->renameColumn('speech', 'role', 'dostup');

        $this->renameTable('speech', 'svb_movlennja');
    }
}
