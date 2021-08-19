<?php
include '../include/functions.php';
include '../include/config.php';
if (isset($_SESSION['loginsuccess'])) {
  $limit = 10;
  if (isset($_GET['page'])) {
    $page_number = $_GET['page'];
  } else {
    $page_number = 1;
  }
  $offset = ($page_number - 1) * $limit;
  if (isset($_GET['delete-id'])) {
    if (isset($_SESSION['loginsuccess'])) {
      $delete_id = $_GET['delete-id'];
      $user_delete = mysqli_query($conn, "DELETE FROM user WHERE id = '$delete_id'");
      if ($user_delete) {
        $_SESSION['successMessage'] = "User deleted.";
        redirectTo("users.php");
      } else {
        $_SESSION['errorMessage'] = "Failed to delete user.";
        redirectTo("users.php");
      }
    } else {
      $_SESSION['errorMessage'] = "Login required.";
      redirectTo("index.php");
    }
  }
  if (isset($_POST['update'])) {
    $id = $_GET['edit-id'];
    $status_valid = array("Active", "Inactive");
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $first_name = mysqli_real_escape_string($conn, $_POST['firstname']);
    $last_name = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    if (!isset($_SESSION['loginsuccess'])) {
      $_SESSION['errorMessage'] = "Login required.";
      redirectTo("index.php");
    } elseif (empty($first_name) || empty($last_name) || empty($email) || empty($status)) {
      $_SESSION['errorMessage'] = "First Name, Last Name, Status & Email feild are required";
    } elseif (!in_array($status, $status_valid)) {
      $_SESSION['errorMessage'] = "User status invalid.";
    } elseif (!empty($password)) {
      $cpassword = md5($password);
      $query = mysqli_query($conn, "UPDATE user SET first_name = '$first_name', last_name = '$last_name', email = '$email', password = '$cpassword', status = '$status' WHERE id = '$id'");
      if ($query) {
        $_SESSION['successMessage'] = "Information updated.";
        redirectTo("users.php");
      } else {
        $_SESSION['errorMessage'] = "Something went wrong.";
        redirectTo("users.php");
      }
    } else {
      $query = mysqli_query($conn, "UPDATE user SET first_name = '$first_name', last_name = '$last_name', email = '$email', status = '$status' WHERE id = '$id'");
      if ($query) {
        $_SESSION['successMessage'] = "Information updated.";
        redirectTo("users.php");
      } else {
        $_SESSION['errorMessage'] = "Something went wrong.";
        redirectTo("users.php");
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
              echo "Manage Users - " . $siteinfo['site_name'];

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
                <a class="nav-link active" href="users.php">
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
              <a href="index.php">Home</a> / Manage Users
            </h4>
          </div>
          <div class="col-sm-12">
            <?php
            echo errorMessage();
            echo successMessage();
            if (isset($_GET['edit-id'])) {
              $user_id = $_GET['edit-id'];
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
                          <label for="email"><span class="fieldinfo">Email:</span></label>
                          <input class="form-control" name="email" type="email" value="<?php echo $user_update_row['email']; ?>">
                        </div>
                        <div class="form-group">
                          <label for="status"><span class="fieldinfo">Status:</span></label>
                          <select class="form-control" id="status" name="status">
                            <option>Active</option>
                            <option>Inactive</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="password"><span class="fieldinfo">Password:</span></label>
                          <input class="form-control" name="password" type="password">
                          <p><em>Fill this field only if you want to change the password.</em></p>
                        </div>
                        <center>
                          <input class="btn btn-success" type="submit" name="update" value="Update Info">
                          <a href="users.php" class="btn btn-danger">
                            <b>Cancel
                            </b>
                          </a>
                        </center>
                      </fieldset>
                    </form>
                  </div>
                </div>
            <?php }
            } ?>
            <div class="widget">
              <div class="widget-title">
                <h3 class="title">
                  <i class="fa fa-user-circle-o" aria-hidden="true">
                  </i>&nbsp;Users
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
                        <th>Username</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody style="font-weight: normal!important;">
                      <?php
                      $users_query = mysqli_query($conn, "SELECT * FROM user ORDER BY id desc LIMIT {$offset}, {$limit}");
                      $count = mysqli_num_rows($users_query);
                      $srNo = 0;
                      if ($count > 0) {
                        while ($users_row = mysqli_fetch_assoc($users_query)) {
                          $users_id = $users_row['id'];
                          $users_fname = $users_row['first_name'];
                          $users_lname = $users_row['last_name'];
                          $users_email = $users_row['email'];
                          $users_username = $users_row['username'];
                          $users_status = $users_row['status'];
                          $srNo++;
                      ?>
                          <tr>
                            <th><?php echo $srNo; ?></th>
                            <th><?php echo $users_fname . " " . $users_lname;  ?></th>
                            <th><?php echo $users_email; ?></th>
                            <th><?php echo $users_username; ?></th>
                            <th><?php echo $users_status; ?></th>
                            <th><a href="?edit-id=<?php echo $users_id; ?>" title="Change Info" class="btn btn-primary">
                                <i class="fa fa-edit">
                                </i> Change Info </a>&nbsp;
                              <a onclick="return confirm('Are you sure?')" href="?delete-id=<?php echo $users_id; ?>" title="Delete" class="btn btn-danger">
                                <i class="fa fa-remove">
                                </i> Delete </a></th>
                          </tr>
                      <?php }
                      } else {
                        echo "<tr><th colspan='9'>No user found.</th></tr>";
                      } ?>
                    </tbody>
                  </table>
                </div>
                <?php
                $user_page_query = mysqli_query($conn, "SELECT * FROM user ORDER BY id desc");
                $total_data = mysqli_num_rows($user_page_query);
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
  redirectTo("index.php");
}
?>