<?php

use FTP\Connection;

require_once("bd_connection.php");
try
{
    $manager = new ConnectionManager(MYSQL_CONNECTION);
    $nomPersona = "Victo";
    $apePersona = "Rita";
    $queryInsert = "INSERT INTO PERSONAS (NOM_PERSONA, APE_PERSONA) VALUES ('$nomPersona','$apePersona');";
    if(!$manager->conn->query($queryInsert))
    {
      throw new Exception("Couldn't insert the person");
    }

    $queryUpd = "UPDATE PERSONAS SET APE_PERSONA = 'Airasca' WHERE ID_PERSONA = 1";

    if(!$manager->conn->query($queryUpd))
    {
      throw new Exception("Couldn't update the person");
    }

    $queryDel = "DELETE FROM PERSONAS where ID_PERSONA = 2";

    if(!$manager->conn->query($queryDel))
    {
      throw new Exception("Couldn't delete the person");
    }

    $result = $manager->conn->query("SELECT * FROM personas");
    while($row = mysqli_fetch_array($result))
    {
        echo $row["APE_PERSONA"] . ", " . $row["NOM_PERSONA"] . "<br/>";
    }
}
catch (Exception $ex)
{
    echo $ex->getMessage();
}

?>