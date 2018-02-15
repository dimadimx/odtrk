<?php

use yii\db\Migration;

class m171114_130534_modify_template_setup_table extends Migration
{
    public function up()
    {
        $this->renameTable('svb_template_setup', 'template_setup');

        $this->renameColumn('template_setup', 'dostup', 'role');
        $this->alterColumn('template_setup', 'role', $this->smallInteger(1));
        $this->alterColumn('template_setup', 'sum', $this->smallInteger(5));
        $this->alterColumn('template_setup', 'kanal', $this->smallInteger(3));
        $this->alterColumn('template_setup', 'micf', $this->smallInteger(1));
        $this->alterColumn('template_setup', 'template_id', $this->integer(11));

        $this->renameColumn('template_setup', 'code', 'code_id');
        $this->alterColumn('template_setup', 'code_id', $this->integer(11));

        $this->execute("UPDATE template_setup ts INNER JOIN code co ON (ts.code_id = co.code_in AND ts.role = co.role) SET ts.code_id = co.id");
        $this->execute("UPDATE template_setup ts INNER JOIN genre g ON (ts.zhanr = g.name AND ts.role = g.role) SET ts.zhanr = g.id");
        $this->execute("UPDATE template_setup ts INNER JOIN speech s ON (ts.movlen = s.name AND ts.role = s.role) SET ts.movlen = s.id");
        $this->execute("UPDATE template_setup ts INNER JOIN telecast t ON (ts.prog = t.name AND ts.role = t.role) SET ts.prog = t.id");

        $this->alterColumn('template_setup', 'zhanr', $this->integer(11));
        $this->alterColumn('template_setup', 'movlen', $this->integer(11));
        $this->alterColumn('template_setup', 'prog', $this->integer(11));

        $this->createIndex('code_id','template_setup', 'code_id');
        $this->createIndex('template_id','template_setup', 'template_id');
        $this->createIndex('genre_id','template_setup', 'zhanr');
        $this->createIndex('speech_id','template_setup', 'movlen');
        $this->createIndex('telecast_id','template_setup', 'prog');

        $this->renameColumn('template_setup', 'zhanr', 'genre_id');
        $this->renameColumn('template_setup', 'movlen', 'speech_id');
        $this->renameColumn('template_setup', 'prog', 'telecast_id');
    }

    public function down()
    {
        $this->dropIndex('code_id', 'template_setup');
        $this->dropIndex('template_id', 'template_setup');
        $this->dropIndex('genre_id', 'template_setup');
        $this->dropIndex('speech_id', 'template_setup');
        $this->dropIndex('telecast_id', 'template_setup');

        $this->renameColumn('template_setup', 'genre_id', 'zhanr');
        $this->renameColumn('template_setup', 'speech_id', 'movlen');
        $this->renameColumn('template_setup', 'telecast_id', 'prog');

        $this->alterColumn('template_setup', 'zhanr', $this->char(200));
        $this->alterColumn('template_setup', 'movlen', $this->char(200));
        $this->alterColumn('template_setup', 'prog', $this->char(200));

        $this->execute("UPDATE template_setup ts INNER JOIN code co ON (ts.code_id = co.id AND ts.role = co.role) SET ts.code_id = co.code_in");
        $this->execute("UPDATE template_setup ts INNER JOIN genre g ON (ts.zhanr = g.id AND ts.role = g.role) SET ts.zhanr = g.name");
        $this->execute("UPDATE template_setup ts INNER JOIN speech s ON (ts.movlen = s.id AND ts.role = s.role) SET ts.movlen = s.name");
        $this->execute("UPDATE template_setup ts INNER JOIN telecast t ON (ts.prog = t.id AND ts.role = t.role) SET ts.prog = t.name");

        $this->renameColumn('template_setup', 'code_id', 'code');
        $this->renameColumn('template_setup', 'role', 'dostup');

        $this->alterColumn('template_setup', 'code', $this->smallInteger(3));

        $this->renameTable('template_setup', 'svb_template_setup');
    }
}
