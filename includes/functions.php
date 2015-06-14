<?php
function authorized(){
  global $LOGINS;
  return isset($_SESSION['user']) &&
         isset($_SESSION['hash']) &&
         $_SESSION['hash'] == $LOGINS[$_SESSION['user']];
}

//default escape
function e($value){
  return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function humanReadableFileSize($size,$unit="") {
  if( (!$unit && $size >= 1<<30) || $unit == "GB")
    return number_format($size/(1<<30),2)." GB";
  if( (!$unit && $size >= 1<<20) || $unit == "MB")
    return number_format($size/(1<<20),2)." MB";
  if( (!$unit && $size >= 1<<10) || $unit == "KB")
    return number_format($size/(1<<10),2)." KB";
  return number_format($size)." bytes";
}

if (defined('DEBUG')) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

?>
