<?php

use yii\db\Migration;

class m171115_155605_modify_tables extends Migration
{
    public function up()
    {
        $this->execute("UPDATE genre SET name = TRIM(REPLACE (name, '_', ' ')) WHERE name LIKE '%_%'");
        $this->execute("UPDATE telecast SET name = TRIM(REPLACE (name, '_', ' ')) WHERE name LIKE '%_%'");
        $this->execute("UPDATE main SET prog = TRIM(REPLACE (prog, '_', ' ')) WHERE prog LIKE '%_%'");
    }

    public function down()
    {
        $this->execute("UPDATE genre SET name = REPLACE (name, ' ', '_') WHERE name LIKE '% %'");
        $this->execute("UPDATE telecast SET name = REPLACE (name, ' ', '_') WHERE name LIKE '% %'");
        $this->execute("UPDATE main SET prog = REPLACE (prog, ' ', '_') WHERE prog LIKE '% %'");
    }
}
