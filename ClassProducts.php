<?php 
class Products
{
    private $bd;

    public function __construct($base)
    {
        $this->bd = $base;
    }

    public function GetAllProducts()
    {
        if(isset($this->bd))
        {
            $query = "SELECT * FROM products";
            $result = $this->bd->ExecuteQuery($query);
            if(!$result)
            {
                return false;
            }
            return $result;
        }
        else
        {
            return false;
        }
    }
}

?>
