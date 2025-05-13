
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['send_message'])) {
    // Check if the user is logged in
    if (isset($_SESSION['farmer_id'])) {
        $sender_id = $_SESSION['farmer_id'];  // Logged-in user's ID
        $receiver_id = 1;  // Admin's ID (modify as needed)
        $message = mysqli_real_escape_string($conn, $_POST['message']); // Escape special characters

        // Insert the message into the database
        $query = "INSERT INTO messages (sender_id, receiver_id, message, timestamp) 
                  VALUES ('$sender_id', '$receiver_id', '$message', NOW())";
        if (mysqli_query($conn, $query)) {
           
        } else {
            echo "<p style='color: red;'>Error sending message: " . mysqli_error($conn) . "</p>";
        }
    } else {
        echo "<p style='color: red;'>Please log in first!</p>";
    }
}
?>



<style>

.form-container {
     /* Set a max-width to make the form smaller */
    width: 50%; /* Allow the form to take up the full width of its parent container */
    padding: 20px; /* Optional: add some space around the form */
    background-color: #fff; /* Optional: add background color to the form */
    border-radius: 8px; /* Optional: rounded corners */
    box-shadow: 0 0 10px rgba(0,0,0,0.1); /* Optional: add some shadow to make it stand out */
    margin-left: 450px;
}

</style>


<h1 style="text-align: center; color: #1A553B; margin-top: 20px;" id="contactus">Contact Us</h1>
<div class="footer-content" style="display: flex; justify-content: center; align-items: center; padding: 20px;  border-top: 2px solid #1A553B;">
    <form method="POST" action="index.php" style="width: 100%; max-width: 600px; background: #ffffff; padding: 20px; border-radius: 10px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <div style="margin-bottom: 15px;">
            <textarea class="form-control" name="message" placeholder="Write your message here..." style="width: 100%; height: 120px; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;" required></textarea>
        </div>
        <div style="text-align: center;">
            <button class="btn btn-success" type="submit" name="send_message" style="background-color: #1A553B; color: #fff; padding: 10px 20px; font-size: 16px; border: none; border-radius: 5px; cursor: pointer;">Send Message</button>
        </div>
    </form>
</div>


<footer>
    <div class="footer-content">
        <div class="contact-info">
            <p>Egypt,Cairo,modern academy</p>
            <p>Phone: 01066923775</p>
            <p>Email: oabdelaziz554@gmail.com</p>
        </div>
        
    </div>
</footer>

