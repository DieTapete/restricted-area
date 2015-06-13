<?php
 require_once("includes/pw.php");
 require_once("includes/functions.php");
 include('config.php');
 include('includes/head.php');
 function printError($error) {
  ?>
    <div class="col-sm-offset-2 col-sm-10">
      <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        <?php echo $error; ?>
      </div>
    </div>
<?php } ?>

<div class="container">
  <div class="row">
    <?php
    //Show warning when running on server
    $hostIP = gethostbyname($_SERVER['SERVER_NAME']);
    if(!$hostIP == '127.0.0.1') { ?>
      <div class="alert alert-info alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
          For more security don't upload this file to your server but use it in a local environment instead.
      </div>
    <?php } ?>
    <h2 class="">Generate Hash</h2>
    <form role="form" class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="form-group">
            <label class="col-sm-2 control-label" for="username" required>Username:</label>
            <div class="col-sm-10">
                <input id="username" name="username" class="form-control" autofocus="" placeholder="" value="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="password">Password:</label>
            <div class="col-sm-10">
                <input id="password" name="password" class="form-control" autofocus="" placeholder=""  required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button class="btn btn-primary" name="submit" type="submit" value="submit">Generate Hash</button>
            </div>

        </div>
    </form>
  </div>


<?php

  if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = e($_POST['username']);
    $password = e($_POST['password']);
    if (strlen($username) > 40 || strlen($password > 40)){
      printError('Username and/or password too long.');
    }
    else if (strlen($password) < 5){
      printError('Please choose a password with at least 5 letters.');
    }
    else{
      ?>
      <div class="row">
        <div class="col-sm-offset-2 col-sm-10">
          <div class="alert alert-success"  role="alert">
            <p>Hash for user <?php echo $username;?>:<br>
            <code><?php echo create_hash($password); ?></code>
            </p>
            <p><small>Copy and paste this into your LOGINS array.</small></p>

          </div>
        </div>
      </div>
      <?php
    }
  }
?>
</div>
  <?php include('includes/footer.php');
?>
