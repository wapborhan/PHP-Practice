<?php
include '../include/functions.php';
include '../include/config.php';
if (isset($_SESSION['loginsuccessuser'])) {
if(isset($_POST['changepass'])){
  $id = $_GET['change-password'];
  $check_id = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user WHERE email = '{$_SESSION['loginsuccessuseremail']}' AND id = '$id'"));
  if($check_id == 1){
  $old_pass = mysqli_real_escape_string($conn, md5($_POST['oldpass']));
  $new_pass = mysqli_real_escape_string($conn, $_POST['newpass']);
  $cnew_pass = mysqli_real_escape_string($conn, $_POST['cnewpass']);
  if(!isset($_SESSION['loginsuccessuser'])){
       $_SESSION['errorMessage'] = "Login required.";
        redirectTo("/signin.php");
  }elseif(empty($old_pass) || empty($new_pass) || empty($cnew_pass)){
    $_SESSION['errorMessage'] = "All feild are required.";
  }elseif ($new_pass != $cnew_pass) {
    $_SESSION['errorMessage'] = "Confirm password not matched!";
  }elseif (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user WHERE password = '$old_pass' AND id = '$id'")) != 1) {
    $_SESSION['errorMessage'] = "The password you entered is incorrect.";
  }else{
    $password = md5($cnew_pass);
    $query = mysqli_query($conn, "UPDATE user SET password = '$password' WHERE id = '$id'");
    if($query){
      $_SESSION['successMessage'] = "Password changed.";
      redirectTo("settings.php");
    }else{
      $_SESSION['errorMessage'] = "Something went wrong.";
      redirectTo("settings.php");
      }
    }
  }else{
    $_SESSION['errorMessage'] = "Something went wrong.";
    redirectTo("settings.php");
  }
}
if (isset($_POST['update'])) {
   $id = $_GET['edit-id'];
   $check_id = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user WHERE email = '{$_SESSION['loginsuccessuseremail']}' AND id = '$id'"));
   if($check_id == 1){
   $first_name = mysqli_real_escape_string($conn, $_POST['firstname']);
   $last_name = mysqli_real_escape_string($conn, $_POST['lastname']);
   $password = mysqli_real_escape_string($conn, md5($_POST['password']));
   if(!isset($_SESSION['loginsuccessuser'])){
       $_SESSION['errorMessage'] = "Login required.";
        redirectTo("/signin.php");
  }elseif(empty($first_name) || empty($last_name) || empty($password)){
        $_SESSION['errorMessage'] = "All feild are required.";
  } elseif (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user WHERE password = '$password' AND id = '$id'")) != 1) {
       $_SESSION['errorMessage'] = "The password you entered is incorrect.";
  }else{
        $query = mysqli_query($conn, "UPDATE user SET first_name = '$first_name', last_name = '$last_name' WHERE id = '$id'");
        if ($query) {
      $_SESSION['successMessage'] = "Information changed.";
      redirectTo("settings.php");
        } else{
      $_SESSION['errorMessage'] = "Something went wrong.";
      redirectTo("settings.php");
        }
      }
    }else{
    $_SESSION['errorMessage'] = "Something went wrong.";
    redirectTo("settings.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php
$site_info_result = mysqli_query($conn, "SELECT * FROM site_settings");
while ($siteinfo = mysqli_fetch_assoc($site_info_result)) {
    echo "Profile Settings - " . $siteinfo['site_name'];

?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='../upload/img/<?php echo $siteinfo['favicon']; ?>' rel='icon' type='image/x-icon'/>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin-style.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/dashboard.css">
  </head>
  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">
        <?php
        }
$site_info_result = mysqli_query($conn, "SELECT * FROM site_settings");
while ($siteinfo = mysqli_fetch_assoc($site_info_result)) {
    echo $siteinfo['site_name'];
}
?>
      </a>
      <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
        </span>
      </button>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="logout.php">
            <i class="fa fa-sign-out" aria-hidden="true">
            </i>&nbsp;Sign out
          </a>
        </li>
      </ul>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
          <div class="sidebar-sticky pt-3">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" href="index.php">
                  <i class="fa fa-dashboard" aria-hidden="true">
                  </i>&nbsp;Dashboard
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="posts.php">
                  <i class="fa fa-pencil-square" aria-hidden="true">
                  </i>&nbsp;Posts
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="comments.php">
                  <i class="fa fa-comment" aria-hidden="true">
                  </i>&nbsp;Comments
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="files.php">
                  <i class="fa fa-picture-o" aria-hidden="true">
                  </i>&nbsp;Media Files
                </a>
              </li>
            </ul>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link active" href="settings.php">
                  <i class="fa fa-cogs" aria-hidden="true">
                  </i>&nbsp;Profile Settings
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../index.php" target="_blank">
                  <i class="fa fa-eye" aria-hidden="true">
                  </i>&nbsp;View Site
                </a>
              </li>
            </ul>
          </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h4>
              <a href="index.php">Home</a> / Profile Settings
            </h4>
          </div>
          <div class="col-sm-12">
            <?php
echo errorMessage();
echo successMessage();
if (isset($_GET['edit-id'])) {
  $user_id = $_GET['edit-id'];
  $check_id = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user WHERE email = '{$_SESSION['loginsuccessuseremail']}' AND id = '$user_id'"));
  if($check_id == 1){
  $update_query = mysqli_query($conn, "SELECT * FROM user WHERE id = '$user_id'");
  while ($user_update_row = mysqli_fetch_assoc($update_query)) {
?>
          <div class="widget">
            <div class="widget-title">
              <h3 class="title"><i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp;Update Info</h3>
            </div>
            <div class="widget-content">
              <form method="POST" autocomplete="off">
            <fieldset>
              <div class="form-group">
                <label for="fname"><span class="fieldinfo">First Name:</span></label>
                <input class="form-control" name="firstname" type="text" value="<?php echo $user_update_row['first_name']; ?>">
              </div>
              <div class="form-group">
                <label for="lname"><span class="fieldinfo">Last Name:</span></label>
                <input class="form-control" name="lastname" type="text" value="<?php echo $user_update_row['last_name']; ?>">
              </div>
              <div class="form-group">
                <label for="password"><span class="fieldinfo">Inter your current password:</span></label>
                <input class="form-control" name="password" type="password">
              </div>
              <center>
                      <input class="btn btn-success" type="submit" name="update" value="Update Info">
                      <a href="settings.php" class="btn btn-danger">
                        <b>Cancel
                        </b>
                      </a>
                    </center>
            </fieldset>
          </form>
            </div>
          </div>
<?php }}else{
    $_SESSION['errorMessage'] = "Something went wrong.";
    redirectTo("settings.php");
}
}
if(isset($_GET['change-password'])){
  $change_id = $_GET['change-password'];
  $check_id = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user WHERE email = '{$_SESSION['loginsuccessuseremail']}' AND id = '$change_id'"));
  if($check_id == 1){
?>
          <div class="widget">
            <div class="widget-title">
              <h3 class="title"><i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp;Change Password</h3>
            </div>
            <div class="widget-content">
              <form method="POST" autocomplete="off">
            <fieldset>
              <div class="form-group">
                <label for="fname"><span class="fieldinfo">Old Password:</span></label>
                <input class="form-control" name="oldpass" type="password">
              </div>
              <div class="form-group">
                <label for="lname"><span class="fieldinfo">New Password:</span></label>
                <input class="form-control" name="newpass" type="password">
              </div>
              <div class="form-group">
                <label for="email"><span class="fieldinfo">Confirm New Password:</span></label>
                <input class="form-control" name="cnewpass" type="password">
              </div>
              <center>
                      <input class="btn btn-success" type="submit" name="changepass" value="Change Password">
                      <a href="settings.php" class="btn btn-danger">
                        <b>Cancel
                        </b>
                      </a>
                    </center>
            </fieldset>
          </form>
            </div>
          </div>
<?php }else{
    $_SESSION['errorMessage'] = "Something went wrong.";
    redirectTo("settings.php");
}} ?>

            <div class="widget">
              <div class="widget-title">
                <h3 class="title">
                  <i class="fa fa-user-circle-o" aria-hidden="true">
                  </i>&nbsp;Profile Info
                </h3>
              </div>
              <div class="widget-content">

                <div class="table-responsive">
                      <table class="table table-bordered table-striped table-hover dataTable no-footer dtr-inline">
                        <thead>
                          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Username</th>
            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody style="font-weight: normal!important;">

<?php
$user_query = mysqli_query($conn, "SELECT * FROM user WHERE email = '{$_SESSION['loginsuccessuseremail']}'");
$count = mysqli_num_rows($user_query);
$srNo = 0;
if ($count > 0) {
    while ($user_row = mysqli_fetch_assoc($user_query)) {
        $user_id = $user_row['id'];
        $user_fname = $user_row['first_name'];
        $user_lname = $user_row['last_name'];
        $user_email = $user_row['email'];
        $user_name = $user_row['username'];
        $srNo++;
?>
                          <tr>
            <th><?php echo $user_fname." ".$user_lname;  ?></th>
            <th><?php echo $user_email; ?></th>
            <th><?php echo $user_name; ?></th>
            <th><a href="?edit-id=<?php echo $user_id; ?>" title="Change Info" class="btn btn-primary">
                                <i class="fa fa-edit">
                                </i> Change Info
                              </a>&nbsp;
                              <a href="?change-password=<?php echo $user_id; ?>" title="Change Password" class="btn btn-danger">
                                <i class="fa fa-edit">
                                </i> Change Password
                              </a></th>
                          </tr>
<?php }} ?>
                        </tbody>
                      </table>
                    </div>
                </div>
              </div>
</div>
</main>
      </div>
    </div>
    <footer class="footer" id="footer" style="background: #000000; color: #ffffff;">
      <div class="footer-copyright text-center py-3">Copyright © 
        <?php echo date("Y"); ?>
        <a href="https://www.facebook.com/borhan4238">Borhan Uddin</a>
      </div>
    </footer> 
    <script src="../assets/js/jquery-3.5.1.slim.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
<?php
}else{
  $_SESSION['errorMessage'] = "Login required.";
  redirectTo("/signin.php");
}
?>