<?php

namespace app\components;

class ConnectionComponent extends \yii\db\Connection
{
    // LOCAL
    // public $dsn = 'mysql:host=localhost;dbname=db_nakar_test';
    // public $dsn = 'mysql:host=localhost;dbname=db_nakar';
    // public $username = 'root';
    // public $password = '';
    // public $charset = 'utf8';
    // public $tablePrefix = 'tbl_';
    
    
    // LIVE
    // public $dsn = 'mysql:host=localhost;dbname=db_gamis_test';
    public $dsn = 'mysql:host=localhost;dbname=db_nakar_new';
    public $username = 'root';
    public $password = '';
    public $charset = 'utf8';
    public $tablePrefix = 'tbl_';

    // public $enableSchemaCache = true;
    // public $schemaCacheDuration = 60;
    // public $schemaCache = 'cache';
}