<?php
require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;


function connect_db()
{
    // $dotenvPath = (__DIR__."/.env");
    // $dotenv = Dotenv::createImmutable(dirname($dotenvPath));
    // $dotenv->load();

    // $db_user = getenv('DB_USER')|| "root";
    // $db_password = getenv('DB_PASSWORD') || "pass";
    // $dbname = getenv('DB_NAME') || "project_data_base";
    // $host = getenv('DB_HOST_NAME') || "mysql";
    $db_user ="root";
    $db_password =  "pass";
    $dbname =  "project_data_base";
    $host =  "mysql";
    $dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;

    try {
        $conn = new PDO($dsn, $db_user, $db_password);

        // Set PDO attributes
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $conn;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
}
