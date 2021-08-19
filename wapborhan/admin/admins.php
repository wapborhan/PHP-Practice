<?php
include '../include/functions.php';
include '../include/config.php';
if (isset($_SESSION['loginsuccess'])) {
if(isset($_POST['changepass'])){
  $id = $_GET['change-password'];
  $old_pass = mysqli_real_escape_string($conn, md5($_POST['oldpass']));
  $new_pass = mysqli_real_escape_string($conn, $_POST['newpass']);
  $cnew_pass = mysqli_real_escape_string($conn, $_POST['cnewpass']);
  if(!isset($_SESSION['loginsuccess'])){
       $_SESSION['errorMessage'] = "Login required.";
        redirectTo("index.php");
  }elseif(empty($old_pass) || empty($new_pass) || empty($cnew_pass)){
    $_SESSION['errorMessage'] = "All feild are required.";
  }elseif ($new_pass != $cnew_pass) {
    $_SESSION['errorMessage'] = "Confirm password not matched!";
  }elseif (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM admins WHERE password = '$old_pass' AND id = '$id'")) != 1) {
    $_SESSION['errorMessage'] = "The password you entered is incorrect.";
  }else{
    $password = md5($cnew_pass);
    $query = mysqli_query($conn, "UPDATE admins SET password = '$password' WHERE id = '$id'");
    if($query){
      $_SESSION['successMessage'] = "Password changed.";
      redirectTo("admins.php");
    }else{
      $_SESSION['errorMessage'] = "Something went wrong.";
      redirectTo("admins.php");
    }
  }
}
if (isset($_POST['update'])) {
   $id = $_GET['edit-id'];
   $first_name = mysqli_real_escape_string($conn, $_POST['firstname']);
   $last_name = mysqli_real_escape_string($conn, $_POST['lastname']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = mysqli_real_escape_string($conn, md5($_POST['password']));
   if(!isset($_SESSION['loginsuccess'])){
       $_SESSION['errorMessage'] = "Login required.";
        redirectTo("index.php");
  }elseif(empty($first_name) || empty($last_name) || empty($email) || empty($password)){
        $_SESSION['errorMessage'] = "All feild is required.";
      } elseif (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM admins WHERE password = '$password' AND id = '$id'")) != 1) {
       $_SESSION['errorMessage'] = "The password you entered is incorrect.";
      }else{
        $query = mysqli_query($conn, "UPDATE admins SET first_name = '$first_name', last_name = '$last_name', email = '$email' WHERE id = '$id'");
        if ($query) {
      $_SESSION['successMessage'] = "Information changed.";
      redirectTo("admins.php");
        }else{
      $_SESSION['errorMessage'] = "Something went wrong.";
      redirectTo("admins.php");
        }
      }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php
$site_info_result = mysqli_query($conn, "SELECT * FROM site_settings");
while ($siteinfo = mysqli_fetch_assoc($site_info_result)) {
    echo "Admin Settings - " . $siteinfo['site_name'];

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
                <a class="nav-link" href="dashboard.php">
                  <i class="fa fa-dashboard" aria-hidden="true">
                  </i>&nbsp;Dashboard
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="manage-posts.php">
                  <i class="fa fa-pencil-square" aria-hidden="true">
                  </i>&nbsp;Posts
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="categorys.php">
                  <i class="fa fa-tags" aria-hidden="true">
                  </i>&nbsp;Categorys
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="comments.php">
                  <i class="fa fa-comment" aria-hidden="true">
                  </i>&nbsp;Comments
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="pages.php">
                  <i class="fa fa-file" aria-hidden="true">
                  </i>&nbsp;Pages
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
                <a class="nav-link" href="users.php">
                  <i class="fa fa-user-circle" aria-hidden="true">
                  </i>&nbsp;Manage Users
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="admins.php">
                  <i class="fa fa-user-circle-o" aria-hidden="true">
                  </i>&nbsp;Admin Settings
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="ads.php">
                  &nbsp;<i class="fa fa-usd" aria-hidden="true"></i>&nbsp;&nbsp;Ads
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="site-setting.php">
                  <i class="fa fa-cogs" aria-hidden="true">
                  </i>&nbsp;Site Settings
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
              <a href="index.php">Home</a> / Admin Settings
            </h4>
          </div>
          <div class="col-sm-12">
            <?php
echo errorMessage();
echo successMessage();
if (isset($_GET['edit-id'])) {
  $admin_id = $_GET['edit-id'];
  $update_query = mysqli_query($conn, "SELECT * FROM admins WHERE id = '$admin_id'");
  while ($admin_update_row = mysqli_fetch_assoc($update_query)) {
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
                <input class="form-control" name="firstname" type="text" value="<?php echo $admin_update_row['first_name']; ?>">
              </div>
              <div class="form-group">
                <label for="lname"><span class="fieldinfo">Last Name:</span></label>
                <input class="form-control" name="lastname" type="text" value="<?php echo $admin_update_row['last_name']; ?>">
              </div>
              <div class="form-group">
                <label for="email"><span class="fieldinfo">Email:</span></label>
                <input class="form-control" name="email" type="email" value="<?php echo $admin_update_row['email']; ?>">
              </div>
              <div class="form-group">
                <label for="password"><span class="fieldinfo">Inter your current password:</span></label>
                <input class="form-control" name="password" type="password">
              </div>
              <center>
                      <input class="btn btn-success" type="submit" name="update" value="Update Info">
                      <a href="admins.php" class="btn btn-danger">
                        <b>Cancel
                        </b>
                      </a>
                    </center>
            </fieldset>
          </form>
            </div>
          </div>
<?php }}
if(isset($_GET['change-password'])){
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
                      <a href="admins.php" class="btn btn-danger">
                        <b>Cancel
                        </b>
                      </a>
                    </center>
            </fieldset>
          </form>
            </div>
          </div>
<?php } ?>

            <div class="widget">
              <div class="widget-title">
                <h3 class="title">
                  <i class="fa fa-user-circle-o" aria-hidden="true">
                  </i>&nbsp;Admin Info
                </h3>
              </div>
              <div class="widget-content">

                <div class="table-responsive">
                      <table class="table table-bordered table-striped table-hover dataTable no-footer dtr-inline">
                        <thead>
                          <tr>    
            <th>No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody style="font-weight: normal!important;">

<?php
$admin_query = mysqli_query($conn, "SELECT * FROM admins ORDER BY id desc");
$count = mysqli_num_rows($admin_query);
$srNo = 0;
if ($count > 0) {
    while ($admin_row = mysqli_fetch_assoc($admin_query)) {
        $admin_id = $admin_row['id'];
        $admin_fname = $admin_row['first_name'];
        $admin_lname = $admin_row['last_name'];
        $admin_email = $admin_row['email'];
        $srNo++;
?>
                          <tr>    
            <th><?php echo $srNo; ?></th>
            <th><?php echo $admin_fname." ".$admin_lname;  ?></th>
            <th><?php echo $admin_email; ?></th>
            <th><a href="?edit-id=<?php echo $admin_id; ?>" title="Change Info" class="btn btn-primary">
                                <i class="fa fa-edit">
                                </i> Change Info
                              </a>&nbsp;
                              <a href="?change-password=<?php echo $admin_id; ?>" title="Change Password" class="btn btn-danger">
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
  redirectTo("index.php");
}
?>