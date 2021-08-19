<?php
include '../include/functions.php';
include '../include/config.php';
if (isset($_SESSION['loginsuccess'])) {
if (isset($_POST['update'])) {
    $page_id = $_GET['edit-id'];
    $status_valid = array("Active", "Inactive");
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $pagecontent = mysqli_real_escape_string($conn, $_POST['pagecontent']);
    if (empty($title) || empty($pagecontent)) {
        $_SESSION['errorMessage'] = "All feild is required.";
    } elseif (!isset($_SESSION['loginsuccess'])) {
        $_SESSION['errorMessage'] = "Login required.";
        redirectTo("index.php");
    } elseif (empty($title)) {
        $_SESSION['errorMessage'] = "Title can't be empty.";
    } elseif (strlen($title) < 3) {
        $_SESSION['errorMessage'] = "Title should be more than 3 character.";
    } elseif (!in_array($status, $status_valid)) {
        $_SESSION['errorMessage'] = "Page status invalid.";
    } else{
        $query = mysqli_query($conn, "UPDATE pages SET title = '$title', main_topic = '$pagecontent', status = '$status' WHERE id = '$page_id'");
        if($query){
          $_SESSION['successMessage'] = "Page updated.";
            redirectTo("pages.php");
        }else{
          $_SESSION['errorMessage'] = "Failed to update page.";
        }
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
    echo "Manage Pages - " . $siteinfo['site_name'];
?>
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='../upload/img/<?php echo $siteinfo['favicon']; ?>' rel='icon' type='image/x-icon'/>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin-style.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/dashboard.css">
    <script src="ckeditor/ckeditor.js"></script>
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
                <a class="nav-link active" href="pages.php">
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
              <a href="index.php">Home</a> / Manage Pages
            </h4>
          </div>
          <div class="col-sm-12">
            <?php
echo errorMessage();
echo successMessage();
?>
            <?php
if (isset($_GET['edit-id'])) {
    $edit_id = $_GET['edit-id'];
    $page_edit = mysqli_query($conn, "SELECT * FROM pages WHERE id = '$edit_id'");
    while ($page_edit_row = mysqli_fetch_assoc($page_edit)) {
        $pageId = $page_edit_row['id'];
        $pageTitle = $page_edit_row['title'];
        $pagePost = $page_edit_row['main_topic'];
?>
            <div class="widget">
              <div class="widget-title">
                <h3 class="title">
                  <i class="fa fa-pencil-square-o" aria-hidden="true">
                  </i>&nbsp;Update Pages
                </h3>
              </div>
              <div class="widget-content">
                <form method="POST" enctype="multipart/form-data" autocomplete="off">
                  <fieldset>
                    <div class="form-group">
                      <label for="title">
                        <span class="fieldinfo">Title:
                        </span>
                      </label>
                      <input class="form-control" type="text" name="title" id="title" placeholder="Title" value="<?php echo $pageTitle; ?>">
                    </div>
                    <div class="form-group">
                      <label for="status">
                        <span class="fieldinfo">Status:
                        </span>
                      </label>
                      <select class="form-control" id="status" name="status">
                        <option>Active
                        </option>
                        <option>Inactive
                        </option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="postarea">
                        <span class="fieldinfo">Page Content:
                        </span>
                      </label>
                      <textarea class="form-control" name="pagecontent" id="articleContent" style="height: 100px">
                        <?php echo $pagePost; ?>
                      </textarea>
      <script type="text/javascript">
        CKEDITOR.replace( 'articleContent' );
      </script>
                    </div>
                    <center>
                      <input class="btn btn-success" type="submit" name="update" value="Update Page">
                      <a href="pages.php" class="btn btn-danger">
                        <b>Cancel
                        </b>
                      </a>
                    </center>
                  </fieldset>
                </form>
              </div>
            </div>
            <?php
    }
}?>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <div class="widget">
                  <div class="widget-title">
                    <h3 class="title">
                      <i class="fa fa-pencil-square" aria-hidden="true">
                      </i>&nbsp;All Pages
                    </h3>
                  </div>
                  <div class="widget-content">
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped table-hover dataTable no-footer dtr-inline">
                        <thead>
                          <tr>    
                            <th>No.
                            </th>
                            <th>Date &amp; Time
                            </th>
                            <th>Title
                            </th>
                            <th>Status
                            </th>
                            <th>Action
                            </th>
                          </tr>
                        </thead>
                        <tbody style="font-weight: normal!important;">
                          <?php
$page_view_query = "SELECT * FROM pages ORDER BY id";
$page_view_query_result = mysqli_query($conn, $page_view_query);
$srNo = 0;
if (mysqli_num_rows($page_view_query_result) > 0) {
    while ($page_view_row = mysqli_fetch_assoc($page_view_query_result)) {
        $page_id = $page_view_row['id'];
        $page_date = $page_view_row['datetime'];
        $page_title = $page_view_row['title'];
        $page_status = $page_view_row['status'];
        $srNo++;
?>
                          <tr>
                            <th>
                              <?php echo $srNo; ?>
                            </th>
                            <th>
                              <?php echo $page_date; ?>
                            </th>
                            <th width="15%">
                                  <?php echo $page_title; ?>
                            </th>
                            <th>
                              <?php echo $page_status; ?>
                            </th>
                            <th>
                              <a href="?edit-id=<?php echo $page_id; ?>" title="View / Edit" class="btn btn-primary">
                                <i class="fa fa-edit">
                                </i> Edit
                              </a>
                            </th>
                          </tr>
                          <?php
    }
} else {
    echo "<tr><th colspan='6'>No page found in database.</th></tr>";
}
?>
                        </tbody>
                      </table>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
  </body>
</html>
<?php
}else{
  $_SESSION['errorMessage'] = "Login required.";
  redirectTo("index.php");
}
?>