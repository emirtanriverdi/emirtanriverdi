<!DOCTYPE html>
<html>
<head>
    <title>Video Upload</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.emirtanriverdi.rf.gd/bootstrap.css">
    <link rel="icon" href="https://cdn.emirtanriverdi.rf.gd/main-favicon.png">
</head>
<body>
    <div class="container mt-5">
        <h1>Video Upload and Watch</h1>
        <form id="uploadForm" enctype="multipart/form-data">
            <input type="file" name="videoFile" accept=".mp4"><br><br>
            <input type="text" name="videoTitle" placeholder="Enter Video Title" required><br>
            <button type="submit" class="btn btn-primary mt-3">Upload</button>
            <div class="progress mt-3" style="display:none;">
                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
            </div>
        </form>
        <div id="message" class="mt-3"></div><br>
        <a href="./"><button class="btn btn-dark btn-sm">Homepage</button></a>
    </div>

    <script src="https://cdn.emirtanriverdi.rf.gd/jquery.js"></script>
    <script>
        $(document).ready(function() {
            $('#uploadForm').on('submit', function(event) {
                event.preventDefault();

                var formData = new FormData($(this)[0]);
                var progressBar = $('.progress');
                var progressBarValue = progressBar.find('.progress-bar');
                var messageDiv = $('#message');

                progressBar.show();

                $.ajax({
                    url: 'video',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function(event) {
                            if (event.lengthComputable) {
                                var percent = (event.loaded / event.total) * 100;
                                progressBarValue.width(percent + '%').text(percent.toFixed(0) + '%');
                            }
                        }, false);
                        return xhr;
                    },
                    success: function(response) {
                        progressBar.hide();
                        messageDiv.html(response);
                    },
                    error: function(xhr, status, error) {
                        progressBar.hide();
                        messageDiv.html('error: ' + xhr.statusText);
                    }
                });
            });
        });
    </script>
</body>
</html>