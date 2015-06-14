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

function secureSessionStart() {
    $sessionName = SESSION_NAME;
    // Prevent javaScript from accessing cookies
    $httponly = true;
    // force using cookies
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        die("Error: Could not initiate a safe session. Please enable cookies.");
    }
    ini_set('session.use_trans_sid', 0);
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"],
        $cookieParams["domain"],
        USE_SSL,
        $httponly);

    session_name($sessionName);
    session_start();
    session_regenerate_id();
}

if (defined('DEBUG')) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

?>
