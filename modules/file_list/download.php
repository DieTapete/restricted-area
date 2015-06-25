<?php
define(MAIN_DIRECTORY, '../../');
require_once MAIN_DIRECTORY.'config.php';
require_once MAIN_DIRECTORY.'includes/functions.php';

secureSessionStart();
if (authorized()) {
  $currentUser = strip_tags($_SESSION['user']);
  //build path to download files
  $downloadPath = MAIN_DIRECTORY.DOWNLOAD_DIRECTORY;
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
      header("Pragma: public");
      header("Expires: 0");
      header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
      header("Cache-Control: public");
      header("Content-Description: File Transfer");
      header("Content-type: application/octet-stream");
      header("Content-Disposition: attachment; filename=\"".basename($file)."\"");
      header("Content-Transfer-Encoding: binary");
      header("Content-Length: " . filesize($file));
      ob_end_flush();
      @readfile($file);
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
