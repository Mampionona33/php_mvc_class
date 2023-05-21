<?php
require __DIR__ . '/app/vendor/autoload.php';

use Dotenv\Dotenv;

function connect_db()
{

    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $db_user =  getenv('DB_USER');
    $db_password = getenv('DB_PASSWORD');
    $dbname = getenv('DB_NAME');
    $host = getenv('DB_HOST_NAME');
    $dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
    try {
        $conn = new PDO($dsn, $db_user, $db_password);

        // use to debug sql query
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $conn;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
}
