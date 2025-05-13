<?php
session_start();
include('db.php');

// التحقق إذا كان المستخدم مسجل الدخول
if (!isset($_SESSION['farmer_id'])) {
    header("Location: login.php");
    exit;
}

// جلب بيانات المستخدم الحالية
$farmer_id = $_SESSION['farmer_id'];
$query = "SELECT * FROM fuser WHERE farmer_id = '$farmer_id'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "<p style='color:red;'>Error fetching user data.</p>";
    exit;
}

// معالجة الطلب عند الضغط على زر التحديث
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $farmer_name = mysqli_real_escape_string($conn, $_POST['farmer_name']);
    $farmer_email = mysqli_real_escape_string($conn, $_POST['farmer_email']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $current_password = mysqli_real_escape_string($conn, $_POST['current_password']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);

    // التحقق من صحة كلمة المرور الحالية
    if (!empty($current_password) && !empty($new_password)) {
        if (password_verify($current_password, $user['farmer_password'])) {
            // تحديث كلمة المرور الجديدة
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_password_query = "UPDATE fuser SET farmer_password = '$hashed_password' WHERE farmer_id = '$farmer_id'";
            if (mysqli_query($conn, $update_password_query)) {
                echo "<p style='color:green;'>Password updated successfully!</p>";
            } else {
                echo "<p style='color:red;'>Error updating password: " . mysqli_error($conn) . "</p>";
            }
        } else {
            echo "<p style='color:red;'>Current password is incorrect.</p>";
        }
    }

    // تحديث البيانات الشخصية
    $update_query = "UPDATE fuser 
                     SET farmer_name = '$farmer_name', 
                         farmer_email = '$farmer_email', 
                         phone_number = '$phone_number' 
                     WHERE farmer_id = '$farmer_id'";
    if (mysqli_query($conn, $update_query)) {
        echo "<p style='color:green;'>Profile updated successfully!</p>";
        $_SESSION['farmer_name'] = $farmer_name;
    } else {
        echo "<p style='color:red;'>Error updating profile: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .settings-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-group label {
            font-weight: bold;
        }
        .btn {
            background-color: #28a745;
            color: white;
        }
        .btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="settings-container">
    <a href="index.php" style="color:#218838;font-size: 40px;text-decoration: none;" class="fa-solid fa-left-long"></a>
        <h2>Update Profile</h2>
        <form method="POST" action="settings.php">
        
            <div class="form-group">
                <label for="farmer_name">Name:</label>
                <input type="text" class="form-control" id="farmer_name" name="farmer_name" value="<?php echo htmlspecialchars($user['farmer_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="farmer_email">Email:</label>
                <input type="email" class="form-control" id="farmer_email" name="farmer_email" value="<?php echo htmlspecialchars($user['farmer_email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($user['phone_number']); ?>" required>
            </div>
            <hr>
            
            <div class="form-group">
                <label for="current_password">Current Password:</label>
                <input type="password" class="form-control" id="current_password" name="current_password">
            </div>
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" class="form-control" id="new_password" name="new_password">
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</body>
</html>
