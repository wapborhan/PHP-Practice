<?php
include '../include/functions.php';
include '../include/config.php';
if (isset($_SESSION['loginsuccessuser'])) {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <title><?php
      $site_info_result = mysqli_query($conn, "SELECT * FROM site_settings");
      while ($siteinfo = mysqli_fetch_assoc($site_info_result)) {
        echo "Dashboard - " . $siteinfo['site_name'];
      ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='../upload/img/<?php echo $siteinfo['favicon']; ?>' rel='icon' type='image/x-icon' />
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
                <a class="nav-link active" href="index.php">
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
                <a class="nav-link" href="settings.php">
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
              <a href="index.php">Home</a> / Dashboard
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
                  <i class="fa fa-bars" aria-hidden="true">
                  </i>&nbsp;Quick Access
                </h3>
              </div>
              <div class="widget-content">
                <a href="posts.php" class="btn btn-dark">
                  <div>
                    <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true">
                    </i>
                  </div>Add Post
                </a>
                <a href="comments.php" class="btn btn-dark">
                  <div>
                    <i class="fa fa-comment fa-2x" aria-hidden="true">
                    </i>
                  </div>Comments
                </a>
                <a href="files.php" class="btn btn-dark">
                  <div>
                    <i class="fa fa-picture-o fa-2x" aria-hidden="true">
                    </i>
                  </div>&nbsp;&nbsp;&nbsp;Media&nbsp;&nbsp;&nbsp;
                </a>
                <a href="settings.php" class="btn btn-dark">
                  <div>
                    <i class="fa fa-cogs fa-2x" aria-hidden="true">
                    </i>
                  </div>&nbsp;Settings&nbsp;
                </a>
              </div>
            </div>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-sm-6">
                <div class="widget">
                  <div class="widget-title">
                    <h3 class="title">
                      <i class="fa fa-area-chart" aria-hidden="true">
                      </i>&nbsp;Statistics
                    </h3>
                  </div>
                  <div class="widget-content">
                    <table class="table table-striped dash-table">
                      <tr>
                        <th width="50%">
                          <i class="fa fa-pencil-square" aria-hidden="true">
                          </i>&nbsp;Posts
                        </th>
                        <th>
                          <?php
                          echo "<font color='green'><b>" . mysqli_num_rows(mysqli_query($conn, "SELECT * FROM posts WHERE email = '{$_SESSION['loginsuccessuseremail']}'")) . "</b></font>";
                          ?>
                        </th>
                      </tr>
                      <tr>
                        <th>
                          <i class="fa fa-comment" aria-hidden="true">
                          </i>&nbsp;Comments
                        </th>
                        <th>
                          <?php
                          echo "<font color='green'><b>" . mysqli_num_rows(mysqli_query($conn, "SELECT * FROM comments WHERE email = '{$_SESSION['loginsuccessuseremail']}' AND user_status = 'User'")) . "</b></font>";
                          ?>
                        </th>
                      </tr>
                      <tr>
                        <th>
                          <i class="fa fa-picture-o" aria-hidden="true">
                          </i>&nbsp;Media
                        </th>
                        <th>
                          <?php
                          echo "<font color='green'><b>" . mysqli_num_rows(mysqli_query($conn, "SELECT * FROM media WHERE author = '{$_SESSION['loginsuccessuseremail']}'")) . "</b></font>";
                          ?>
                        </th>
                      </tr>
                      <tr>
                        <th><i class="fa fa-eye" aria-hidden="true">
                  </i>&nbsp;Total Views</th>
                        <th><?php 
$result = mysqli_query($conn, "SELECT SUM(views) AS views_sum FROM posts WHERE email = '{$_SESSION['loginsuccessuseremail']}'");
$row = mysqli_fetch_assoc($result); 
$sum = $row['views_sum'];
echo "<font color='green'><b>" . $sum . "</b></font>";
 ?></th>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="widget">
                  <div class="widget-title">
                    <h3 class="title">
                      <i class="fa fa-pencil-square-o" aria-hidden="true">
                      </i>&nbsp;Recent Active Posts
                    </h3>
                  </div>
                  <div class="widget-content">
                    <table class="table table-striped">
                      <?php
                      $post_view_query = "SELECT * FROM posts WHERE email = '{$_SESSION['loginsuccessuseremail']}' AND status = 'Active' ORDER BY id desc LIMIT 0, 2";
                      $post_view_query_result = mysqli_query($conn, $post_view_query);
                      while ($post_view_row = mysqli_fetch_assoc($post_view_query_result)) {
                        $post_id = $post_view_row['id'];
                        $post_date = $post_view_row['datetime'];
                        $post_title = $post_view_row['title'];
                        $post_category = $post_view_row['category'];
                        $post_author = $post_view_row['author'];
                        $post_image = $post_view_row['image'];
                        $post_status = $post_view_row['status'];
                      ?>
                        <tr>
                          <th>
                            <img width="130" height="60" alt="<?php echo $post_title; ?>" src="../upload/<?php echo $post_image; ?>">
                          </th>
                          <th style="font-weight: normal; text-align: left;">
                            <a title="Click to view post." href="../article/<?php echo $post_id; ?>">
                              <?php echo "<b>" . $post_title . "</b>"; ?>
                            </a>
                            <br>by&nbsp;
                            <?php echo "<b>" . $post_author . "</b>"; ?>
                            <br>
                            <strong>Status:
                            </strong>
                            <span class="label label-success">Active
                            </span>
                          </th>
                        </tr>
                      <?php
                      }if(mysqli_num_rows($post_view_query_result) == 0){
                        echo "<tr><td>No post found.</td></tr>";
                      }

                       ?>
                    </table>
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
<?php
} else {
  $_SESSION['errorMessage'] = "Login required.";
  redirectTo("/signin.php");
}
?>