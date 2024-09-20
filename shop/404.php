<?php
// Remove the X-Powered-By header for security purposes
header_remove('X-Powered-By');

// Include header file
include 'inc/header.php';
?>

<style>
.notfound{}	
.notfound h2 {
    font-size: 100px;
    line-height: 130px;
    text-align: center;
}
.notfound h2 span {
    display: block;
    color: red;
    font-size: 170px;
}
</style>

<div class="main">
    <div class="content">
        <div class="section group">
            <div class="notfound">
                <h2><span>404</span> Not Found</h2>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<?php
// Include footer file
include 'inc/footer.php';
?>
