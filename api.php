<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");

// بيانات الاتصال بقاعدة البيانات
$host = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "newproject"; 

$conn = new mysqli($host, $username, $password, $database);

// التحقق من الاتصال بقاعدة البيانات
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database Connection Failed"]);
    exit;
}

// تحديد نوع الطلب (GET أو POST)
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case "get_farmers":
        getData($conn, "fuser");
        break;
    case "get_sensors":
        getData($conn, "sensors");
        break;
    case "get_notifications":
        getData($conn, "notifications");
        break;
    case "get_messages":
        getData($conn, "messages");
        break;
    case "register_user":
        registerUser($conn);
        break;
    case "login_user":
        loginUser($conn);
        break;
    default:
        echo json_encode(["status" => "error", "message" => "Invalid action"]);
        break;
}

// دالة تسجيل مستخدم جديد
function registerUser($conn) {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['farmer_name'], $data['farmer_email'], $data['phone_number'], $data['farmer_password'])) {
        echo json_encode(["status" => "error", "message" => "Missing required fields"]);
        exit;
    }

    $farmer_name = mysqli_real_escape_string($conn, $data['farmer_name']);
    $farmer_email = mysqli_real_escape_string($conn, $data['farmer_email']);
    $phone_number = mysqli_real_escape_string($conn, $data['phone_number']);
    $farmer_password = mysqli_real_escape_string($conn, $data['farmer_password']);

    // التحقق من البريد الإلكتروني
    $check_query = "SELECT * FROM fuser WHERE farmer_email = '$farmer_email'";
    $result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($result) > 0) {
        echo json_encode(["status" => "error", "message" => "Email already exists"]);
        exit;
    }

    $query = "INSERT INTO fuser (farmer_name, farmer_email, phone_number, farmer_password, status) 
              VALUES ('$farmer_name', '$farmer_email', '$phone_number', '$farmer_password', 'pending')";

    if (mysqli_query($conn, $query)) {
        $user_id = mysqli_insert_id($conn);
        mysqli_query($conn, "INSERT INTO notifications (user_id, type, details) VALUES ($user_id, 'registration', 'New user registered. Awaiting approval.')");

        echo json_encode(["status" => "success", "message" => "Registration successful! Await admin approval"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . mysqli_error($conn)]);
    }
    exit;
}

// دالة تسجيل الدخول
function loginUser($conn) {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['farmer_email'], $data['farmer_password'])) {
        echo json_encode(["status" => "error", "message" => "Missing required fields"]);
        exit;
    }

    $farmer_email = mysqli_real_escape_string($conn, $data['farmer_email']);
    $farmer_password = mysqli_real_escape_string($conn, $data['farmer_password']);

    $query = "SELECT * FROM fuser WHERE farmer_email = '$farmer_email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if ($user['farmer_password'] === $farmer_password) {
            if ($user['status'] === 'accepted') {
                echo json_encode([
                    "status" => "success",
                    "message" => "Login successful",
                    "user_id" => $user['farmer_id'],
                    "farmer_name" => $user['farmer_name']
                ]);
            } else {
                echo json_encode(["status" => "error", "message" => "Account not approved yet"]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid password"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "No user found with this email"]);
    }
    exit;
}

// دالة جلب البيانات من أي جدول
function getData($conn, $table) {
    $sql = "SELECT * FROM $table";
    $result = $conn->query($sql);
    $data = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $clean_row = array_map('htmlspecialchars', $row);
            $data[] = $clean_row;
        }
        echo json_encode(["status" => "success", "data" => $data]);
    } else {
        echo json_encode(["status" => "error", "message" => "No data found"]);
    }
    exit;
}

// إغلاق الاتصال بقاعدة البيانات
$conn->close();
?>
