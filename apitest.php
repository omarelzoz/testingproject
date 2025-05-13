<?php
function sendImageToPredictAPI($imagePath) {
    $url = 'http://localhost:5000/predict'; // Use public IP/domain if remote

    if (!file_exists($imagePath)) {
        die("File not found: $imagePath");
    }

    // Create a CURLFile object
    $cfile = curl_file_create(
        $imagePath,
        mime_content_type($imagePath),
        basename($imagePath)
    );

    // Set POST fields
    $postfields = ['file' => $cfile];

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);

    // Execute request
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
        return;
    }

    curl_close($ch);

    // Decode and return JSON response
    $decoded = json_decode($response, true);
    if (isset($decoded['error'])) {
        echo "API Error: " . $decoded['error'];
    } else {
        echo "Disease: " . $decoded['disease'] . "\n";
        echo "Confidence: " . $decoded['confidence'] . "\n";
    }
}

// Example usage
sendImageToPredictAPI('uploads/leaf.jpeg'); // Replace with your image path
?>