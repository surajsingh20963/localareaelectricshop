<?php
// Remove the X-Powered-By header for security purposes
header_remove('X-Powered-By');

include 'inc/header.php';
?>

<?php
if (!isset($_GET['catId']) || $_GET['catId'] == NULL) {
    // Redirect to 404 page if category ID is not provided
    echo "<script>window.location='404.php';</script>";
} else {
    // Sanitize the category ID to prevent malicious input
    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['catId']);
}
?>

<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Latest from Category</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">

            <?php 
            // Fetch products by category
            $productbycat = $pd->productByCat($id);
            if ($productbycat) {
                // Display the products
                while ($result = $productbycat->fetch_assoc()) {
            ?>

            <div class="grid_1_of_4 images_1_of_4">
                <a href="details.php?proid=<?php echo $result['productId']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
                <h2><?php echo $result['productName']; ?></h2>
                <p><?php echo $fm->textShorten($result['body'], 60); ?></p>
                <p><span class="price">TK.<?php echo $result['price']; ?></span></p>
                <div class="button"><span><a href="details.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
            </div>

            <?php 
                } 
            } else {
                // Redirect to 404 page if no products are found in the category
                header("Location: 404.php");
            }
            ?>

        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
