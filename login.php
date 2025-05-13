<?php
session_start();
include('db.php');

$message = ""; // متغير لتخزين الرسائل

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $farmer_email = mysqli_real_escape_string($conn, $_POST['farmer_email']);
    $farmer_password = mysqli_real_escape_string($conn, $_POST['farmer_password']);

    // Check if the email is for the admin
    if (strpos($farmer_email, 'admin') !== false) {
        // Perform password check for admin
        if ($farmer_password === '1111') { // Replace 'admin_password' with the actual admin password
            $_SESSION['admin_id'] = true;
            header("Location: admin.php");
            exit;
        } else {
            $message = "Invalid admin password. Please try again.";
        }
    } else {
        // Check if the user exists
        $query = "SELECT * FROM fuser WHERE farmer_email = '$farmer_email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            if ($user['farmer_password'] === $farmer_password) {
                if ($user['status'] === 'accepted') {
                    $_SESSION['farmer_id'] = $user['farmer_id'];
                    $_SESSION['farmer_name'] = $user['farmer_name'];

                    // Add login notification
                    $notification_query = "INSERT INTO notifications (user_id, type, details) 
                                            VALUES ({$user['farmer_id']}, 'login', 'User logged in successfully.')";
                    mysqli_query($conn, $notification_query);

                    header("Location: index.php");
                    exit;
                } else {
                    $message = "Your account is not yet approved or is blocked. Please contact admin.";
                }
            } else {
                $message = "Invalid password. Please try again.";
            }
        } else {
            $message = "No user found with that email. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<style>
    input{
        color: white;
    }
</style>
<body>
    <div class="form-background">
        <form class="form-content" method="POST" action="login.php">
            <a href="index.php" style="color: rgb(255, 255, 255);font-size: 40px;text-decoration: none;" class="fa-solid fa-left-long"></a>
            <h1 style="text-align: center;">Login</h1>

            <label for="email">Email:</label>
            <input type="text" name="farmer_email" required>

            <label for="password">Password:</label>
            <input type="password" name="farmer_password" required>
            
            <a href="register.php" style="color: white;">Dont have an account?</a>
            <button type="submit" class="btn btn-success">Login</button>

            <!-- عرض الرسائل تحت الزر -->
            <?php if ($message): ?>
                <p style="color: white; text-align: center; margin-top: 10px;"><?php echo $message; ?></p>
            <?php endif; ?>
        </form>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>
</html>
