<?php
include '../include/functions.php';
include '../include/config.php';
if (isset($_SESSION['loginsuccess'])) {
if(isset($_POST['update'])){
  $theme_valid = array("#000000", "#0275D8", "#5CB85C", "#F0AD4E", "#D9534F", "#292B2C", "#1A8693", "#8DDE94", "#4DCE9E", "#FFE176", "#FF836D", "#EE518D", "#8428D1", "#7AC6DC", "#FF5A35");
  $siteTitle = mysqli_real_escape_string($conn, $_POST['sitename']);
  $siteDescription = mysqli_real_escape_string($conn, $_POST['description']);
  $siteKeywords = mysqli_real_escape_string($conn, $_POST['keywords']);
  $siteEmail = mysqli_real_escape_string($conn, $_POST['email']);
  $siteFacebook = mysqli_real_escape_string($conn, $_POST['facebook']);
  $siteTwitter = mysqli_real_escape_string($conn, $_POST['twitter']);
  $siteInstagram = mysqli_real_escape_string($conn, $_POST['instagram']);
  $siteYoutube = mysqli_real_escape_string($conn, $_POST['youtube']);
  $postPerpage = mysqli_real_escape_string($conn, $_POST['postperpage']);
  $theme = mysqli_real_escape_string($conn, $_POST['theme']);
  $siteLogo = $_FILES['sitelogo'];
  $siteLogo_tmp_name = $siteLogo['tmp_name'];
  $siteLogo_name = uniqid() . "_" . $siteLogo['name'];
  $favIcon = $_FILES['favicon'];
  $favIcon_tmp_name = $favIcon['tmp_name'];
  $favIcon_name = uniqid() . "_" . $favIcon['name'];
  if(isset($_SESSION['loginsuccess'])){
  if(!in_array($theme, $theme_valid)){
      $_SESSION['errorMessage'] = "Invalid theme.";
  }elseif(empty($postPerpage) || $postPerpage < 1){
      $_SESSION['errorMessage'] = "Minimum post per page is 1.";
  } elseif(empty($siteLogo['name']) && !empty($favIcon['name'])){
    $image_location = "../upload/img/";
    $fav_image_move = move_uploaded_file($favIcon_tmp_name, $image_location . $favIcon_name);
    $update_query = mysqli_query($conn, "UPDATE site_settings SET site_name='$siteTitle', description='$siteDescription', keywords='$siteKeywords', email='$siteEmail', facebook='$siteFacebook', twitter='$siteTwitter', instagram='$siteInstagram', post_per_page = '$postPerpage', youtube='$siteYoutube', favicon = '$favIcon_name', theme = '$theme' WHERE id = 1");
        if($update_query && $fav_image_move){
          $_SESSION['successMessage'] = "Site settings successfully updated.";
          redirectTo("site-setting.php");
        }else{
          $_SESSION['errorMessage'] = "Failed to update site settings.";
         }
  } elseif (!empty($siteLogo['name']) && empty($favIcon['name'])) {
        $image_location = "../upload/img/";
    $logo_image_move = move_uploaded_file($siteLogo_tmp_name, $image_location . $siteLogo_name);
    $update_query = mysqli_query($conn, "UPDATE site_settings SET site_name='$siteTitle', description='$siteDescription', keywords='$siteKeywords', email='$siteEmail', facebook='$siteFacebook', twitter='$siteTwitter', instagram='$siteInstagram', post_per_page = '$postPerpage', youtube='$siteYoutube', logo = '$siteLogo_name', theme = '$theme' WHERE id = 1");
      if($update_query && $logo_image_move){
          $_SESSION['successMessage'] = "Site settings successfully updated.";
          redirectTo("site-setting.php");
      }else{
        $_SESSION['errorMessage'] = "Failed to update site settings.";
      }
  } elseif (!empty($siteLogo['name']) && !empty($favIcon['name'])) {
   $image_location = "../upload/img/";
   $fav_image_move = move_uploaded_file($favIcon_tmp_name, $image_location . $favIcon_name);
   $logo_image_move = move_uploaded_file($siteLogo_tmp_name, $image_location . $siteLogo_name); 
   $update_query = mysqli_query($conn, "UPDATE site_settings SET site_name='$siteTitle', description='$siteDescription', keywords='$siteKeywords', email='$siteEmail', facebook='$siteFacebook', twitter='$siteTwitter', instagram='$siteInstagram', post_per_page = '$postPerpage', youtube='$siteYoutube', logo = '$siteLogo_name', favicon = '$favIcon_name', theme = '$theme' WHERE id = 1");
          if($update_query && $fav_image_move && $logo_image_move){
        $_SESSION['successMessage'] = "Site settings successfully updated.";
          redirectTo("site-setting.php");
      }else{
        $_SESSION['errorMessage'] = "Failed to update site settings.";
      }
  } else{
    $update_query = mysqli_query($conn, "UPDATE site_settings SET site_name='$siteTitle', description='$siteDescription', keywords='$siteKeywords', email='$siteEmail', facebook='$siteFacebook', twitter='$siteTwitter', instagram='$siteInstagram', post_per_page = '$postPerpage', youtube='$siteYoutube', theme = '$theme' WHERE id = 1");
          if($update_query){
        $_SESSION['successMessage'] = "Site settings successfully updated.";
          redirectTo("site-setting.php");
      }else{
        $_SESSION['errorMessage'] = "Failed to update site settings.";
      }
  }
}else{
          $_SESSION['errorMessage'] = "Login required.";
        redirectTo("index.php");
}
}
$siteinfo_query = "SELECT * FROM site_settings WHERE id = 1";
$siteinfo_query_result = mysqli_query($conn, $siteinfo_query);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>
      <?php
$site_info_result = mysqli_query($conn, "SELECT * FROM site_settings");
while ($siteinfo = mysqli_fetch_assoc($site_info_result)) {
    echo "Site Settings - " . $siteinfo['site_name'];
?>
    </title>
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
                <a class="nav-link" href="admins.php">
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
                <a class="nav-link active" href="site-setting.php">
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
              <a href="index.php">Home</a> / Site Settings
            </h4>
          </div>
          <div class="col-sm-12">
            <?php
echo errorMessage();
echo successMessage();
?>
            <div class="widget">
              <div class="widget-title">
                <h3 class="title">
                  <i class="fa fa-cogs" aria-hidden="true">
                  </i>&nbsp;Update Site Settings
                </h3>
              </div>
              <div class="widget-content">
<?php
while($siteinfo_row = mysqli_fetch_assoc($siteinfo_query_result)){
  $site_name = $siteinfo_row['site_name'];
  $description = $siteinfo_row['description'];
  $keywords = $siteinfo_row['keywords'];
  $email = $siteinfo_row['email'];
  $facebook = $siteinfo_row['facebook'];
  $twitter = $siteinfo_row['twitter'];
  $instagram = $siteinfo_row['instagram'];
  $youtube = $siteinfo_row['youtube'];
  $logo = $siteinfo_row['logo'];
  $favicon = $siteinfo_row['favicon'];
  $theme = $siteinfo_row['theme'];
  $postnumber = $siteinfo_row['post_per_page'];
  $theme = $siteinfo_row['theme'];
?>
          <form method="POST" enctype="multipart/form-data" autocomplete="off">
            <fieldset>
              <div class="form-group">
                <label for="sitename"><span class="fieldinfo">Site Name:</span></label>
                <input class="form-control" type="text" name="sitename" id="sitename" placeholder="Site Name" value="<?php echo $site_name; ?>">
              </div>
              <div class="form-group">
                <label for="description"><span class="fieldinfo">Description:</span></label>
                <input class="form-control" type="text" name="description" id="description" placeholder="Description" value="<?php echo $description; ?>">
              </div>
              <div class="form-group">
                <label for="keywords"><span class="fieldinfo">Keywords:</span></label>
                <input class="form-control" type="text" name="keywords" id="keywords" placeholder="Keywords" value="<?php echo $keywords; ?>">
              </div>
              <div class="form-group">
                <label for="postperpage"><span class="fieldinfo">Post Per Page:</span></label>
                <input class="form-control" type="text" name="postperpage" id="postperpage" placeholder="Post Per Page" value="<?php echo $postnumber; ?>">
              </div>
              <div class="form-group">
                <label for="email"><span class="fieldinfo">Email Address:</span></label>
                <input class="form-control" type="email" name="email" id="email" placeholder="Email Address" value="<?php echo $email; ?>">
              </div>
              <div class="form-group">
                <label for="facebook"><span class="fieldinfo">Facebook URL:</span></label>
                <input class="form-control" type="text" name="facebook" id="facebook" placeholder="Facebook URL" value="<?php echo $facebook; ?>">
              </div>
              <div class="form-group">
                <label for="twitter"><span class="fieldinfo">Twitter:</span></label>
                <input class="form-control" type="text" name="twitter" id="twitter" placeholder="Twitter URL" value="<?php echo $twitter; ?>">
              </div>
              <div class="form-group">
                <label for="instagram"><span class="fieldinfo">Instagram URL:</span></label>
                <input class="form-control" type="text" name="instagram" id="instagram" placeholder="Instagram URL" value="<?php echo $instagram; ?>">
              </div>
              <div class="form-group">
                <label for="youtube"><span class="fieldinfo">Youtube URL:</span></label>
                <input class="form-control" type="text" name="youtube" id="youtube" placeholder="Youtube URL" value="<?php echo $youtube; ?>">
              </div>
              <div class="form-group">
                <label for="logo"><span class="fieldinfo">Site Logo(130x30):</span></label><br>
                <img src="../upload/img/<?php echo $logo; ?>" width="130" height="30">
                <input class="form-control" type="file" name="sitelogo" id="logo">
                <p><em>Fill this field only if you want to change the logo.</em></p>
              </div>
              <div class="form-group">
                <label for="favicon"><span class="fieldinfo">Favicon(16x16):</span></label><br>
                <img src="../upload/img/<?php echo $favicon; ?>" width="16" height="16">
                <input class="form-control" type="file" name="favicon" id="favicon">
                <p><em>Fill this field only if you want to change the favicon.</em></p>
              </div>
              <div class="form-group">
                <label for="theme"><span class="fieldinfo">Theme:</span></label>
                <select class="form-control" id="theme" name="theme">
                  <option value="<?php echo $theme; ?>">No Change</option>
                  <option value="#0275D8">Cool Blue</option>
                  <option value="#5CB85C">Cool Green</option>
                  <option value="#F0AD4E">Cool Orange</option>
                  <option value="#D9534F">Cool Red</option>
                  <option value="#292B2C">Cool Black</option>
                  <option value="#1A8693">Cool Teal</option>
                  <option value="#8DDE94">Light Green</option>
                  <option value="#4DCE9E">Eucalyptus</option>
                  <option value="#FFE176">Shandy</option>
                  <option value="#FF836D">Coral Reef</option>
                  <option value="#EE518D">French Rose</option>
                  <option value="#8428D1">Blue-Violet</option>
                  <option value="#7AC6DC">Middle Blue</option>
                  <option value="#FF5A35">Portland Orange</option>
                  <option value="#000000">Deep Black</option>
                </select>
              </div>
              <input class="btn btn-success" type="submit" name="update" value="Update Site Info">
            </fieldset>
          </form>
<?php
}
?>
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