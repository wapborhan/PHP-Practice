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
if (isset($_POST['submit'])) {
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $permalink = strtolower(str_replace(" ","-",$category));
    $name = $_SESSION['loginsuccess'];
    if (!isset($_SESSION['loginsuccess'])){
        $_SESSION['errorMessage'] = "Login required.";
        redirectTo("index.php");
    } elseif (empty($category)) {
        $_SESSION['errorMessage'] = "All field must be filled out.";
    } elseif (strlen($category) > 99) {
        $_SESSION['errorMessage'] = "Category name can't be more than 100 character.";
    } else {
        $query = mysqli_query($conn, "INSERT INTO categorys (name, permalink, creatorname) VALUES ('$category', '$permalink', '$name')");
        if ($query) {
            $_SESSION['successMessage'] = "Category created successfully.";
            redirectTo("categorys.php");
        } else {
            $_SESSION['errorMessage'] = "Something went wrong.";
        }
    }
}
if (isset($_GET['delete-id'])) {
  if (isset($_SESSION['loginsuccess'])) {
        $delete_id = $_GET['delete-id'];
        $category_delete = mysqli_query($conn, "DELETE FROM categorys WHERE id = '$delete_id'");
    if ($category_delete) {
        $_SESSION['successMessage'] = "Category deleted.";
        redirectTo("categorys.php");
    } else {
        $_SESSION['errorMessage'] = "Failed to delete category.";
       redirectTo("categorys.php");
    }
  }else{
      $_SESSION['errorMessage'] = "Login required.";
  redirectTo("index.php");
  }
}
if (isset($_POST['update'])) {
    $category_id = $_GET['edit-id'];
    $categoryName = mysqli_real_escape_string($conn, $_POST['categoryupdate']);
    $category_perma = mysqli_real_escape_string($conn, $_POST['permalinkupdate']);
    $categoryPermalink = strtolower(str_replace(" ", "-", $category_perma));
    if (!isset($_SESSION['loginsuccess'])){
        $_SESSION['errorMessage'] = "Login required.";
        redirectTo("index.php");
    } elseif (empty($categoryName) || empty($categoryPermalink)) {
        $_SESSION['errorMessage'] = "Category name and permalink can't be empty.";
    } elseif (strlen($categoryName) > 99) {
        $_SESSION['errorMessage'] = "Category name can't be more than 100 character.";
    } else {
        $update_query = mysqli_query($conn, "UPDATE categorys SET name = '$categoryName', permalink = '$categoryPermalink' WHERE id = '$category_id'");
        if ($update_query) {
            $_SESSION['successMessage'] = "Category updated.";
            redirectTo("categorys.php");
        } else {
            $_SESSION['errorMessage'] = "Failed to update category.";
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
    echo "Categorys - " . $siteinfo['site_name'];
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
                <a class="nav-link active" href="categorys.php">
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
              <a href="index.php">Home</a> / Categorys
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
    $category_edit = mysqli_query($conn, "SELECT * FROM categorys WHERE id = '$edit_id'");
    while ($category_edit_row = mysqli_fetch_assoc($category_edit)) {
        $category_name = $category_edit_row['name'];
        $category_permalink = $category_edit_row['permalink'];
?>
            <div class="widget">
              <div class="widget-title">
                <h3 class="title">
                  <i class="fa fa-tags" aria-hidden="true">
                  </i>&nbsp;Update Category
                </h3>
              </div>
              <div class="widget-content">
                <form method="POST" autocomplete="off">
                  <fieldset>
                    <div class="form-group">
                      <label for="categoryname">
                        <span class="fieldinfo">Name:
                        </span>
                      </label>
                      <input class="form-control" type="text" name="categoryupdate" id="categoryname" placeholder="Name" value="<?php echo $category_name; ?>">
                    </div>
                    <div class="form-group">
                      <label for="categorypermalink">
                        <span class="fieldinfo">Permalink:
                        </span>
                      </label>
                      <input class="form-control" type="text" name="permalinkupdate" id="categorypermalink" placeholder="Permalink" value="<?php echo $category_permalink; ?>">
                    </div>
                    <center>
                      <input class="btn btn-success" type="submit" name="update" value="Update Category">
                      <a href="categorys.php" class="btn btn-danger">
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
?>
            <div class="widget">
              <div class="widget-title">
                <h3 class="title">
                  <i class="fa fa-tags" aria-hidden="true">
                  </i>&nbsp;Add New Category
                </h3>
              </div>
              <div class="widget-content">
                <form method="POST" autocomplete="off">
                  <fieldset>
                    <div class="form-group">
                      <label for="categoryname">
                        <span class="fieldinfo">Name:
                        </span>
                      </label>
                      <input class="form-control" type="text" name="category" id="categoryname" placeholder="Name">
                    </div>
                    <center>
                      <input class="btn btn-success" type="submit" name="submit" value="Add New Category">
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
                      <i class="fa fa-tags" aria-hidden="true">
                      </i>&nbsp;All Categorys
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
                            <th>Name
                            </th>
                            <th>Creator
                            </th>
                            <th>Post
                            </th>
                            <th>Action
                            </th>
                          </tr>
                        </thead>
                        <tbody style="font-weight: normal!important;">
                          <?php
$categoryview = mysqli_query($conn, "SELECT * FROM categorys ORDER BY id desc LIMIT {$offset}, {$limit}");
$count = mysqli_num_rows($categoryview);
$srNo = 0;
if ($count > 0) {
    while ($categoryrow = mysqli_fetch_assoc($categoryview)) {
        $catId = $categoryrow['id'];
        $dateTime = $categoryrow['datetime'];
        $name = $categoryrow['name'];
        $creator = $categoryrow['creatorname'];
        $srNo++;
?>                          
                          <tr>    
                            <th>
                              <?php echo $srNo; ?>
                            </th>
                            <th>
                              <?php echo $dateTime; ?>
                            </th>
                            <th>
                              <?php echo $name; ?>
                            </th>
                            <th>
                              <?php echo $creator; ?>
                            </th>
                            <th>
                              <?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM posts WHERE category = '$name'")) ?>
                            </th>
                            <th>
                              <a href="?edit-id=<?php echo $catId; ?>" title="View / Edit" class="btn btn-primary">
                                <i class="fa fa-edit">
                                </i> View / Edit
                              </a>&nbsp;
                              <a onclick="return confirm('Are you sure?')" href="?delete-id=<?php echo $catId; ?>" title="Delete" class="btn btn-danger">
                                <i class="fa fa-remove">
                                </i> Delete
                              </a>
                            </th>
                          </tr>
<?php
    }
} else {
  echo '<tr><th colspan="6">No categorys found.</th></tr>';
}
?>                          
                        </tbody>
                      </table>
                    </div>

                    <?php
            $post_page_query = mysqli_query($conn, "SELECT * FROM categorys");
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