<?php 
session_start();
include('db.php');

$message = ""; // متغير لتخزين الرسائل

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $farmer_name = mysqli_real_escape_string($conn, $_POST['farmer_name']);
    $farmer_email = mysqli_real_escape_string($conn, $_POST['farmer_email']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $farmer_password = mysqli_real_escape_string($conn, $_POST['farmer_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    if ($farmer_password !== $confirm_password) {
        $message = "Passwords do not match. Please try again.";
    } else {
        $query = "INSERT INTO fuser (farmer_name, farmer_email, phone_number, farmer_password, status) 
                  VALUES ('$farmer_name', '$farmer_email', '$phone_number', '$farmer_password', 'pending')";

        if (mysqli_query($conn, $query)) {
            $message = "Registration successful! Await admin approval.";

            // Add registration notification
            $user_id = mysqli_insert_id($conn);
            $notification_query = "INSERT INTO notifications (user_id, type, details) 
                                    VALUES ($user_id, 'registration', 'New user registered. Awaiting approval.')";
            mysqli_query($conn, $notification_query);
        } else {
            $message = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        <form class="form-content" method="POST" action="register.php">
            <a href="index.php" style="color: rgb(255, 255, 255);font-size: 40px;text-decoration: none;" class="fa-solid fa-left-long"></a>
            <h1 style="text-align: center;">Register</h1>

            <label for="name">Username:</label>
            <input type="text" name="farmer_name" required>

            <label for="email">Email:</label>
            <input type="email" name="farmer_email" required>

            <label for="phone">Phone Number:</label>
            <input type="text" name="phone_number" required>

            <label for="password">Password:</label>
            <input type="password" name="farmer_password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" required>

            <a href="login.php" style="color: white;">Already have an account?</a>
            <button type="submit" class="btn btn-success">Register</button>

            <!-- عرض الرسائل أسفل الزر -->
            <?php if ($message): ?>
                <p style="color: white; text-align: center; margin-top: 10px;"><?php echo $message; ?></p>
            <?php endif; ?>
        </form>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>
</html>
