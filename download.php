<?php
require_once('config.php');
require_once('includes/functions.php');

session_start();
if (authorized()) {
  $currentUser = strip_tags($_SESSION['user']);
  //build path to download files
  $downloadPath = DOWNLOAD_DIRECTORY;
  if (substr($downloadPath, -1) != '/'){
      $downloadPath = $downloadPath.'/';
  }
  $downloadPath = $downloadPath.$currentUser.'/';

  if (isset($_GET['file']))
  {
    $file = urldecode($_GET['file']);
    if (strpos($file, '../') != FALSE || strpos($file, '/') === 0){
      //Malicious input, fail silently
      die();
    }
    $file = $downloadPath . $file;
    if (file_exists($file))
    {
      header("Content-Length: " . filesize($file));
      header('Content-Disposition: attachment; filename="'.basename($file).'"');
      // Send file for download
       readfile($file);
    }
    else
    {
      // Requested file does not exist
      header("HTTP/1.0 404 Not Found");
      echo "<h1>Error 404 Not Found</h1>";
      echo "The file that you have requested could not be found.";
      exit();
    }
  }
}
?>
