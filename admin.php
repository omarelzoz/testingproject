<?php
session_start();
include('db.php');

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

// Handle user actions (accept, block, deny, delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $farmer_id = intval($_POST['farmer_id']);
    
    if ($action === 'accept') {
        $update_query = "UPDATE fuser SET status = 'accepted' WHERE farmer_id = $farmer_id";
        mysqli_query($conn, $update_query);

        // Add notification for the farmer being accepted
        $notification_query = "INSERT INTO notifications (user_id, type, details) 
                                VALUES ($farmer_id, 'registration', 'Your registration has been accepted by the admin.')";
        mysqli_query($conn, $notification_query);
    } elseif ($action === 'block') {
        $update_query = "UPDATE fuser SET status = 'blocked' WHERE farmer_id = $farmer_id";
        mysqli_query($conn, $update_query);

        // Add notification for the farmer being blocked
        $notification_query = "INSERT INTO notifications (user_id, type, details) 
                                VALUES ($farmer_id, 'blocked', 'Your account has been blocked by the admin.')";
        mysqli_query($conn, $notification_query);
    } elseif ($action === 'delete') {
        // Prevent user from deleting their own account
         {
            // Perform the delete operation
            $delete_query = "DELETE FROM fuser WHERE farmer_id = $farmer_id"; 
            if (mysqli_query($conn, $delete_query)) {
                // Also remove related notifications
                $notification_delete_query = "DELETE FROM notifications WHERE user_id = $farmer_id";
                mysqli_query($conn, $notification_delete_query);
            }
        }
    }
}

// Fetch notifications
$notifications_query = "SELECT n.*, f.farmer_name FROM notifications n 
                        LEFT JOIN fuser f ON n.user_id = f.farmer_id 
                        ORDER BY n.timestamp DESC";
$notifications_result = mysqli_query($conn, $notifications_query);

// Fetch all users
$users_query = "SELECT * FROM fuser ORDER BY registration_timestamp DESC";
$users_result = mysqli_query($conn, $users_query);

$messages_query = "SELECT m.*, f.farmer_name FROM messages m 
                   LEFT JOIN fuser f ON m.sender_id = f.farmer_id 
                   WHERE m.receiver_id = {$_SESSION['admin_id']}
                   ORDER BY m.timestamp DESC";
$messages_result = mysqli_query($conn, $messages_query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #CCD9D3;
            color: #1A553B;
            margin: 0;
            padding: 0;
        }

        h1, h2 {
            text-align: center;
            color: #1A553B;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #ffffff;
        }

        th, td {
            border: 1px solid #1A553B;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #1A553B;
            color: #ffffff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e6e6e6;
        }

        ul {
            width: 80%;
            margin: 20px auto;
            padding: 0;
            list-style-type: none;
            background-color: #ffffff;
            border: 1px solid #1A553B;
            border-radius: 5px;
        }

        ul li {
            padding: 10px;
            border-bottom: 1px solid #1A553B;
        }

        ul li:last-child {
            border-bottom: none;
        }

        button, input[type="submit"] {
            background-color: #1A553B;
            color: #ffffff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
        }

        button:hover, input[type="submit"]:hover {
            background-color: #144027;
        }

        form {
            display: inline;
        }
        .message {
            text-align: center;
            color: green;
            font-weight: bold;
            margin-top: 20px; /* Adds some spacing above the message */
        }
    </style>

</head>
<body>
    <h1>Admin Dashboard</h1>
    <h2>Notifications</h2>
    <ul>
        <?php while ($notification = mysqli_fetch_assoc($notifications_result)): ?>
            <li>
                <?php echo $notification['farmer_name']; ?> - <?php echo $notification['details']; ?> (<?php echo $notification['timestamp']; ?>)
            </li>
        <?php endwhile; ?>
    </ul>

    <h2 style="text-align: center;">Users</h2>
    <?php
    if (isset($delete_query) && mysqli_affected_rows($conn) > 0) {
        echo '<p class="message">User account deleted successfully.</p>';
    }
    ?>
    <table>
        <thead>
            <tr>
                <th>Farmer Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = mysqli_fetch_assoc($users_result)): ?>
                <tr>
                    <td><?php echo $user['farmer_name']; ?></td>
                    <td><?php echo $user['farmer_email']; ?></td>
                    <td><?php echo $user['phone_number']; ?></td>
                    <td><?php echo ucfirst($user['status']); ?></td>
                    <td>
                        <form action="admin.php" method="POST" style="display:inline;">
                            <input type="hidden" name="farmer_id" value="<?php echo $user['farmer_id']; ?>">
                            <input type="submit" name="action" value="accept">
                            <input type="submit" name="action" value="block">
                            <input type="submit" name="action" value="delete">
                            <?php if ($user['farmer_id'] != $_SESSION['admin_id']): ?>
                                <input type="submit" name="action" value="delete">
                            <?php endif; ?>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <h2>Messages</h2>
    <table>
        <thead>
            <tr>
                <th>Sender Name</th>
                <th>Message</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($message = mysqli_fetch_assoc($messages_result)): ?>
                <tr>
                    <td><?php echo $message['farmer_name']; ?></td>
                    <td><?php echo $message['message']; ?></td>
                    <td><?php echo $message['timestamp']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
