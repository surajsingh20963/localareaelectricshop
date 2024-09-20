<?php
// Remove the X-Powered-By header for security purposes
header_remove('X-Powered-By');

// Include necessary files
include 'inc/header.php';

// Sanitize the input (proid) by removing unwanted characters
if (isset($_GET['proid'])) {
    $id = preg_replace('/[^a-zA-Z0-9_-]/', '', $_GET['proid']);
} else {
    // Redirect or handle the case where 'proid' is not present
    header("Location: 404.php");
    exit();
}

// Handle adding to the cart
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
    if ($quantity && $id) {
        $addCart = $ct->addToCart($quantity, $id);
    } else {
        $addCart = "Invalid quantity or product ID!";
    }
}

// Handle adding to compare list
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])) {
    $productId = filter_input(INPUT_POST, 'productId', FILTER_SANITIZE_STRING);
    if ($productId && $cmrId) {
        $insertCom = $pd->insertCompareData($productId, $cmrId);
    } else {
        $insertCom = "Unable to add to compare!";
    }
}

// Handle adding to wishlist
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wlist'])) {
    if ($id && $cmrId) {
        $saveWlist = $pd->saveWishListData($id, $cmrId);
    } else {
        $saveWlist = "Unable to save to wishlist!";
    }
}
?>

<style>
    .mybutton { width: 100px; float: left; margin-right: 50px; }
</style>

<div class="main">
    <div class="content">
        <div class="section group">
            <div class="cont-desc span_1_of_2">    
                <?php 
                // Fetch the product details
                $getPd = $pd->getSingleProduct($id);
                if ($getPd) {
                    while ($result = $getPd->fetch_assoc()) {
                ?>            
                <div class="grid images_3_of_2">
                    <img src="admin/<?php echo htmlspecialchars($result['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Product Image" />
                </div>
                <div class="desc span_3_of_2">
                    <h2><?php echo htmlspecialchars($result['productName'], ENT_QUOTES, 'UTF-8'); ?></h2>                
                    <div class="price">
                        <p>Price: <span>TK.<?php echo htmlspecialchars($result['price'], ENT_QUOTES, 'UTF-8'); ?></span></p>
                        <p>Category: <span><?php echo htmlspecialchars($result['catName'], ENT_QUOTES, 'UTF-8'); ?></span></p>
                        <p>Brand: <span><?php echo htmlspecialchars($result['brandName'], ENT_QUOTES, 'UTF-8'); ?></span></p>
                    </div>
                    <div class="add-cart">
                        <form action="" method="post">
                            <input type="number" class="buyfield" name="quantity" value="1" min="1"/>
                            <input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
                        </form>                
                    </div>

                    <!-- Display messages for cart, compare, and wishlist -->
                    <span style="color: red; font-size: 18px;">
                        <?php 
                        if (isset($addCart)) {
                            echo htmlspecialchars($addCart, ENT_QUOTES, 'UTF-8');
                        }
                        if (isset($insertCom)) {
                            echo htmlspecialchars($insertCom, ENT_QUOTES, 'UTF-8');
                        }
                        if (isset($saveWlist)) {
                            echo htmlspecialchars($saveWlist, ENT_QUOTES, 'UTF-8');
                        }
                        ?>
                    </span>

                    <?php 
                    // Check if the user is logged in to display compare and wishlist options
                    $login = Session::get("cuslogin");
                    if ($login == true) {
                    ?>
                    <div class="add-cart">
                        <div class="mybutton">
                            <form action="" method="post">
                                <input type="hidden" name="productId" value="<?php echo htmlspecialchars($result['productId'], ENT_QUOTES, 'UTF-8'); ?>"/>
                                <input type="submit" class="buysubmit" name="compare" value="Add to Compare"/>
                            </form>    
                        </div>

                        <div class="mybutton">
                            <form action="" method="post">
                                <input type="submit" class="buysubmit" name="wlist" value="Save to List"/>
                            </form>    
                        </div>        
                    </div>
                    <?php } ?>
                </div>
                <div class="product-desc">
                    <h2>Product Details</h2>
                    <?php echo nl2br(htmlspecialchars($result['body'], ENT_QUOTES, 'UTF-8')); ?>
                </div>
                <?php 
                    }
                }
                ?>    
            </div>

            <!-- Right sidebar with categories -->
            <div class="rightsidebar span_3_of_1">
                <h2>CATEGORIES</h2>
                <ul>
                    <?php 
                    $getCat = $cat->getAllCat();
                    if ($getCat) {
                        while ($result = $getCat->fetch_assoc()) {
                    ?>
                    <li><a href="productbycat.php?catId=<?php echo htmlspecialchars($result['catId'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($result['catName'], ENT_QUOTES, 'UTF-8'); ?></a></li>
                    <?php 
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
