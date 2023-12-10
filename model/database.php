<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

class Database
{
    private $pdo;

    public function __construct()
    {
        $host = $_ENV["DB_HOST"];
        $dbname = $_ENV["DB_NAME"];
        $username = $_ENV["DB_USERNAME"];
        $password = $_ENV["DB_PASSWORD"];

        $dsn = "mysql:host=$host;dbname=$dbname;port=3306";
        $user = $_ENV["DB_USERNAME"];
        $dbP = $_ENV["DB_PASSWORD"];
        $options = array(
            PDO::MYSQL_ATTR_SSL_CA => "cacert.pem",
            PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
        );
        try {
            $this->pdo = new PDO($dsn, $user, $dbP, $options);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $error) {
            $msg = $error->getMessage();
            echo "error:" . $msg;
        }
    }

    protected function executeStatement($query = "", $params = [])
    {
        try {
            $stmt = $this->pdo->prepare($query);
            if ($stmt === false) {
                throw new Exception("Unable to prepare statement: " . $query);
            }

            if ($params) {
                $stmt->execute($params);
            } else {
                $stmt->execute();
            }
            return $stmt;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
