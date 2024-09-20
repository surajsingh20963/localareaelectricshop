<?php
// Remove the X-Powered-By header for security purposes
header_remove('X-Powered-By');

include 'inc/header.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validating form input data to prevent parameter tampering
    $name = isset($_POST['name']) ? $fm->validation($_POST['name']) : null;
    $email = isset($_POST['email']) ? $fm->validation($_POST['email']) : null;
    $contact = isset($_POST['contact']) ? $fm->validation($_POST['contact']) : null;
    $message = isset($_POST['message']) ? $fm->validation($_POST['message']) : null;

    // Prevent SQL injection by escaping strings
    $name = mysqli_real_escape_string($db->link, $name);
    $email = mysqli_real_escape_string($db->link, $email);
    $contact = mysqli_real_escape_string($db->link, $contact);
    $message = mysqli_real_escape_string($db->link, $message);

    $error = "";
    
    // Input validation
    if (empty($name)) {
        $error = "Name must not be empty!";
    } elseif (empty($email)) {
        $error = "Email must not be empty!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid Email Address!";
    } elseif (empty($contact)) {
        $error = "Contact field must not be empty!";
    } elseif (!preg_match('/^\d{10,15}$/', $contact)) {
        // Ensuring contact number has a valid format (between 10 to 15 digits)
        $error = "Invalid contact number!";
    } elseif (empty($message)) {
        $error = "Subject field must not be empty!";
    } else {
        // Insert data into the database securely
        $query = "INSERT INTO tbl_contact(name, email, contact, message) VALUES('$name', '$email', '$contact', '$message')";
        $inserted_rows = $db->insert($query);

        if ($inserted_rows) {
            $msg = "Message Sent Successfully.";
        } else {
            $error = "Message not sent!";
        }
    }
}
?>

<div class="main">
    <div class="content">
        <div class="support">
            <div class="support_desc">
                <h3>Live Support</h3>
                <p><span>24 hours | 7 days a week | 365 days a year &nbsp;&nbsp; Live Technical Support</span></p>
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout...</p>
            </div>
            <img src="images/contact.png" alt="" />
            <div class="clear"></div>
        </div>

        <div class="section group">
            <div class="col span_2_of_3">
                <div class="contact-form">
                    <h2>Contact Us</h2>

                    <?php 
                    // Display error or success messages
                    if (!empty($error)) {
                        echo "<span style='color:red'>$error</span>";
                    }

                    if (!empty($msg)) {
                        echo "<span style='color:green'>$msg</span>";
                    }
                    ?>

                    <form action="" method="post">
                        <div>
                            <span><label>NAME</label></span>
                            <span><input type="text" name="name" value=""></span>
                        </div>
                        <div>
                            <span><label>E-MAIL</label></span>
                            <span><input type="text" name="email" value=""></span>
                        </div>
                        <div>
                            <span><label>MOBILE.NO</label></span>
                            <span><input type="text" name="contact" value=""></span>
                        </div>
                        <div>
                            <span><label>SUBJECT</label></span>
                            <span><textarea name="message"></textarea></span>
                        </div>
                        <div>
                            <span><input type="submit" name="submit" value="SUBMIT"></span>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col span_1_of_3">
                <div class="company_address">
                    <h2>Company Information :</h2>
                    <p>344 East-Goran,</p>
                    <p>Khilgaon, Dhaka-1219,</p>
                    <p>Bangladesh</p>
                    <p>Mobile: 01622425286</p>
                    <p>Phone: 0176210187</p>
                    <p>Email: <span>nayemhowlader77@gmail.com</span></p>
                    <p>Follow on: <span>Facebook</span>, <span>Twitter</span></p>
                </div>
            </div>
        </div>        
    </div>
</div>

<?php include 'inc/footer.php'; ?>
