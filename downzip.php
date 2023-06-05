<?php
if (!class_exists('ZipArchive')) {
    die('ZipArchive class not found');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $remote_file_url = $_POST['file_url'];
    $local_file = basename($remote_file_url);
    $copy = copy($remote_file_url, $local_file);
    if (!$copy) {
        echo '<div style="color: red;">Download failed</div>';
    } else {
        $zip = new ZipArchive();
        $res = $zip->open($local_file);
        if ($res === TRUE) {
            $zip->extractTo('./');
            $zip->close();
            echo '<div style="color: green;">Download successful and extracted</div>';
        } else {
            echo '<div style="color: red;">Download failed or unzip failed</div>';
        }
        echo '<script>progressBar.style.display = "none" </script>';
    }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>download & unzip</title>
    <style>#progressBar {  display: none;}</style>
    <script>function aa(){progressBar.style.display = "block"}</script>
  </head>
  <body>
    
<div id="progressBar">downloading</div>

<form method="POST" onsubmit="startDownload(); return false;">
    <label for="file_url">Enter file URL:</label>
    <textarea type="text" name="file_url" id="file_url"></textarea>
    <button id="downloadBtn" type="submit" onclick="aa()">Download</button>
</form>
    
  </body>
</html>



