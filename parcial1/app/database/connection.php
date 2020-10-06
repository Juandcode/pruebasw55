<?php
/**
* Created by PhpStorm.
* User: Eddy
* Date: 15/4/2017
* Time: 2:17 AM
*/
define('DB_HOST', 'localhost'); // 'your-database-host';
define('DB_NAME', 'parcialsw');   // 'your-database-name';
define('DB_USER', 'root');      // 'your-database-user';
define('DB_PASS', 'root');      // 'your-database-password 3528762d';


/*define('DB_HOST', 'localhost'); // 'your-database-host';
define('DB_NAME', 'id7088983_pruebaparcial');   // 'your-database-name';
define('DB_USER', 'id7088983_prueba');      // 'your-database-user';
define('DB_PASS', '123456789');      // 'your-database-password 3528762d';*/
class Db
{
private static $instance = NULL;
private function __construct()
{

}
///PATRON DE DISEÑO SINGLETON
public static function getInstance()
{
if (!isset(self::$instance)) {
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
self::$instance = new PDO($dsn.'', DB_USER, DB_PASS, $pdo_options);
}
return self::$instance;
}
}
?>

