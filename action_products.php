<?php 
require_once("bd_connection.php");
include("./ClassProducts.php");
include("./ClassCart.php");
define("INSERT", 1);
define("DELETE", 2);
$action = isset($_POST["action"]) ? $_POST["action"] : 0;
//echo $action;
if($action != 0)
{
    $cod = $_POST["codigo"];
    $bd = new ConnectionManager(MYSQL_CONNECTION);
    $cart = new Cart($bd);
    switch($action)
    {
        case INSERT:
            $cart->InsertItemInCartWithCode($cod);
            break;
        case DELETE:
            $cart->DeleteItemFromCart($cod);
            break;
        default:
            break;
    }
    $items = $cart->GetAllItems();
    $returnValue = Array();
    /*
    while($row = mysqli_fetch_assoc($items))
    {
        array_push($returnValue, $row);
    }
    echo(json_encode($returnValue));*/
    $aux = "";
    array_push($returnValue, "<tr>
    <td>Code</td>
    <td>Product</td>
    <td>Description</td>
    <td>Price</td>
    <td>Action</td>
</tr>");
    while($row = mysqli_fetch_assoc($items))
    {
        $aux = "<tr>
        <td>" . intval($row['COD']) . "</td>
        <td>" . $row["PRODUCT"] . "</td>
        <td>" . $row["DESCRIPTION"] . "</td>
        <td>" . floatval($row["PRICE"]) . "</td>
        <td><a href='#' onclick='" . "DelItem(" . intval($row["COD"]) . ")' >DELETE</a></td>
        </tr>";
        array_push($returnValue, $aux);
    }
    echo(json_encode($returnValue));
}
?>