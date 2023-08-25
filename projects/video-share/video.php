<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $targetDir = 'uploads/';
    $videoName = hash('sha256', uniqid());
    $targetFile = $targetDir . $videoName . '.mp4';

    $videoTitle = $_POST['videoTitle'];
    $videoTitle = $conn->real_escape_string($videoTitle);

    $videoDescription = $_POST['videoDescription'];
    $videoDescription = $conn->real_escape_string($videoDescription);

    $imageFile = $_FILES['imageFile'];

    $targetImageDir = 'images/';
    $imageName = hash('sha256', uniqid());
    $imageExtension = strtolower(pathinfo($imageFile['name'], PATHINFO_EXTENSION));
    $targetImageFile = $targetImageDir . $imageName . '.' . $imageExtension;

    if (
        $_FILES['videoFile']['type'] === 'video/mp4' &&
        $_FILES['videoFile']['size'] <= 50 * 1024 * 1024 &&
        in_array($imageExtension, array('jpg', 'jpeg', 'png'))
    ) {
        if (
            move_uploaded_file($_FILES['videoFile']['tmp_name'], $targetFile) &&
            move_uploaded_file($imageFile['tmp_name'], $targetImageFile)
        ) {
            $randomFolder = substr(md5(uniqid()), 0, 5);
            mkdir($randomFolder);

            $indexHtmlContent = '
<!DOCTYPE html>
<html>
<head>
    <title>Video Watch</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../cdn/videojs.css" rel="stylesheet" />
    <link rel="stylesheet" href="../cdn/bootstrap.css">
    <link rel="icon" href="">
    <style>
        .video-title {
        font-family: "Roboto", sans-serif;
        font-weight: 400;
        font-size: 2rem; 
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Video Player</h1>
          <video
    id="my-video"
    class="video-js vjs-16-9"
    controls
    preload="auto"
    data-setup="{}"
  >
    <source src="../' . $targetFile . '" type="video/mp4" />
    <p class="vjs-no-js">
      To view this video please enable JavaScript, and consider upgrading to a
      web browser that
      <a href="https://videojs.com/html5-video-support/" target="_blank"
        >supports HTML5 video</a
      >
    </p>
  </video>
        <br>
        <strong class="video-title">' . $videoTitle . '</strong><br>
        <p class="video-description">' . $videoDescription . '</p><br>
        <a href="../"><button class="btn btn-dark btn-sm">Homepage</button></a>
    </div>
    <script src="../cdn/videojs.js"></script>
</body>
</html>';

            file_put_contents($randomFolder . '/index.html', $indexHtmlContent);

            $videoUrl = $randomFolder . '';
            $sql = "INSERT INTO videos (url, title, description, image) VALUES ('$videoUrl', '$videoTitle', '$videoDescription', '$targetImageFile')";

            if ($conn->query($sql) === TRUE) {
                echo 'Video uploaded and processed. <a href="' . $randomFolder . '" target="_blank">Watch Video</a>';
            } else {
                echo 'Error inserting video URL into the database.';
            }

            $conn->close();
        } else {
            echo 'There was an error loading the file.';
        }
    } else {
        echo 'Please select a valid .mp4 file (maximum 50MB) and a valid image file (jpg, jpeg, png, gif).';
    }
} else {
    echo 'Incorrect request.';
}
?>