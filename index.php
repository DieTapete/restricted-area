<?php
session_start();
session_regenerate_id();

require_once('config.php');
require_once('includes/pw.php');
require_once('includes/functions.php');

// ***************************************** //
// **********   DECLARE VARIABLES  ********** //
// ***************************************** //
$self = $_SERVER['REQUEST_URI'];

//LOG OUT USER IF ?logout IS SET
if(isset($_GET['logout']))
{
    unset($_SESSION['user']);
    unset($_SESSION['hash']);
}
// IF USER IS LOGGED IN SHOW CONTENT
if (authorized()) {
    define('USES_APP', TRUE);
    $currentUser = $_SESSION['user'];

    include ("includes/head.php");
    include ("includes/main.php");
}
//IF LOGIN FORM IS SUBMITTED CHECK PASSWORD
else if (isset($_POST['submit'])) {
    $username = htmlspecialchars($_POST['username']);
    if (strlen($username) > 30) die();
    $userFound = FALSE;
    foreach ($LOGINS as $user => $hash) {
        if ($username == $user && validate_password($_POST['password'], $hash)){
            // echo 'user: '.$user;
            $_SESSION['user'] = $user;
            $_SESSION['hash'] = $hash;
            header('Location: '.$_SERVER['PHP_SELF']);
            die();
        }
    }

    include ("includes/head.php");
    //NO MATCH FOUND, DISPLAY FORM WITH ERROR
    showLoginForm('Wrong combination of username and password.');
}
// SHOW LOGIN BY DEFAULT
else {
    include ("includes/head.php");
    showLoginForm('');
}

include ("includes/footer.php");

function showLoginForm($errorMessage = ""){ ?>

<div class="container">
<div class="row">
<form class="form-signin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method='post'>
        <input type="text" class="form-control" placeholder="username" required="" autofocus="" name="username" id="username">
        <input type="password" class="form-control" placeholder="password" required="" name="password" id="password">
        <button id="btn_login" class="btn btn-primary btn-block" name="submit" type="submit" value="submit">Login</button>
</form>
</div>
<?php if (strlen($errorMessage) > 0) { ?>
<div class="row">
    <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
</div>
<?php } ?>
</div>


<?php } ?>
