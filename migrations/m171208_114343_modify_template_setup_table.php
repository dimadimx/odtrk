<?php

use yii\db\Migration;

class m171208_114343_modify_template_setup_table extends Migration
{
    public function up()
    {
        $this->renameColumn('template_setup', 'cmt', 'comment');
        $this->dropColumn('template_setup', 'c');
        $this->dropColumn('template_setup', 'date');
    }

    public function down()
    {
        $this->renameColumn('template_setup', 'comment', 'cmt');
    }
}
