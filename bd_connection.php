<?php

use LDAP\Result;

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
define("MYSQL_CONNECTION", 1);
class ConnectionManager
{
    public $conn = "No stablished connection";
       
    public function __construct($connType)
    {
        $this->conn = $this->GetConnection($connType);
    }

    function GetConnection($connectionType)
    {
        $myConn = "No connection is stablished";
        switch($connectionType)
        {
            default:
                $host = "localhost";
                $usr = "root";
                $pass = "pianoforte";
                $dbName = "testings";
                $myConn = $this-> ConnectToDB($host, $usr, $pass, $dbName);
                break;
        }
        return $myConn;
    }

    function ConnectToDB($host, $usr, $pass, $dbName)
    {
        try
        {
            $connection = mysqli_connect($host,$usr,$pass,$dbName);
            if($connection->connect_errno)
            {
                throw new RuntimeException("Mysql no se ha podido conectar: ", $connection->connect_error);
            }
            return $connection;
        } 
        catch(Exception $ex)
        {
            echo $ex->getMessage();
        }
    }

    public function ExecuteQuery($query)
    {
        $result = $this->conn->query($query);
        if(!$result)
        {
            return false;
        }
        else
        {
            return $result;
        }
    }
}

?>