<?php

use yii\db\Migration;

class m171114_130519_modify_telecast_table extends Migration
{
    public function up()
    {
        $this->renameTable('svb_peredachi', 'telecast');

        $this->renameColumn('telecast', 'zh', 'genre_id');
        $this->renameColumn('telecast', 'dostup', 'role');

        $this->alterColumn('telecast', 'role', $this->smallInteger(1));
        $this->alterColumn('telecast', 'hron', $this->smallInteger(3));

        $this->execute("UPDATE telecast t INNER JOIN genre g ON (t.genre_id = g.name AND t.role = g.role) SET t.genre_id = g.id");

        $this->alterColumn('telecast', 'genre_id', $this->integer(11));

        $this->createIndex('genre','telecast', 'genre_id');
    }

    public function down()
    {
        $this->dropIndex('genre', 'telecast');

        $this->alterColumn('telecast', 'genre_id', $this->string(50));

        $this->execute("UPDATE telecast t INNER JOIN genre g ON (t.genre_id = g.name AND t.role = g.role) SET t.genre_id = g.name");

        $this->renameColumn('telecast', 'role', 'dostup');
        $this->renameColumn('telecast', 'genre_id', 'zh');

        $this->renameTable('telecast', 'svb_peredachi');
    }
}
