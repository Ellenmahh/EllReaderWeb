<?php
class Db {
    private static $instance = NULL;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance() {
        if (!isset(self::$instance)) {
           $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
           //self::$instance = new PDO('mysql:host=localhost;dbname=dbellreader', 'root','bcd127', $pdo_options);
           self::$instance = new PDO("mysql:host=".$_SERVER['RDS_HOSTNAME'].";dbname=".$_SERVER['RDS_DB_NAME'],$_SERVER['RDS_USERNAME'] , $_SERVER['RDS_PASSWORD'], $pdo_options);

        }
        return self::$instance;
    }
}
?>
