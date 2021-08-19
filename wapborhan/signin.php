<?php
include 'include/functions.php';
include 'include/config.php';
if (!isset($_SESSION['loginsuccessuser'])) {
  if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $checkuser = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user WHERE email = '$email' and password = '$password'"));
    if (empty($email) || empty($password)) {
      $_SESSION['errorMessage'] = "All feild are required!";
    } elseif ($checkuser != 1) {
      $_SESSION['errorMessage'] = "Incorrect email address or password!";
    } elseif ($checkuser == 1) {
      $query_login = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email' AND password = '$password'");
      while ($query_login_row = mysqli_fetch_assoc($query_login)) {
        $status = $query_login_row['status'];
        $firstname = $query_login_row['first_name'];
        $lastname = $query_login_row['last_name'];
        $user_email = $query_login_row['email'];
        if ($status == "Active") {
          $_SESSION['successMessage'] = "Welcome, " . "$firstname" . " " . "$lastname";
          $_SESSION['loginsuccessuser'] = "$firstname" . " " . "$lastname";
          $_SESSION['loginsuccessuseremail'] = $user_email;
          redirectTo("user/index.php");
        } else {
          $_SESSION['errorMessage'] = "Dear, " . $firstname . " " . $lastname . ". Your account is inactivated by administration.";
          redirectTo("signin.php");
        }
      }
    }
  }
?>
  <!DOCTYPE html>
  <html>
  <head>
    <title><?php echo "Sign In - " . siteinfo('site_name');
            ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='upload/img/<?php echo siteinfo('favicon'); ?>' rel='icon' type='image/x-icon' />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/public-style.css">
    <style type="text/css">
      .card {
        margin-bottom: 10px;
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="/index.php">
        <img src="upload/img/<?php echo siteinfo('logo'); ?>" width="130" height="30">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
        </span>
      </button>
      <div class="collapse navbar-collapse dark" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="signin.php">Sign In
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="signup.php">Sign Up
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categorys</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <?php
              $category_query = "SELECT * FROM categorys";
              $category_query_result = mysqli_query($conn, $category_query);
              $category_count = mysqli_num_rows($category_query_result);
              if ($category_count > 0) {
                while ($category_row = mysqli_fetch_assoc($category_query_result)) {
                  $category_name = $category_row['name'];
                  $category_perma = $category_row['permalink'];
              ?>
                  <a class="dropdown-item" href="category/<?php echo $category_perma; ?>"><?php echo $category_name; ?></a>
              <?php
                }
              } else {
                echo '<a class="dropdown-item">No Category</a>';
              }
              ?>
            </div>
          </li>
        </ul>
        <div class="form-inline mt-2 mt-md-0">
          <ul class="list-unstyled list-inline text-center">
            <li class="list-inline-item">
              <a class="btn-floating btn-fb mx-1" href="<?php echo siteinfo('facebook'); ?>" style="color: #ffffff;"><i class="fa fa-facebook-square fa-1x" aria-hidden="true"></i></a>
            </li>
            <li class="list-inline-item">
              <a class="btn-floating btn-tw mx-1" href="<?php echo siteinfo('twitter'); ?>" style="color: #ffffff;"><i class="fa fa-twitter-square fa-1x" aria-hidden="true"></i></a>
            </li>
            <li class="list-inline-item">
              <a class="btn-floating btn-gplus mx-1" href="<?php echo siteinfo('instagram'); ?>" style="color: #ffffff;"><i class="fa fa-instagram fa-1x" aria-hidden="true"></i></a>
            </li>
            <li class="list-inline-item">
              <a class="btn-floating btn-li mx-1" href="<?php echo siteinfo('youtube'); ?>" style="color: #ffffff;"><i class="fa fa-youtube-square fa-1x" aria-hidden="true"></i></a>
            </li>
            <li class="list-inline-item">
              <a class="btn-floating btn-dribbble mx-1" href="<?php echo "mailto:" . siteinfo('email'); ?>" style="color: #ffffff;"><i class="fa fa-envelope fa-1x" aria-hidden="true"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container">
      <aside class="col-xl-5 mx-auto">
        <div class="card">
          <article class="card-body">
            <?php
            echo errorMessage();
            echo successMessage();
            ?>
            <a href="signup.php" class="float-right btn btn-outline-primary">Sign Up</a>
            <h4 class="card-title mb-4 mt-1">Sign In</h4>
            <form method="POST">
              <div class="form-group">
                <input class="form-control" placeholder="Email" type="email" name="email">
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Password" type="password" name="password">
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-primary btn-block" name="login" value="Sign In">
              </div>
            </form>
          </article>
        </div>
      </aside>
    </div>
    <footer class="page-footer font-small pt-4 bg-dark">
      <div class="container text-center text-md-left">
        <div class="row">
          <div class="col-md-4 mx-auto">
            <h5 class="font-weight-bold text-uppercase mt-3 mb-4">
              <?php echo siteinfo('site_name'); ?>
            </h5>
            <p style="text-align:justify;"><?php echo siteinfo('description'); ?>
            </p>
            <a href="about-us.php">
              <span class="readmore">Read More</span><br><br>
            </a>
          </div>
          <hr class="clearfix w-100 d-md-none">
          <div class="col-md-4 mx-auto">
            <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Popular Posts
            </h5>
            <?php
            $popular_post_view_query = "SELECT * FROM posts WHERE status = 'Active' ORDER BY views desc LIMIT 0, 2";
            $popular_post_view_query_result = mysqli_query($conn, $popular_post_view_query);
            if (mysqli_num_rows($popular_post_view_query_result) > 0) {
              while ($popular_post_view_row = mysqli_fetch_assoc($popular_post_view_query_result)) {
                $post_id = $popular_post_view_row['id'];
                $post_date = $popular_post_view_row['datetime'];
                $post_title = $popular_post_view_row['title'];
                $post_image = $popular_post_view_row['image'];
                $post_post = $popular_post_view_row['post'];
            ?>
                <div class="row">
                  <div class="col-3">
                    <a class="post-title" href="article/<?php echo $post_id; ?>">
                      <img alt="<?php echo $post_title; ?>" src="upload/<?php echo $post_image; ?>" width="80" height="65" class="popular-post-thumb">
                    </a>
                  </div>
                  <div class="col-8">
                    <a class="post-title" href="article/<?php echo $post_id; ?>">
                      <?php echo $post_title; ?>
                    </a>
                    <div class="date">
                      <i class="fa fa-clock-o" aria-hidden="true">
                      </i>&nbsp;
                      <?php echo $post_date; ?>
                    </div>
                  </div>
                </div>
                <br>
            <?php
              }
            } else {
              echo "No post found.";
            }
            ?>
          </div>
          <hr class="clearfix w-100 d-md-none">
          <div class="col-md-2 mx-auto">
            <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Links
            </h5>
            <ul class="list-unstyled">
              <li>
                <a href="about-us.php">About Us</a>
              </li>
              <li>
                <a href="contact-us.php">Contact Us</a>
              </li>
              <li>
                <a href="advertise.php">Advertise</a>
              </li>
              <li>
                <a href="privacy-policy.php">Privacy &amp; Policy</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <hr>
      <ul class="list-unstyled list-inline text-center">
        <li class="list-inline-item">
          <a class="btn-floating btn-fb mx-1" href="<?php echo siteinfo('facebook'); ?>">
            <i class="fa fa-facebook-square fa-2x" aria-hidden="true">
            </i>
          </a>
        </li>
        <li class="list-inline-item">
          <a class="btn-floating btn-tw mx-1" href="<?php echo siteinfo('twitter'); ?>">
            <i class="fa fa-twitter-square fa-2x" aria-hidden="true">
            </i>
          </a>
        </li>
        <li class="list-inline-item">
          <a class="btn-floating btn-gplus mx-1" href="<?php echo siteinfo('instagram'); ?>">
            <i class="fa fa-instagram fa-2x" aria-hidden="true">
            </i>
          </a>
        </li>
        <li class="list-inline-item">
          <a class="btn-floating btn-li mx-1" href="<?php echo siteinfo('youtube'); ?>">
            <i class="fa fa-youtube-square fa-2x" aria-hidden="true">
            </i>
          </a>
        </li>
        <li class="list-inline-item">
          <a class="btn-floating btn-dribbble mx-1" href="<?php echo "mailto:" . siteinfo('email'); ?>">
            <i class="fa fa-envelope fa-2x" aria-hidden="true">
            </i>
          </a>
        </li>
      </ul>
      <div class="footer-copyright text-center py-3">Copyright © <?php echo date("Y"); ?>&nbsp;
        <a href="/index.php"><?php echo siteinfo('site_name'); ?></a>
      </div>
    </footer>
    <script src="assets/js/jquery-3.5.1.slim.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
  </body>
  </html>
<?php
} else {
  $_SESSION['successMessage'] = "You are logged in.";
  redirectTo("user/index.php");
}
?>