<?php
//List files (no hidden files) in the download directory for the current user
$directory = DOWNLOAD_DIRECTORY.$currentUser.'/';

if (is_dir($directory) && $handle = opendir($directory)) {
  echo '<div class="list-group">';
    while (false !== ($entry = readdir($handle))) {
        if (substr($entry, 0, 1) != "." && $entry != "..") {
            if (is_file($directory.$entry)) {
              $filesize = humanReadableFileSize(filesize($directory.$entry));
              echo '<a class="list-group-item" href="modules/download/download.php?file='.$entry.'"><span class="label label-success">DOWNLOAD</span> '.$entry.' ('.$filesize.')</a>';
            }
        }
    }
    closedir($handle);
  echo '</div>';
}
?>
