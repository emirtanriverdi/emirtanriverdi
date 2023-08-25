<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap" rel="stylesheet">
    <link rel="icon" href="https://cdn.emirtanriverdi.rf.gd/main-favicon.png">
    <link rel="stylesheet" href="https://cdn.emirtanriverdi.rf.gd/bootstrap.css">
    <title>Video List</title>
    <style>
        .list-group-item {
            font-family: 'Roboto', sans-serif;
            width: 350px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        a {
        text-decoration: none;
        color: #17a2b8;
    }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Video Watch and Share</h1>
        <ul class="list-group mt-3">
            <?php
            require_once('connect.php');
            
            $sql = "SELECT title, url FROM videos";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<li class="list-group-item"><a href="' . $row["url"] . '">' . $row["title"] . '</a></li>';
                }
            } else {
                echo '<li class="list-group-item">vıde o not fond</li>';
            }

            $conn->close();
            ?>
        </ul><br>
        <a href="upload"><button class="btn btn-primary">Upload</button></a>
    </div>
</body>
</html>