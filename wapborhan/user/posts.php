<?php
include '../include/functions.php';
include '../include/config.php';
if (isset($_SESSION['loginsuccessuser'])) {
  $limit = 10;
  if (isset($_GET['page'])) {
    $page_number = $_GET['page'];
  } else {
    $page_number = 1;
  }
  $offset = ($page_number - 1) * $limit;
  if (isset($_POST['submit'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $post = mysqli_real_escape_string($conn, $_POST['post']);
    $image = $_FILES['post_image'];
    $img_tamp_name = $image['tmp_name'];
    $img_name = uniqid() . "_" . $image['name'];
    $name = $_SESSION['loginsuccessuser'];
    if (empty($title)) {
      $_SESSION['errorMessage'] = "Title can't be empty.";
    } elseif (strlen($title) < 6) {
      $_SESSION['errorMessage'] = "Title should be more than 6 character.";
    } elseif (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM categorys WHERE name = '$category'")) < 1) {
      $_SESSION['errorMessage'] = "No category selected.";
    } elseif (empty($image['name'])) {
      $_SESSION['errorMessage'] = "Image can't be empty.";
    } elseif (!isset($_SESSION['loginsuccessuser'])) {
      $_SESSION['errorMessage'] = "Login required.";
      redirectTo("/signin.php");
    } else {
      $image_location = "../upload/";
      $image_move = move_uploaded_file($img_tamp_name, $image_location . $img_name);
      $query = mysqli_query($conn, "INSERT INTO posts (title, category, image, post, author, email, status) VALUES ('$title', '$category', '$img_name', '$post', '$name', '{$_SESSION['loginsuccessuseremail']}', 'Inactive')");
      $query_image = mysqli_query($conn, "INSERT INTO media (name, author) VALUES ('$img_name', '{$_SESSION['loginsuccessuseremail']}')");
      if ($query && $query_image && $image_move) {
        $_SESSION['successMessage'] = "Post created successfully.";
        redirectTo("posts.php");
      } else {
        $_SESSION['errorMessage'] = "Something went wrong.";
      }
    }
  }
  if (isset($_POST['update'])) {
    $post_id = $_GET['edit-id'];
    $check_id = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM posts WHERE email = '{$_SESSION['loginsuccessuseremail']}' AND id = '$post_id'"));
    if ($check_id == 1) {
      $title = mysqli_real_escape_string($conn, $_POST['title']);
      $category = mysqli_real_escape_string($conn, $_POST['category']);
      $post = mysqli_real_escape_string($conn, $_POST['post']);
      $image = $_FILES['post_image'];
      $img_tamp_name = $image['tmp_name'];
      $img_name = uniqid() . "_" . $image['name'];
      if (empty($post_id)) {
        $_SESSION['errorMessage'] = "Something went wrong.";
      } elseif (!isset($_SESSION['loginsuccessuser'])) {
        $_SESSION['errorMessage'] = "Login required.";
        redirectTo("/signin.php");
      } elseif (empty($title)) {
        $_SESSION['errorMessage'] = "Title can't be empty.";
      } elseif (strlen($title) < 6) {
        $_SESSION['errorMessage'] = "Title should be more than 6 character.";
      } elseif (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM categorys WHERE name = '$category'")) < 1) {
        $_SESSION['errorMessage'] = "No category selected.";
      } elseif (empty($image['name'])) {
        $query = mysqli_query($conn, "UPDATE posts SET title = '$title', category = '$category', post = '$post' WHERE id = '$post_id'");
        if ($query) {
          $_SESSION['successMessage'] = "Post updated.";
          redirectTo("posts.php");
        } else {
          $_SESSION['errorMessage'] = "Failed to update post.";
        }
      } else {
        $image_location = "../upload/";
        $image_move = move_uploaded_file($img_tamp_name, $image_location . $img_name);
        $query = mysqli_query($conn, "UPDATE posts SET title = '$title', category = '$category', image = '$img_name', post = '$post' WHERE id = '$post_id'");
        $query_image = mysqli_query($conn, "INSERT INTO media (name, author) VALUES ('$img_name', '{$_SESSION['loginsuccessuseremail']}')");
        if ($query && $query_image && $image_move) {
          $_SESSION['successMessage'] = "Post updated.";
          redirectTo("posts.php");
        } else {
          $_SESSION['errorMessage'] = "Failed to update post.";
        }
      }
    } else {
      $_SESSION['errorMessage'] = "You have no permission to edit this post.";
      redirectTo("posts.php");
    }
  }
?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <title><?php
            $site_info_result = mysqli_query($conn, "SELECT * FROM site_settings");
            while ($siteinfo = mysqli_fetch_assoc($site_info_result)) {
              echo "Manage Posts - " . $siteinfo['site_name'];
            ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='../upload/img/<?php echo $siteinfo['favicon']; ?>' rel='icon' type='image/x-icon' />
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin-style.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/dashboard.css">
    <script src="/admin/ckeditor/ckeditor.js"></script>
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
                <a class="nav-link active" href="posts.php">
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
              <a href="index.php">Home</a> / Manage Posts
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
              $check_id = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM posts WHERE email = '{$_SESSION['loginsuccessuseremail']}' AND id = '$edit_id'"));
              if ($check_id == 1) {
                $post_edit = mysqli_query($conn, "SELECT * FROM posts WHERE id = '$edit_id'");
                while ($post_edit_row = mysqli_fetch_assoc($post_edit)) {
                  $postId = $post_edit_row['id'];
                  $postTitle = $post_edit_row['title'];
                  $postCategory = $post_edit_row['category'];
                  $postImage = $post_edit_row['image'];
                  $postPost = $post_edit_row['post'];
            ?>
                  <div class="widget">
                    <div class="widget-title">
                      <h3 class="title">
                        <i class="fa fa-pencil-square-o" aria-hidden="true">
                        </i>&nbsp;Update Post
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
                            <input class="form-control" type="text" name="title" id="title" placeholder="Title" value="<?php echo $postTitle; ?>">
                          </div>
                          <div class="form-group">
                            <label for="categoryselect">
                              <span class="fieldinfo">Category:
                              </span>
                            </label>
                            <select class="form-control" id="categoryselect" name="category">
                              <option><?php echo $postCategory; ?></option>
                              <?php
                              $categoryview = mysqli_query($conn, "SELECT * FROM categorys ORDER BY id desc");
                              $count = mysqli_num_rows($categoryview);
                              $srNO = 0;
                              if ($count > 0) {
                                while ($categoryrow = mysqli_fetch_assoc($categoryview)) {
                                  $catname = $categoryrow['name'];
                              ?>
                                  <option><?php echo $catname; ?></option>
                              <?php
                                }
                              } else {
                                echo "<option>No Category</option>";
                              }
                              ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="imageselect">
                              <span class="fieldinfo">Select Image:
                              </span>
                            </label>
                            <br>
                            <img style="margin: auto;" width="240" height="150" alt="<?php echo $postTitle; ?>" src="../upload/<?php echo $postImage; ?>">
                            <br>
                            <br>
                            <input class="form-control" type="file" name="post_image" id="imageselect">
                            <p><em>Fill this field only if you want to change the image.</em></p>
                          </div>
                          <div class="form-group">
                            <label for="postarea">
                              <span class="fieldinfo">Post:
                              </span>
                            </label>
                            <textarea class="form-control" name="post" id="articleContent" style="height: 100px">
                        <?php echo $postPost; ?>
                      </textarea>
                            <script type="text/javascript">
                              CKEDITOR.replace('articleContent');
                            </script>
                          </div>
                          <center>
                            <input class="btn btn-success" type="submit" name="update" value="Update Post">
                            <a href="posts.php" class="btn btn-danger">
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
              } else {
                $_SESSION['errorMessage'] = "You have no permission to edit this post.";
                redirectTo("posts.php");
              }
            } else {
              ?>
              <div class="widget">
                <div class="widget-title">
                  <h3 class="title">
                    <i class="fa fa-pencil-square-o" aria-hidden="true">
                    </i>&nbsp;Add New Post
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
                        <input class="form-control" type="text" name="title" id="title" placeholder="Title" value="<?php if (isset($title)) {echo $title;} ?>">
                      </div>
                      <div class="form-group">
                        <label for="categoryselect">
                          <span class="fieldinfo">Category:
                          </span>
                        </label>
                        <select class="form-control" id="categoryselect" name="category">
                          <?php
                          $categoryview = mysqli_query($conn, "SELECT * FROM categorys ORDER BY id desc");
                          $count = mysqli_num_rows($categoryview);
                          $srNO = 0;
                          if ($count > 0) {
                            while ($categoryrow = mysqli_fetch_assoc($categoryview)) {
                              $catname = $categoryrow['name'];
                          ?>
                              <option><?php echo $catname; ?></option>
                          <?php
                            }
                          } else {
                            echo "<option>No Category</option>";
                          }
                          ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="imageselect">
                          <span class="fieldinfo">Select Image:
                          </span>
                        </label>
                        <input class="form-control" type="file" name="post_image" id="imageselect">
                      </div>
                      <div class="form-group">
                        <label for="postarea">
                          <span class="fieldinfo">Post:
                          </span>
                        </label>
                        <textarea class="form-control" name="post" id="articleContent" style="height: 100px"><?php if (isset($post)) {
                                                                                                                echo $post;
                                                                                                              } ?></textarea>
                        <script type="text/javascript">
                          CKEDITOR.replace('articleContent');
                        </script>
                      </div>
                      <center>
                        <input class="btn btn-success" type="submit" name="submit" value="Add New Post">
                      </center>
                    </fieldset>
                  </form>
                </div>
              </div>
            <?php
            } ?>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <div class="widget">
                  <div class="widget-title">
                    <h3 class="title">
                      <i class="fa fa-pencil-square" aria-hidden="true">
                      </i>&nbsp;All Posts
                    </h3>
                  </div>
                  <div class="widget-content">
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped table-hover dataTable no-footer dtr-inline">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Date &amp; Time</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Creator Name</th>
                            <th>Views</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody style="font-weight: normal!important;">
                          <?php
                          $post_view_query = "SELECT * FROM posts WHERE email = '{$_SESSION['loginsuccessuseremail']}' ORDER BY id desc LIMIT {$offset}, {$limit}";
                          $post_view_query_result = mysqli_query($conn, $post_view_query);
                          $srNo = 0;
                          if (mysqli_num_rows($post_view_query_result) > 0) {
                            while ($post_view_row = mysqli_fetch_assoc($post_view_query_result)) {
                              $post_id = $post_view_row['id'];
                              $post_date = $post_view_row['datetime'];
                              $post_title = $post_view_row['title'];
                              $post_category = $post_view_row['category'];
                              $post_author = $post_view_row['author'];
                              $post_image = $post_view_row['image'];
                              $post_post = $post_view_row['post'];
                              $post_status = $post_view_row['status'];
                              $post_views = $post_view_row['views'];
                              $srNo++;
                          ?>
                              <tr>
                                <th><?php echo $srNo; ?></th>
                                <th><?php echo $post_date; ?></th>
                                <th width="15%"><a target="_blank" title="Click to view post." href="../article/<?php echo $post_id; ?>">
                                    <strong>
                                      <?php echo $post_title; ?>
                                    </strong></a></th>
                                <th><?php echo $post_status; ?></th>
                                <th><?php echo $post_category; ?></th>
                                <th><img width="130" height="60" alt="<?php echo $post_title; ?>" src="../upload/<?php echo $post_image; ?>"></th>
                                <th><?php echo $post_author; ?></th>
                                <th><?php echo $post_views; ?></th>
                                <th><a href="?edit-id=<?php echo $post_id; ?>" title="View / Edit" class="btn btn-primary">
                                    <i class="fa fa-edit">
                                    </i> Edit
                                  </a></th>
                              </tr>
                          <?php
                            }
                          } else {
                            echo "<tr><th colspan='9'>No post found.</th></tr>";
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                    <?php
                    $post_page_query = mysqli_query($conn, "SELECT * FROM posts WHERE email = '{$_SESSION['loginsuccessuseremail']}' ORDER BY id desc");
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