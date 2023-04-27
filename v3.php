<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $remote_file_url = $_POST['file_url'];
    $local_file = basename($remote_file_url);
    $copy = copy($remote_file_url, $local_file);
    if (!$copy) {
        echo '<div style="color: red;">Download failed</div>';
    } else {
        echo '<script>progressBar.style.display = "none" </script>';
        echo '<div style="color: green;">Download successful</div>';
    }
}
?>
<progress id="progressBar" value="0" max="100"></progress>
<form method="POST" onsubmit="startDownload(); return false;">
    <label for="file_url">Enter file URL:</label>
    <input type="text" name="file_url" id="file_url">
   <button id="downloadBtn" type="submit">Download</button>
</form>

<script>
const downloadBtn = document.getElementById('downloadBtn');
const progressBar = document.getElementById('progressBar');

downloadBtn.addEventListener('click', () => {
  progressBar.style.display = 'inline-block'; // or 'block' if you want a vertical progress bar
  let progress = 0;
  const intervalId = setInterval(() => {
    progress += 1;
    progressBar.value = progress;

    if (progress === 100) {
      clearInterval(intervalId);
    }
  }, 50); // set the interval time to update the progress bar
});
</script>

<style>
#progressBar {
  display: none;
}
</style>
