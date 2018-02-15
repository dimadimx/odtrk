<?php

use yii\db\Migration;

class m171114_130420_modify_template_table extends Migration
{
    public function up()
    {
        $this->renameTable('svb_template', 'template');

        $this->renameColumn('template', 'dostup', 'role');

        $this->alterColumn('template', 'role', $this->smallInteger(1));

        $this->execute("UPDATE template SET name = REPLACE (name, '_', ' ') WHERE name LIKE '%_%'");
    }

    public function down()
    {
        $this->execute("UPDATE template SET name = REPLACE (name, ' ', '_') WHERE name LIKE '% %'");

        $this->renameColumn('template', 'role', 'dostup');

        $this->renameTable('template', 'svb_template');
    }
}
