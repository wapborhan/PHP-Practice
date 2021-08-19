<?php
include '../include/functions.php';
include '../include/config.php';
include '../include/html2text/html2text.php';
if (isset($_SESSION['loginsuccessuser'])) {
  $limit = 10;
  if (isset($_GET['page'])) {
    $page_number = $_GET['page'];
  } else {
    $page_number = 1;
  }
  $offset = ($page_number - 1) * $limit;
?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <title><?php
      $site_info_result = mysqli_query($conn, "SELECT * FROM site_settings");
      while ($siteinfo = mysqli_fetch_assoc($site_info_result)) {
        echo "Comments - " . $siteinfo['site_name'];
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
                <a class="nav-link active" href="comments.php">
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
            <h4><a href="index.php">Home</a> / Comments</h4>
          </div>
          <div class="col-sm-12">
            <?php
            echo errorMessage();
            echo successMessage();
            ?>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <div class="widget">
                  <div class="widget-title">
                    <h3 class="title"><i class="fa fa-comment" aria-hidden="true"></i>&nbsp;All Comments</h3>
                  </div>
                  <div class="widget-content">
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped table-hover dataTable no-footer dtr-inline">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Date &amp; Time</th>
                            <th>Name</th>
                            <th>Comment</th>
                            <th>Status</th>
                            <th>Post</th>
                          </tr>
                        </thead>
                        <tbody style="font-weight: normal!important;">
                          <?php
                          $commentsview = mysqli_query($conn, "SELECT * FROM comments WHERE email = '{$_SESSION['loginsuccessuseremail']}' AND user_status = 'User' ORDER BY id desc LIMIT {$offset}, {$limit}");
                          $count = mysqli_num_rows($commentsview);
                          $srNo = 0;
                          if ($count > 0) {
                            while ($commentsrow = mysqli_fetch_assoc($commentsview)) {
                              $commentId = $commentsrow['id'];
                              $dateTime = $commentsrow['datetime'];
                              $comment = $commentsrow['comment'];
                              $userStatus = $commentsrow['user_status'];
                              $commentStatus = $commentsrow['status'];
                              $name = $commentsrow['name'];
                              $postid = $commentsrow['post_id'];
                              $srNo++;
                          ?>
                              <tr>
                                <th><?php echo $srNo; ?></th>
                                <th><?php echo $dateTime; ?></th>
                                <th><?php echo $name; ?></th>
                                <th width="20%"><?php
                                                if (strlen($comment) > 70) {
                                                  $comment = substr($comment, 0, 70) . "...";
                                                }
                                                $comment_text = convert_html_to_text($comment);
                                                echo $comment_text;
                                                ?></th>
                                <th><?php echo $commentStatus ?></th>
                                <th><?php echo '<a target="_blank" title="Click here to view this post" href="../article/' . $postid . '">Click to view</a>' ?></th>
                              </tr>
                          <?php }
                          } else {
                            echo "<tr><th colspan='6'>No comment.</th></tr>";
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                    <?php
                    $post_page_query = mysqli_query($conn, "SELECT * FROM comments WHERE email = '{$_SESSION['loginsuccessuseremail']}' AND user_status = 'User'");
                    $total_data = mysqli_num_rows($post_page_query);
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
                        for ($i = 1; $i <= $total_page; $i++) {
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
<?php } else {
  $_SESSION['errorMessage'] = "Login required.";
  redirectTo("/signin.php");
} ?>