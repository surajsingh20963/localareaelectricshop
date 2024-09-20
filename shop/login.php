<?php
// Remove the X-Powered-By header for security purposes
header_remove('X-Powered-By');

include 'inc/header.php'; 

$login = Session::get("cuslogin");
if ($login == true) {
    header("Location: order.php");
}
?>

<?php
// Handle customer login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $custLogin = $cmr->customerLogin($_POST);
}
?> 

<div class="main">
    <div class="content">
        <div class="login_panel">

            <?php
            // Display login result message
            if (isset($custLogin)) {
                echo $custLogin;
            }
            ?>
            <h3>Existing Customers</h3>
            <p>Sign in with the form below.</p>
            <form action="" method="post">
                <input name="email" placeholder="Email" type="text"/>
                <input name="pass" placeholder="Password" type="password"/>
                <div class="buttons"><div><button class="grey" name="login">Sign In</button></div></div>
            </form>
        </div>

        <?php
        // Handle customer registration form submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
            $customerReg = $cmr->customerRegistration($_POST);
        }
        ?> 

        <div class="register_account">
            <?php
            // Display registration result message
            if (isset($customerReg)) {
                echo $customerReg;
            }
            ?>
            <h3>Register New Account</h3>
            <form action="" method="post">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <div>
                                    <input type="text" name="name" placeholder="Name"/>
                                </div>

                                <div>
                                    <input type="text" name="city" placeholder="City"/>
                                </div>

                                <div>
                                    <input type="text" name="zip" placeholder="Zip-Code"/>
                                </div>

                                <div>
                                    <input type="text" name="email" placeholder="Email"/>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <input type="text" name="address" placeholder="Address"/>
                                </div>

                                <div>
                                    <input type="text" name="country" placeholder="Country"/>
                                </div>

                                <div>
                                    <input type="text" name="phone" placeholder="Phone"/>
                                </div>

                                <div>
                                    <input type="text" name="pass" placeholder="Password"/>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="search"><div><button class="grey" name="register">Create Account</button></div></div>
                <div class="clear"></div>
            </form>
        </div>

        <div class="clear"></div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
