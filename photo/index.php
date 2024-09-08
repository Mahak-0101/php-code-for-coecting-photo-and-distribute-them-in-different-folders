<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user input
    $branch = $_POST['branch'];
    $year = $_POST['year'];
    $rollNo = $_POST['rollno'];
    
    // Define the folder based on branch and year
    $folder = $branch . " " . $year;
    
    // Create the folder if it doesn't exist
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    // Handle the file upload
    $target_dir = $folder . "/";
    $imageFileType = strtolower(pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION));
    
    // Check if the file is a JPG
    if ($imageFileType != "jpg") {
        echo "Only JPG files are allowed.";
        exit();
    }

    // Rename the file to the roll number with .jpg extension
    $new_filename = $target_dir . $rollNo . ".jpg";

    // Move the uploaded file to the correct folder
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $new_filename)) {
        echo "The file has been uploaded as " . $rollNo . ".jpg";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Photo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: url('./background/clg.jpeg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            position: relative;
            overflow: hidden;
        }

        /* Semi-transparent overlay */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4); /* Semi-transparent dark overlay */
            z-index: -1;
        }

        .form-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .form-container:hover {
            transform: scale(1.02);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: 600;
            animation: fadeIn 1s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        label {
            font-size: 14px;
            font-weight: 500;
            color: #666;
            margin-bottom: 5px;
            display: block;
            position: relative;
            padding-left: 30px;
            transition: color 0.3s ease;
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #007bff;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        input[type="text"], select, input[type="file"] {
            width: 100%;
            padding: 12px 40px;
            margin: 5px 0 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
            background-color: #f9f9f9;
            transition: border-color 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
        }

        input[type="text"]:focus, select:focus, input[type="file"]:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
            background-color: #ffffff;
        }

        input[type="submit"] {
            width: 100%;
            background: #007bff;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.5s ease, transform 0.2s ease;
        }

        input[type="submit"]:hover {
            background: #0056b3;
            transform: translateY(-2px);
        }

        input[type="submit"]:active {
            transform: translateY(1px);
        }

        .form-container select, .form-container input[type="file"] {
            margin-bottom: 20px;
        }

        @media (max-width: 500px) {
            .form-container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2><i class="fas fa-upload"></i> Upload Your Photo</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <label for="branch">Select Branch:</label>
                <i class="fas fa-building"></i>
                <select name="branch" id="branch" required>
                    <option value="FT">FT</option>
                    <option value="CS">CS</option>
                </select>
            </div>
            
            <div class="input-group">
                <label for="year">Select Year:</label>
                <i class="fas fa-calendar-alt"></i>
                <select name="year" id="year" required>
                    <option value="2nd Year">2nd Year</option>
                    <option value="3rd Year">3rd Year</option>
                </select>
            </div>
            
            <div class="input-group">
                <label for="rollno">Roll Number:</label>
                <i class="fas fa-id-card"></i>
                <input type="text" name="rollno" id="rollno" required>
            </div>
            
            <div class="input-group">
                <label for="photo">Upload Photo (JPG only):</label>
                <i class="fas fa-file-image"></i>
                <input type="file" name="photo" id="photo" accept=".jpg" required>
            </div>
            
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
