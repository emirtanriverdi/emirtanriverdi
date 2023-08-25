<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap" rel="stylesheet">
    <link rel="icon" href="">
    <link rel="stylesheet" href="cdn/bootstrap.css">
    <title>Video List</title>
<style>
    .video-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }
    .video-item {
        flex: 0 0 calc(33.33% - 20px); /* Adjust the width as needed */
        border: 1px solid #ccc;
        padding: 10px;
        box-sizing: border-box;
    }
    .video-thumbnail {
            width: 400px;
            height: 220px;
    }
    a {
        text-decoration: none;
        color: black;
    }
</style>
</head>
<body>
<div class="container mt-5">
    <h1>Video Watch and Share</h1>
    <div class="video-container mt-3">
        <?php
        require_once('connect.php');
        
        $sql = "SELECT title, url, image FROM videos";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="video-item"><a href="' . $row["url"] . '"><img class="video-thumbnail" src="' . $row["image"] . '" alt="' . $row["title"] . '"></a><a href="' . $row["url"] . '">' . $row["title"] . '</a></div>';
            }
        } else {
            echo '<div class="video-item">Video not found</div>';
        }

        $conn->close();
        ?>
    </div>
    <br>
    <a href="upload"><button class="btn btn-primary">Upload</button></a>
</div>
</body>
</html>