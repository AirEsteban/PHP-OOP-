<?php 
class Cart
{
    private $bd;

    public function __construct($base)
    {
        $this->bd = $base;
    }

    // Getting all the items from the shopping cart.
    public function GetAllItems()
    {
        if(isset($this->bd))
        {
            $query = "SELECT * FROM shopping";
            $result = $this->bd->ExecuteQuery($query);
            if(!isset($result))
            {
                return false;
            }
            else
            {
                return $result;
            }
        }
        else
        {
            return false;
        }
    }

    //Delete one item from the shopping cart.
    public function DeleteItemFromCart($cod)
    {
        if(!isset($this->bd))
        {
            return false;
        }
        $delQuery = "DELETE FROM shopping WHERE COD=$cod";
        $this->bd->ExecuteQuery($delQuery);
        return true;
    }

    // Check if a code has been added in the shopping cart.
    private function CheckIfExists($cod)
    {
        $queryExists = "SELECT * FROM shopping WHERE COD=$cod";
        $result = $this->bd->ExecuteQuery($queryExists);
        return mysqli_num_rows($result) != 0;

    }

    // Insert item by code on shopping cart.
    public function InsertItemInCartWithCode($cod)
    {
        if(isset($this->bd))
        {
            if(!$this->CheckIfExists($cod)){
                $selectQuery = "SELECT * FROM products WHERE COD=$cod";
                $selectResult = mysqli_fetch_array($this->bd->ExecuteQuery($selectQuery));
                if(count($selectResult) == 0)
                {
                    return false;
                }
                $insertQuery = "INSERT INTO shopping (COD, PRODUCT, DESCRIPTION, PRICE) VALUES (" . intval($selectResult["COD"]) . 
                ", '" . $selectResult["PRODUCT"] . "', '" . $selectResult["DESCRIPTION"] . "'," 
                . floatval($selectResult["PRICE"]) . ")";
                $insertResult = $this->bd->ExecuteQuery($insertQuery);
                return $insertResult;
            }
        }
        else
        {
            return false;
        }
    }

    // Insert items with code, product, description and price on shopping cart.
    public function InsertItemInCartParams($cod, $product, $desc, $price)
    {
        if(!isset($this->bd))
        {
            return false;
        }
        $insertQuery = "INSERT INTO shopping (COD, PRODUCT, DESCRIPTION, PRICE) VALUES($cod, $product, $desc, $price)";
        $resultInsert = $this->bd->ExecuteQuery($insertQuery);
        return $resultInsert;
    }
}
?>