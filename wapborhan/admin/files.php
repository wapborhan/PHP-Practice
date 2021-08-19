<?php
include '../include/functions.php';
include '../include/config.php';
if (isset($_SESSION['loginsuccess'])) {
  $limit = 16;
    if (isset($_GET['page'])) {
      $page_number = $_GET['page'];
  } else {
      $page_number = 1;
  }
  $offset = ($page_number - 1) * $limit;
if(isset($_POST['submit'])){
 $image = $_FILES['image'];
 $img_tamp_name = $image['tmp_name'];
 $img_name = uniqid() . "_" . $image['name'];
 $image_location = "../upload/";
 if (empty($image['name'])) {
   $_SESSION['errorMessage'] = "No image selected.";
   redirectTo("files.php");
 }else{
  $image_move = move_uploaded_file($img_tamp_name, $image_location . $img_name);
  $query = mysqli_query($conn, "INSERT INTO media (name, author) VALUES ('$img_name', '{$_SESSION['loginsuccessemail']}')");
  if($image_move && $query){
    $_SESSION['successMessage'] = "Image uploaded.";
    redirectTo("files.php");
  }else{
        $_SESSION['errorMessage'] = "Failed to upload image.";
        redirectTo("files.php");
  }
 }
}



if (isset($_GET['delete-id'])) {
  if (isset($_SESSION['loginsuccess'])) {
        $delete_id = $_GET['delete-id'];
        $delete_name = $_GET['name'];
        $image_del = "../upload/".$delete_name;
        $delete = unlink($image_del);
        $img_delete = mysqli_query($conn, "DELETE FROM media WHERE id = '$delete_id'");
    if ($img_delete && $delete) {
        $_SESSION['successMessage'] = "Image permanently deleted.";
        redirectTo("files.php");
    } else {
        $_SESSION['errorMessage'] = "Failed to delete image.";
       redirectTo("files.php");
    }
  }else{
      $_SESSION['errorMessage'] = "Login required.";
      redirectTo("index.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>
      <?php
$site_info_result = mysqli_query($conn, "SELECT * FROM site_settings");
while ($siteinfo = mysqli_fetch_assoc($site_info_result)) {
    echo "Media Files - " . $siteinfo['site_name'];
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
                <a class="nav-link active" href="files.php">
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
              <a href="index.php">Home</a> / Media Files
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
                  <i class="fa fa-picture-o" aria-hidden="true">
                  </i>&nbsp;Add New Image
                </h3>
              </div>
              <div class="widget-content">
                <form method="POST" enctype="multipart/form-data">
                  <fieldset>
                    <div class="form-group">
                      <label for="imageup">
                        <span class="fieldinfo">Image:
                        </span>
                      </label>
                      <input class="form-control" type="file" name="image" id="imageup">
                    </div>
                    <center>
                      <input class="btn btn-success" type="submit" name="submit" value="Add New Image">
                    </center>
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <div class="widget">
                  <div class="widget-title">
                    <h3 class="title">
                      <i class="fa fa-picture-o" aria-hidden="true">
                      </i>&nbsp;All Image
                    </h3>
                  </div>
                  <div class="widget-content">
                    <div class="container">
                    <div class="row">
<?php
$image_query = mysqli_query($conn, "SELECT * FROM media ORDER BY id desc LIMIT {$offset}, {$limit}");
if(mysqli_num_rows($image_query) != 0){
while ($image_row = mysqli_fetch_assoc($image_query)) {
  $img_id = $image_row['id'];
  $img_name = $image_row['name'];
?>

                        <div class="col-md-3">
                          <div class="thumbnail">
                              <img src="../../upload/<?php echo $img_name ?>" style="width:100%; height: 185px;" class="img-thumbnail">
                              <div class="caption">
                                <p id="copy<?php echo $img_id ?>">../../upload/<?php echo $img_name ?></p>
                                <button class="btn btn-success" onclick="copyToClipboard('#copy<?php echo $img_id ?>')" data-toggle="tooltip" data-placement="top" title="Copy to clicboard"><i class="fa fa-clone" aria-hidden="true"></i>&nbsp;Copy Link</button>
                                <a onclick="return confirm('Are you sure?')" href="?delete-id=<?php echo $img_id; ?>&name=<?php echo $img_name; ?>" title="Delete" class="btn btn-danger"><i class="fa fa-remove"></i>&nbsp;Delete</a>
                              </div>
                          </div>
                        </div>
                <?php
                  }
                }else{
                  echo "No media found.";
                }
                ?>

                    </div>
                    <?php
            $media_page_query = mysqli_query($conn, "SELECT * FROM media ORDER BY id desc");
            $total_data = mysqli_num_rows($media_page_query);
            $total_page = ceil($total_data / $limit);
            ?>
          <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
              <?php
                if ($page_number > 1) {
                ?>
              <li class="page-item">
                <a class="page-link" href="?page=<?php echo $page_number - 1; ?>">
                <span aria-hidden="true">&laquo;
                </span>
                <span class="sr-only">Previous
                </span>
                </a>
              </li>
              <?php
                }
                for ($i = 1;$i <= $total_page;$i++) {
                    if ($i == $page_number) {
                        $active = "page-item active";
                    } else {
                        $active = "page-item";
                    }
                ?>
              <li class="<?php echo $active; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>">
                <?php echo $i; ?>
                </a>
              </li>
              <?php
                }
                if ($total_page > $page_number) {
                ?>
              <li class="page-item">
                <a class="page-link" href="?page=<?php echo $page_number + 1; ?>">
                <span aria-hidden="true">&raquo;
                </span>
                <span class="sr-only">Next
                </span>
                </a>
              </li>
              <?php
                }
                ?>
            </ul>
          </nav>
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
    <script type="text/javascript">
      function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
}
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
    </script>
  </body>
</html>
<?php
}else{
  $_SESSION['errorMessage'] = "Login required.";
  redirectTo("index.php");
}
?>