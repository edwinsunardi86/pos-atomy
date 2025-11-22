<?php
namespace App\Services;

use PDO;
use PDOException;

class ConnectionSqlServer_ERP {
    public string $sql;
    function index($query)
    {
        $this->sql = $query;
        try {
            $serverName4 = "192.168.1.9";
            $port4 = "1433";
            $database4 = "dbsoserp";
            $username4 = "sa";
            $password4 = "n48zVv4VdfzRRjWEEMUr";
            $conn = new PDO("sqlsrv:server=$serverName4,$port4;Driver={ODBC Driver 18 for SQL Server};Database=$database4;ConnectionPooling=0;Encrypt = true;TrustServerCertificate = true", $username4, $password4,array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ));
            $data = [];
            foreach($conn->query($this->sql) as $row){
                array_push($data,$row);
            }
            return json_encode($data);
        } catch (PDOException $e) {
            return "Error connecting to SQL Server: " . $e->getMessage();
        }
    }
}
?>