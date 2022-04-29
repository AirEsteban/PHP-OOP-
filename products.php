<html>
    <head>
    <?php 
        require_once("bd_connection.php");
        include("includes.html");
        include("./ClassProducts.php");
        include("./ClassCart.php");
        $connection = new ConnectionManager(MYSQL_CONNECTION);
        $products = new Products($connection);
        $cart = new Cart($connection);

        $cod = isset($_GET["cod"]) ? intval($_GET["cod"]) : -1;
        if($cod != -1)
        {
            if(isset($_GET["del"]) && $_GET["del"] == 1)
            {
                $cart->DeleteItemFromCart($cod);
            }
            else
            {
                $cart->InsertItemInCartWithCode($cod);
            }
        }
    ?>
    </head>
    <body>
        
        <div>
            <h1 id="idArt">ARTICLES</h1>
            <table>
                <tr>
                        <td>Code</td>
                        <td>Product</td>
                        <td>Description</td>
                        <td>Price</td>
                        <td>Action</td>
                </tr>
                <?php 
                        $productList = $products->GetAllProducts();
                    while($row = mysqli_fetch_array($productList)){
                ?>
                <tr>
                        <td><?php echo(intval($row['COD']));?></td>
                        <td><?php echo($row["PRODUCT"]);?></td>
                        <td><?php echo($row["DESCRIPTION"]);?></td>
                        <td><?php echo(floatval($row["PRICE"]));?></td>
                        <td><a href="#" <?php //echo("href=products.php?cod=" . intval($row["COD"])); ?> onclick="BuyItem(<?php echo(intval($row['COD'])) ?>)">BUY</a></td>
                </tr>
                <?php }
                    mysqli_free_result($productList);
                ?>
            </table>
       </div>
       <div>
           <h1>SHOPPING CART</h1>
           <table id="shoppingCart">
                <tr>
                        <td>Code</td>
                        <td>Product</td>
                        <td>Description</td>
                        <td>Price</td>
                        <td>Action</td>
                </tr>
                <?php 
                        $cartList = $cart->GetAllItems();
                    while($row = mysqli_fetch_array($cartList)){
                ?>
                <tr>
                        <td><?php echo(intval($row['COD']));?></td>
                        <td><?php echo($row["PRODUCT"]);?></td>
                        <td><?php echo($row["DESCRIPTION"]);?></td>
                        <td><?php echo(floatval($row["PRICE"]));?></td>
                        <td><a href="#" <?php //echo("href=products.php?del=1&cod=" . intval($row["COD"])); ?> onclick="DelItem(<?php echo(intval($row['COD'])) ?>)">DELETE</a></td>
                </tr>
                <?php 
                } 
                mysqli_free_result($cartList);
                
                ?>
            </table>
       </div>
       <script type="text/javascript">
            var direction = "./action_products.php";
            function BuyItem(cod)
            {
                // The action number
                console.log("EL CODIGO ES " + cod);
                act = 1;
                $.ajax({
                    url: direction,
                    data: {action : act, codigo: cod},
                    method: "POST",
                    // Automatically converts to json.
                    dataType: "json",
                    success: (data) => 
                    {
                        console.log("functiono" + data);
                        $("#shoppingCart").html(data);
                    }
                });
                return;
            }

            function DelItem(cod)
            {
                // The action number
                act = 2;
                $.ajax({
                    url: direction,
                    data: {action : act, codigo: cod},
                    method: "POST",
                    // Automatically converts to json.
                    dataType: "json",
                    success: (data) => 
                    {
                        console.log("functiono" + data);
                        $("#shoppingCart").html(data);
                    }
                });
                return; 
            }
                    
        </script>
    </body>
</html>