<?php
class DBHelper {
    
    public static $database;
    public $ddl;
    public $dml;
    public $select;
    
    public function __construct() {
        require('DDLQueries.php');
        require('DMLQueries.php');
        require('SelectQueries.php');
        DBHelper::$database = mysql_connect("localhost", "root", "wtwtwt") or die(mysql_error());
        mysql_select_db("anketovy_system");
        $this->ddl = new DDLQueries();
        $this->ddl->init();
        $this->dml = new DMLQueries();
        $this->select = new SelectQueries();
    }
    
}
