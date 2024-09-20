<?php
// Remove the X-Powered-By header for security purposes
header_remove('X-Powered-By');

include 'inc/header.php';
?>

<?php 
if (isset($_GET['delpro'])) {
    // Sanitize the input by removing unwanted characters
    $delId = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delpro']);
    $delProduct = $ct->delProductByCart($delId);
}
?>

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture cartId and quantity from the POST request
    $cartId = $_POST['cartId'];
    $quantity = $_POST['quantity'];
    $updateCart = $ct->updateCartQuantity($cartId, $quantity);

    // If the quantity is 0 or less, remove the product from the cart
    if ($quantity <= 0) {
        $delProduct = $ct->delProductByCart($cartId);
    }
}
?>

<?php  
// Force refresh if 'id' parameter is not present in the URL
if (!isset($_GET['id'])) {
    echo "<meta http-equiv = 'refresh' content ='0;URL=?id=nayem' />";
}
?>

<div class="main">
    <div class="content">
        <div class="cartoption">        
            <div class="cartpage">
                <h2>Your Cart</h2>

                <?php 
                // Display any update or delete messages
                if (isset($updateCart)) {
                    echo $updateCart;
                }

                if (isset($delProduct)) {
                    echo $delProduct;
                }
                ?>

                <table class="tblone">
                    <tr>
                        <th width="5%">SL</th>
                        <th width="30%">Product Name</th>
                        <th width="10%">Image</th>
                        <th width="15%">Price</th>
                        <th width="15%">Quantity</th>
                        <th width="15%">Total Price</th>
                        <th width="10%">Action</th>
                    </tr>

                    <?php 
                    // Fetch cart products from the database
                    $getPro = $ct->getCartProduct();
                    if ($getPro) {
                        $i = 0;
                        $sum = 0;
                        $qty = 0;
                        while ($result = $getPro->fetch_assoc()) {
                            $i++;
                    ?>

                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['productName']; ?></td>
                        <td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
                        <td>Tk. <?php echo $result['price']; ?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="cartId" value="<?php echo $result['cartId']; ?>"/>
                                <input type="number" name="quantity" value="<?php echo $result['quantity']; ?>"/>
                                <input type="submit" name="submit" value="Update"/>
                            </form>
                        </td>
                        <td>
                            Tk. 
                            <?php
                            $total = $result['price'] * $result['quantity'];
                            echo $total;
                            ?>
                        </td>
                        <td>
                            <a onclick="return confirm('Are you sure to delete?')" href="?delpro=<?php echo $result['cartId']; ?>">X</a>
                        </td>
                    </tr>

                    <?php 
                        // Calculate total quantity and sum for the cart
                        $qty = $qty + $result['quantity'];
                        $sum = $sum + $total;
                        Session::set("qty", $qty);
                        Session::set("sum", $sum);
                    ?>

                    <?php 
                        } // end of while loop
                    } // end of if condition 
                    ?>  
                </table>

                <?php
                // Check if the cart is empty
                $getData = $ct->checkCartTable();
                if ($getData) {
                ?>

                <table style="float:right;text-align:left;" width="40%">
                    <tr>
                        <th>Sub Total : </th>
                        <td>TK. <?php echo $sum; ?></td>
                    </tr>
                    <tr>
                        <th>VAT : </th>
                        <td>10%</td>
                    </tr>
                    <tr>
                        <th>Grand Total :</th>
                        <td>TK. 
                            <?php 
                            $vat = $sum * 0.1;
                            $gtotal = $sum + $vat;
                            echo $gtotal;
                            ?>
                        </td>
                    </tr>
                </table>

                <?php 
                } else {
                    // Redirect to home if the cart is empty
                    header("Location:index.php");
                }
                ?>

            </div>

            <div class="shopping">
                <div class="shopleft">
                    <a href="index.php"><img src="images/shop.png" alt=""/></a>
                </div>
                <div class="shopright">
                    <a href="payment.php"><img src="images/check.png" alt=""/></a>
                </div>
            </div>
        </div>      
        <div class="clear"></div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
