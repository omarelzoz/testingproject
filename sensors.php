<?php
// الاتصال بقاعدة البيانات
include('db.php');

// جلب آخر قراءة من جدول sensors
$query = "SELECT * FROM sensors ORDER BY timestamp DESC LIMIT 1";
$result = mysqli_query($conn, $query);
$sensor_data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Page</title>
    <style>
        body {
            background-color: #CCD9D3;
            color: #1A553B;
            font-family: Arial, sans-serif;
        }

        .container {
            width: 80%;
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }

        .image-container {
            margin-bottom: 20px;
        }

        img {
            width: 100%;
            border-radius: 10px;
        }

        .info {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .info label {
            margin: 5px 0;
            font-size: 18px;
        }

        .info .value {
            font-weight: bold;
            font-size: 22px;
            color: #1A553B;
        }

        .info .optimal {
            display: flex;
            flex-direction: column;
            margin-top: 10px;
        }
        .upload-form {
    margin-top: 20px;
    text-align: center;
}

.upload-label {
    display: inline-block;
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    font-weight: bold;
    border-radius: 10px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.upload-label:hover {
    background-color: #45a049;
}
    </style>
</head>
<body>

<div class="container">
    <div class="image-container">
        <img src="images/steven-weeks-DUPFowqI6oI-unsplash.jpg" alt="Monitoring Image">
    </div>

    <div class="info">
        <label>Temperature: <span class="value">
            <?php echo isset($sensor_data['temperature']) ? $sensor_data['temperature'] . "°C" : "N/A"; ?>
        </span></label>

        <label>Soil Moisture: <span class="value">
            <?php echo isset($sensor_data['soil_moisture']) ? $sensor_data['soil_moisture'] . "%" : "N/A"; ?>
        </span></label>

        <label>Air Humidity: <span class="value">
            <?php echo isset($sensor_data['air_humidity']) ? $sensor_data['air_humidity'] . "%" : "N/A"; ?>
        </span></label>

        <label>Light Intensity: <span class="value">
            <?php echo isset($sensor_data['light_intensity']) ? $sensor_data['light_intensity'] . " lux" : "N/A"; ?>
        </span></label>

        <label>Water Container Status: <span class="value">
            <?php 
                if (isset($sensor_data['water_level'])) {
                    echo $sensor_data['water_level'] == 'low' ? "Low" : "High";
                } else {
                    echo "N/A";
                }
            ?>
        </span></label>

        <div class="optimal">
            <label>Optimal Temperature: <span class="value">23°C</span></label>
            <label>Optimal Soil Moisture: <span class="value">60%</span></label>
        </div>

        <!-- Upload image -->
        <label for="imageUpload" class="upload-label">
            Add Image
        </label>
        <input type="file" name="image" id="imageUpload" accept="image/*" style="display: none;">

        <!-- Display disease result -->
        <label>Disease: <span id="disease" class="value">N/A</span></label>
        <label id="confidence"></label>

    </div>
</div>


</body>
</html>
