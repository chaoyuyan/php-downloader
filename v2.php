<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $remote_file_url = $_POST['file_url'];
    $local_file = basename($remote_file_url);
    
    $ch = curl_init($remote_file_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_NOPROGRESS, false);
    curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, function($resource, $download_size, $downloaded, $upload_size, $uploaded) {
        if ($download_size > 0) {
            $progress = round($downloaded / $download_size * 100);
            echo "<progress value='$progress' max='100'></progress>";
            flush();
        }
    });
    
    $copy = curl_exec($ch);
    curl_close($ch);
    
    if (!$copy) {
        echo '<div style="color: red;">Download failed</div>';
    } else {
        file_put_contents($local_file, $copy);
        echo '<div style="color: green;">Download successful</div>';
    }
}
?>

<form method="POST">
    <label for="file_url">Enter file URL:</label>
    <input type="text" name="file_url" id="file_url">
    <button type="submit">Download</button>
</form>
