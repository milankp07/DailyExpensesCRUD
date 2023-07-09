<?php 

$server = 'localhost';
$db= 'mysqldb';
$user='root';
$password='';

//Setting up DSN
$dsn = "mysql:host=".$server.";dbname=".$db;

try {
    //New PDO/connection object.
    $pdo = new PDO($dsn,$user,$password);
    //Setting few attributes.
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    
} 
catch (PDOException $e) {
    echo $e->getMessage();
}




?>
