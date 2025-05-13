<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Center Content</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        .container {
            display: flex;
            flex-direction: column; /* عشان نخلي العناصر تحت بعض */
            justify-content: center; /* عمودي */
            align-items: center;     /* أفقي */
            height: 100vh;
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

        .result {
            margin-top: 30px;
            font-size: 28px;
            font-weight: bold;
        }

        .value {
            color: #333;
        }
    </style>
</head>
<body>

    <div class="container">
        <label for="imageUpload" class="upload-label">Add Image</label>
        <input type="file" name="image" id="imageUpload" accept="image/*" style="display: none;">

        <div class="result">
            <div>Disease: <span id="disease" class="value">N/A</span></div>
            <div id="confidence"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#imageUpload').on('change', function() {
                var formData = new FormData();
                var file = $('#imageUpload')[0].files[0];
                formData.append('file', file);

                $.ajax({
                    url: 'http://localhost:5000/predict',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.disease) {
                            $('#disease').text(response.disease);
                            $('#confidence').text('Confidence: ' + response.confidence);
                        } else {
                            $('#disease').text('No disease detected');
                            $('#confidence').text('');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error: ' + error);
                    }
                });
            });
        });
    </script>

</body>
</html>
