<?php

use yii\db\Migration;

class m171114_130433_modify_genre_table extends Migration
{
    public function up()
    {
        $this->renameTable('svb_zhanr', 'genre');

        $this->renameColumn('genre', 'dostup', 'role');

        $this->alterColumn('genre', 'role', $this->smallInteger(1));
    }

    public function down()
    {
        $this->renameColumn('genre', 'role', 'dostup');

        $this->renameTable('genre', 'svb_zhanr');
    }
}
