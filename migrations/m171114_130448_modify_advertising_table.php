<?php

use yii\db\Migration;

class m171114_130448_modify_advertising_table extends Migration
{
    public function up()
    {
        $this->renameTable('svb_rek', 'advertising');

        $this->renameColumn('advertising', 'dostup', 'role');

        $this->alterColumn('advertising', 'role', $this->smallInteger(1));
        $this->alterColumn('advertising', 'time', $this->smallInteger(5));
        $this->alterColumn('advertising', 'kanal', $this->smallInteger(2));
    }

    public function down()
    {
        $this->renameColumn('advertising', 'role', 'dostup');

        $this->renameTable('advertising', 'svb_rek');
    }
}
