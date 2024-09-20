<?php
// Remove the X-Powered-By header to prevent server information leaks
header_remove('X-Powered-By');

// Include necessary files
include 'inc/header.php';
?>

<div class="main">
    <div class="content">

        <!-- Iphone Section -->
        <div class="content_top">
            <div class="heading">
                <h3>Iphone</h3> <!-- Fixed the invalid HTML tag -->
            </div>
            <div class="clear"></div>
        </div>

        <div class="section group">
            <?php
            // Fetch and display top brand iPhones
            $getTop4 = $pd->getTopbrandIphone();
            if ($getTop4) {
                while ($result = $getTop4->fetch_assoc()) { 
            ?>
                <div class="grid_1_of_4 images_1_of_4">
                    <a href="details.php?proid=<?php echo $result['productId']; ?>">
                        <img src="admin/<?php echo $result['image']; ?>" alt="" />
                    </a>
                    <h2><?php echo $result['productName']; ?></h2>
                    <p><?php echo $fm->textShorten($result['body'], 60); ?></p>
                    <p><span class="price">TK.<?php echo $result['price']; ?></span></p>
                    <div class="button">
                        <span><a href="details.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span>
                    </div>
                </div>
            <?php 
                }
            }
            ?>
        </div>

        <!-- Acer Section -->
        <div class="content_top">
            <div class="heading">
                <h3>Acer</h3> <!-- Fixed the invalid HTML tag -->
            </div>
            <div class="clear"></div>
        </div>

        <div class="section group">
            <?php
            // Fetch and display top brand Acer products
            $getTop1 = $pd->getTopbrandAcer();
            if ($getTop1) {
                while ($result = $getTop1->fetch_assoc()) { 
            ?>
                <div class="grid_1_of_4 images_1_of_4">
                    <a href="details.php?proid=<?php echo $result['productId']; ?>">
                        <img src="admin/<?php echo $result['image']; ?>" alt="" />
                    </a>
                    <h2><?php echo $result['productName']; ?></h2>
                    <p><?php echo $fm->textShorten($result['body'], 60); ?></p>
                    <p><span class="price">TK.<?php echo $result['price']; ?></span></p>
                    <div class="button">
                        <span><a href="details.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span>
                    </div>
                </div>
            <?php 
                }
            }
            ?>
        </div>

        <!-- Samsung Section -->
        <div class="content_bottom">
            <div class="heading">
                <h3>Samsung</h3>
            </div>
            <div class="clear"></div>
        </div>

        <div class="section group">
            <?php
            // Fetch and display top brand Samsung products
            $getTop2 = $pd->getTopbrandSamsung();
            if ($getTop2) {
                while ($result = $getTop2->fetch_assoc()) { 
            ?>
                <div class="grid_1_of_4 images_1_of_4">
                    <a href="details.php?proid=<?php echo $result['productId']; ?>">
                        <img src="admin/<?php echo $result['image']; ?>" alt="" />
                    </a>
                    <h2><?php echo $result['productName']; ?></h2>
                    <p><?php echo $fm->textShorten($result['body'], 60); ?></p>
                    <p><span class="price">TK.<?php echo $result['price']; ?></span></p>
                    <div class="button">
                        <span><a href="details.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span>
                    </div>
                </div>
            <?php 
                }
            }
            ?>
        </div>

        <!-- Canon Section -->
        <div class="content_bottom">
            <div class="heading">
                <h3>Canon</h3>
            </div>
            <div class="clear"></div>
        </div>

        <div class="section group">
            <?php
            // Fetch and display top brand Canon products
            $getTop3 = $pd->getTopbrandCanon();
            if ($getTop3) {
                while ($result = $getTop3->fetch_assoc()) { 
            ?>
                <div class="grid_1_of_4 images_1_of_4">
                    <a href="details.php?proid=<?php echo $result['productId']; ?>">
                        <img src="admin/<?php echo $result['image']; ?>" alt="" />
                    </a>
                    <h2><?php echo $result['productName']; ?></h2>
                    <p><?php echo $fm->textShorten($result['body'], 60); ?></p>
                    <p><span class="price">TK.<?php echo $result['price']; ?></span></p>
                    <div class="button">
                        <span><a href="details.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span>
                    </div>
                </div>
            <?php 
                }
            }
            ?>
        </div>

    </div>
</div>

<?php
// Include footer
include 'inc/footer.php';
?>
