<?php

use yii\db\Migration;

class m171208_101153_modify_main_table extends Migration
{
    public function up()
    {
        $this->addColumn('main', 'auto', $this->smallInteger(1)->after('micf')->defaultValue(0));

        $this->renameColumn('main', 'cmt', 'comment');

        $this->execute("UPDATE main m SET m.auto = 1, m.comment = REPLACE(m.comment, ':#:yes', '') WHERE m.comment like '%:#:yes%'");
    }

    public function down()
    {
        $this->execute("UPDATE main m SET m.comment = CONCAT(m.comment, ':#:yes') WHERE m.auto = 1");

        $this->renameColumn('main', 'comment', 'cmt');

        $this->dropColumn('main', 'auto');
    }
}
