<?php

use yii\db\Migration;

class m171017_200402_modify_tables_index extends Migration
{
    public function up()
    {
        $this->execute("alter table svb_code convert to character set utf8 collate utf8_general_ci;");
        $this->execute("alter table svb_main convert to character set utf8 collate utf8_general_ci;");
        $this->execute("alter table svb_movlennja convert to character set utf8 collate utf8_general_ci;");
        $this->execute("alter table svb_peredachi convert to character set utf8 collate utf8_general_ci;");
        $this->execute("alter table svb_rek convert to character set utf8 collate utf8_general_ci;");
        $this->execute("alter table svb_template convert to character set utf8 collate utf8_general_ci;");
        $this->execute("alter table svb_template_setup convert to character set utf8 collate utf8_general_ci;");
        $this->execute("alter table svb_users convert to character set utf8 collate utf8_general_ci;");
        $this->execute("alter table svb_zhanr convert to character set utf8 collate utf8_general_ci;");

        $this->createIndex('role','svb_code', 'dostup');
        $this->addPrimaryKey('pr-code-id','svb_code','id');
        $this->dropIndex('id', 'svb_code');

        $this->createIndex('role','svb_main', 'dostup');
        $this->addPrimaryKey('pr-main-id','svb_main','id');
        $this->dropIndex('id', 'svb_main');

        $this->createIndex('role','svb_movlennja', 'dostup');
        $this->addPrimaryKey('pr-speech-id','svb_movlennja','id');
        $this->dropIndex('id', 'svb_movlennja');

        $this->createIndex('role','svb_peredachi', 'dostup');
        $this->addPrimaryKey('pr-telecast-id','svb_peredachi','id');
        $this->dropIndex('id', 'svb_peredachi');

        $this->createIndex('role','svb_rek', 'dostup');
        $this->addPrimaryKey('pr-advertising-id','svb_rek','id');
        $this->dropIndex('id', 'svb_rek');

        $this->createIndex('role','svb_template', 'dostup');
        $this->addPrimaryKey('pr-template-id','svb_template','id');
        $this->dropIndex('id', 'svb_template');

        $this->createIndex('role','svb_template_setup', 'dostup');
        $this->addPrimaryKey('pr-template_setup-id','svb_template_setup','id');
        $this->dropIndex('id', 'svb_template_setup');

        $this->createIndex('role','svb_users', 'dostup');
        $this->addPrimaryKey('pr-users-id','svb_users','id');
        $this->dropIndex('id', 'svb_users');

        $this->createIndex('role','svb_zhanr', 'dostup');
        $this->addPrimaryKey('pr-genre-id','svb_zhanr','id');
        $this->dropIndex('id', 'svb_zhanr');
    }

    public function down()
    {
        $this->execute("alter table svb_code convert to character set cp1251 collate cp1251_general_ci;");
        $this->execute("alter table svb_main convert to character set cp1251 collate cp1251_general_ci;");
        $this->execute("alter table svb_movlennja convert to character set cp1251 collate cp1251_general_ci;");
        $this->execute("alter table svb_peredachi convert to character set cp1251 collate cp1251_general_ci;");
        $this->execute("alter table svb_rek convert to character set cp1251 collate cp1251_general_ci;");
        $this->execute("alter table svb_template convert to character set cp1251 collate cp1251_general_ci;");
        $this->execute("alter table svb_template_setup convert to character set cp1251 collate cp1251_general_ci;");
        $this->execute("alter table svb_users convert to character set cp1251 collate cp1251_general_ci;");
        $this->execute("alter table svb_zhanr convert to character set cp1251 collate cp1251_general_ci;");
    }
}
