<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload and Download</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            max-width: 600px;
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
        }

        h1 {
            text-align: center;
            font-size: 24px;
        }

        input[type="file"] {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            margin-top: 10px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background-color: #f4f4f4;
            margin: 5px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        a {
            color: #007BFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            h1 {
                font-size: 20px;
            }

            button {
                font-size: 14px;
            }

            li {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Upload and Download Files</h1>

        <!-- Upload Form -->
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileToUpload">
            <button type="submit" name="submit">Upload File</button>
        </form>

        <!-- Display the uploaded files -->
        <div id="fileListContainer">
            <h2>Uploaded Files</h2>
            <ul>
                <?php
                // Directory to save uploaded files
                $target_dir = "uploads/";

                // Create uploads folder if it doesn't exist
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }

                // Handle file upload
                if (isset($_POST["submit"])) {
                    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
                    echo "<p>File uploaded successfully!</p>";
                }

                // List all files in the uploads folder
                $files = scandir($target_dir);
                foreach ($files as $file) {
                    if ($file != "." && $file != "..") {
                        echo "<li><a href='$target_dir$file' download>$file</a></li>";
                    }
                }
                ?>
            </ul>
        </div>
    </div>

</body>
</html>
