<?php

use yii\db\Migration;

class m171114_130552_modify_main_table extends Migration
{
    public function up()
    {
        $this->renameTable('svb_main', 'main');

        $this->renameColumn('main', 'dostup', 'role');
        $this->alterColumn('main', 'role', $this->smallInteger(1));
        $this->alterColumn('main', 'sum', $this->smallInteger(5));
        $this->alterColumn('main', 'kanal', $this->smallInteger(3));
        $this->alterColumn('main', 'micf', $this->smallInteger(1));

        $this->renameColumn('main', 'code', 'code_id');
        $this->alterColumn('main', 'code_id', $this->integer(11));

        $this->execute("UPDATE main m SET m.prog = 'Золотий_фонд_ТРК' WHERE prog ='&quot;Золотий_фонд_ТРК&quot;'");
        $this->execute("UPDATE main m SET m.prog = 'Час_країни' WHERE prog ='&quot;Час_країни&quot;'");

        $this->execute("UPDATE main m INNER JOIN code co ON (m.code_id = co.code_in AND m.role = co.role) SET m.code_id = co.id");
        $this->execute("UPDATE main m INNER JOIN genre g ON (m.zhanr = g.name AND m.role = g.role) SET m.zhanr = g.id");
        $this->execute("UPDATE main m INNER JOIN speech s ON (m.movlen = s.name AND m.role = s.role) SET m.movlen = s.id");
        $this->execute("UPDATE main m INNER JOIN telecast t ON (m.prog = t.name AND m.role = t.role) SET m.prog = t.id");

        $this->alterColumn('main', 'zhanr', $this->integer(11));
        $this->alterColumn('main', 'movlen', $this->integer(11));
//        $this->alterColumn('main', 'prog', $this->integer(11));

        $this->createIndex('code_id','main', 'code_id');
        $this->createIndex('genre_id','main', 'zhanr');
        $this->createIndex('speech_id','main', 'movlen');
        $this->createIndex('telecast_id','main', 'prog');

        $this->renameColumn('main', 'zhanr', 'genre_id');
        $this->renameColumn('main', 'movlen', 'speech_id');
//        $this->renameColumn('main', 'prog', 'telecast_id');
    }

    public function down()
    {
        $this->dropIndex('code_id', 'main');
        $this->dropIndex('genre_id', 'main');
        $this->dropIndex('speech_id', 'main');
        $this->dropIndex('telecast_id', 'main');

        $this->renameColumn('main', 'genre_id', 'zhanr');
        $this->renameColumn('main', 'speech_id', 'movlen');
//        $this->renameColumn('main', 'telecast_id', 'prog');

        $this->alterColumn('main', 'zhanr', $this->char(200));
        $this->alterColumn('main', 'movlen', $this->char(200));
//        $this->alterColumn('main', 'prog', $this->char(200));

        $this->execute("UPDATE main m INNER JOIN code co ON (m.code_id = co.id AND m.role = co.role) SET m.code_id = co.code_in");
        $this->execute("UPDATE main m INNER JOIN genre g ON (m.zhanr = g.id AND m.role = g.role) SET m.zhanr = g.name");
        $this->execute("UPDATE main m INNER JOIN speech s ON (m.movlen = s.id AND m.role = s.role) SET m.movlen = s.name");
        $this->execute("UPDATE main m INNER JOIN telecast t ON (m.prog = t.id AND m.role = t.role) SET m.prog = t.name");

        $this->renameColumn('main', 'code_id', 'code');
        $this->renameColumn('main', 'role', 'dostup');

        $this->renameTable('main', 'svb_main');
    }
}
