<?php
define('DEBUG', TRUE);

define('TITLE', 'My App');
define('SUB_TITLE', 'BACKEND');
// for more security choose a folder in the document root directory
define('DOWNLOAD_DIRECTORY', './files/');

//As of now
define('USE_SSL', FALSE);
define('SESSION_NAME', 'restricted_area_session');

$LOGINS = array(
  //create new hashes with create_hash.php and paste the hash in here
  //example user:user1 password: password
  'user1'=>'sha256:10000:Qdu+d/Gyr9Mg2V8CQi3XU8WsUFMXhOPB:mNtLrmOYJxMfuFxPRs4iTxZON3vYmiqu'
  );

?>
