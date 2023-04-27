<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $remote_file_url = $_POST['file_url'];
    $local_file = basename($remote_file_url);
    $copy = copy($remote_file_url, $local_file);
    if (!$copy) {
        echo '<div style="color: red;">Download failed</div>';
    } else {
        echo '<div style="color: green;">Download successful</div>';
    }
}
?>

<form method="POST">
    <label for="file_url">Enter file URL:</label>
    <input type="text" name="file_url" id="file_url">
    <button type="submit">Download</button>
</form>
