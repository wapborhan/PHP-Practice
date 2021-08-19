<?php
include '../include/functions.php';
include '../include/config.php';
include '../include/html2text/html2text.php';
if(isset($_SESSION['loginsuccess'])){
if(isset($_POST['update'])){
  $ads_id = $_GET['edit-id'];
  $status_valid = array("Active", "Inactive");
  $update_status = mysqli_real_escape_string($conn, $_POST['status']);
  $update_adcode = mysqli_real_escape_string($conn, $_POST['adcode']);
  if(!isset($_SESSION['loginsuccess'])){
            $_SESSION['errorMessage'] = "Login required.";
        redirectTo("index.php");
      }elseif(!in_array($update_status, $status_valid)){
        $_SESSION['errorMessage'] = "Ads status invalid.";
      }else{
        $update_ads = mysqli_query($conn, "UPDATE ads SET code = '$update_adcode', status = '$update_status' WHERE id = '$ads_id'");
        if ($update_ads) {
         $_SESSION['successMessage'] = "Ads updated successfully.";
            redirectTo("ads.php");
        }else{
          $_SESSION['errorMessage'] = "Failed to update ads.";
          redirectTo("ads.php");
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
echo "Ads - ".$siteinfo['site_name'];
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
    <span class="navbar-toggler-icon"></span>
  </button>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Sign out</a>
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
              <i class="fa fa-dashboard" aria-hidden="true"></i>&nbsp;Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="manage-posts.php">
              <i class="fa fa-pencil-square" aria-hidden="true"></i>&nbsp;Posts
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="categorys.php">
              <i class="fa fa-tags" aria-hidden="true"></i>&nbsp;Categorys
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="comments.php">
              <i class="fa fa-comment" aria-hidden="true"></i>&nbsp;Comments
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages.php">
              <i class="fa fa-file" aria-hidden="true"></i>&nbsp;Pages
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="files.php">
              <i class="fa fa-picture-o" aria-hidden="true"></i>&nbsp;Media Files
            </a>
          </li>
        </ul>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="users.php">
              <i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;Manage Users
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admins.php">
              <i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp;Admin Settings
            </a>
          </li>
          <li class="nav-item">
                <a class="nav-link active" href="ads.php">
                  &nbsp;<i class="fa fa-usd" aria-hidden="true"></i>&nbsp;&nbsp;Ads
                </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="site-setting.php">
              <i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;Site Settings
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../index.php" target="_blank">
              <i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View Site
            </a>
          </li>
        </ul>
      </div>
    </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4><a href="index.php">Home</a> / Ads</h4>
       </div>
<div class="col-sm-12">
        <?php
        echo errorMessage();
        echo successMessage();
        ?>
<?php
if(isset($_GET['edit-id'])){
  $ads_edit_id = $_GET['edit-id'];
  $ads_edit_query = mysqli_query($conn, "SELECT * FROM ads WHERE id = '$ads_edit_id'");
  while ($ads_edit_row = mysqli_fetch_assoc($ads_edit_query)) {
    $adsplace = $ads_edit_row['place'];
    $adsstatus = $ads_edit_row['status'];
    $adscode = $ads_edit_row['code'];
  
?>
              <div class="widget">
      <div class="widget-title">
        <h3 class="title">&nbsp;<i class="fa fa-usd" aria-hidden="true"></i>&nbsp;&nbsp;Update Ads</h3>
      </div>
      <div class="widget-content">
                  <form method="POST" autocomplete="off">
            <fieldset>
              <div class="form-group">
                <label for="adsplace"><span class="fieldinfo">Ads Place:</span></label>
                <input class="form-control" title="You cannot change ads place." type="text" value="<?php echo $adsplace; ?>" disabled>
              </div>
              <div class="form-group">
                <label for="code"><span class="fieldinfo">Ads Code:</span></label>
                <textarea class="form-control" name="adcode" id="code" style="min-height: 100px"><?php echo $adscode; ?></textarea>
              </div>
              <div class="form-group">
                <label for="status"><span class="fieldinfo">Status:</span></label>
                <select class="form-control" id="status" name="status">
                        <option>Active
                        </option>
                        <option>Inactive
                        </option>
                      </select>
              </div>
              <center>
                      <input class="btn btn-success" type="submit" name="update" value="Update Ads">
                      <a href="ads.php" class="btn btn-danger">
                        <b>Cancel
                        </b>
                      </a>
                    </center>
            </fieldset>
          </form>
      </div>
      </div>
<?php } } ?>
</div>
<div class="container">
      <div class="row">
            <div class="col-sm-12">
                <div class="widget">
                    <div class="widget-title">
                        <h3 class="title">&nbsp;<i class="fa fa-usd" aria-hidden="true"></i>&nbsp;&nbsp;All Ads</h3>
                    </div>
                    <div class="widget-content">
                      <div class="table-responsive">
                      <table class="table table-bordered table-striped table-hover dataTable no-footer dtr-inline">
                        <thead>
                          <tr>    
            <th>No.</th>
            <th>Ads Place</th>
            <th>Status</th>
            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody style="font-weight: normal!important;">

<?php
$adsview = mysqli_query($conn, "SELECT * FROM ads");
$count = mysqli_num_rows($adsview);
$srNo = 0;
if ($count > 0) {
    while ($adsrow = mysqli_fetch_assoc($adsview)) {
        $adsid = $adsrow['id'];
        $adsplace = $adsrow['place'];
        $adsstatus = $adsrow['status'];
        $srNo++;
?>
                          <tr>    
            <th><?php echo $srNo; ?></th>
            <th><?php echo $adsplace; ?></th>
            <th><?php echo $adsstatus; ?></th>
            <th><a href="?edit-id=<?php echo $adsid; ?>" title="View / Edit" class="btn btn-primary">
                                <i class="fa fa-edit">
                                </i> Edit
                              </a>&nbsp;</th>
                          </tr>
<?php }} ?>
                        </tbody>
                      </table>
                    </div>

                    </div>
                  </div>
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
<?php }else{
    $_SESSION['errorMessage'] = "Login required.";
  redirectTo("index.php");
} ?>