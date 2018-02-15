<?php

use yii\db\Migration;

class m171114_124951_modify_code_table extends Migration
{
    public function up()
    {
        $this->renameTable('svb_code', 'code');

        $this->renameColumn('code', 'dostup', 'role');
        $this->renameColumn('code', 'code', 'code_in');

        $this->alterColumn('code', 'role', $this->smallInteger(1));

        $this->execute("UPDATE code SET name = REPLACE (name, '_', ' ') WHERE name LIKE '%_%'");
    }

    public function down()
    {
        $this->renameColumn('code', 'role', 'dostup');
        $this->renameColumn('code', 'code_in', 'code');

        $this->renameTable('code', 'svb_code');
    }
}
