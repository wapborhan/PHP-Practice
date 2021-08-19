<?php
include 'include/functions.php';
include 'include/config.php';
if (isset($_POST['send'])) {
  $email = $_POST['email'];
  $body = $_POST['messagearea'];
  $subject = $_POST['subject'];
  if (empty($email) || empty($body) || empty($subject)) {
    $_SESSION['errorMessage'] = "All feild are required!";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['errorMessage'] = "Invalid email address!";
  } elseif ($_POST['captcha'] != $_SESSION['my_captcha']) {
    $_SESSION['errorMessage'] = "Captcha not matched!";
    unset($_SESSION['my_captcha']);
  } else {
    $to = siteinfo('email');
    $header = "From: $email";
    $sendmail = mail($to, $subject, $body, $header);
    if ($sendmail) {
      $_SESSION['successMessage'] = "Email send successfully.";
      redirectTo("/contact-us.php");
    } else {
      $_SESSION['errorMessage'] = "Something went wrong. Please try again later.";
      redirectTo("/contact-us.php");
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php
          echo "Contact Us" . " - " . siteinfo('site_name');
          ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='upload/img/<?php echo siteinfo('favicon'); ?>' rel='icon' type='image/x-icon' />
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/public-style.css">
</head>
<body>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="index.php">
      <img src="upload/img/<?php echo siteinfo('logo'); ?>" width="130" height="30">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon">
      </span>
    </button>
    <div class="collapse navbar-collapse dark" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <?php if (isset($_SESSION['loginsuccessuser'])) { ?>
          <li class="nav-item">
            <a class="nav-link" href="user/index.php">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="user/logout.php">Log Out</a>
          </li>
        <?php } else { ?>
          <li class="nav-item">
            <a class="nav-link" href="signin.php">Sign In</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="signup.php">Sign Up</a>
          </li>
        <?php } ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Categorys
          </a>
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
    <?php
    echo errorMessage();
    echo successMessage();
    ?>
    <?php
    $header_ads = mysqli_query($conn, "SELECT * FROM ads WHERE id = 1 AND status='Active'");
    while ($header_ads_row = mysqli_fetch_assoc($header_ads)) {
      $header_ads_code = $header_ads_row['code'];
    ?>
      <div class="widget">
        <div>
          <?php echo $header_ads_code; ?>
        </div>
      </div>
    <?php } ?>
    <div class="row">
      <div class="col-sm-8">
        <div class="blog-post hentry index-post">
          <?php
          $contact_us_query = mysqli_query($conn, "SELECT * FROM pages WHERE id = 2 AND status = 'Active'");
          while ($contact_us_query_row = mysqli_fetch_assoc($contact_us_query)) {
            $title = $contact_us_query_row['title'];
            $maintopic = $contact_us_query_row['main_topic'];
          ?>
            <h1 class="post-title"><?php echo $title; ?></h1>
            <div class="post-body"><?php echo $maintopic; ?>
              <div class="contact-us">
                <form method="POST" autocomplete="off">
                  <fieldset>
                    <div class="form-group">
                      <label for="email"><span class="fieldinfo">Your Email:</span></label>
                      <input class="form-control" type="text" name="email" id="email" value="<?php if (isset($email)) {
                                                                                                echo $email;
                                                                                              } ?>">
                    </div>
                    <div class="form-group">
                      <label for="subject"><span class="fieldinfo">Subject:</span></label>
                      <input class="form-control" type="text" name="subject" id="subject" value="<?php if (isset($subject)) {
                                                                                                    echo $subject;
                                                                                                  } ?>">
                    </div>
                    <div class="form-group">
                      <label for="messagearea"><span class="fieldinfo">Meaasge:</span></label>
                      <textarea class="form-control" name="messagearea" id="messagearea" style="height: 100px"><?php if (isset($body)) {
                                                                                                                  echo $body;
                                                                                                                } ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="captcha"><span class="fieldinfo">Captcha:</span></label>
                      <img src="include/captcha.php" id="captcha"><button class="btn btn-info refresh-button" type="button" onClick="reload();"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                      <input class="form-control" type="text" name="captcha" id="captcha">
                    </div>
                    <input class="btn btn-primary" type="submit" name="send" value="Send Email">
                  </fieldset>
                </form>
              </div>
              <div class="sectionbtn">
                <ul class="social-btns">
                  <li>
                    <a target="_blank" href="https://www.facebook.com/sharer.php?u=<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" class="social-btn-flip" rel="nofollow">
                      <div class="social-btn-cube">
                        <i class="social-btn-face default fa fa-lg fa-facebook facebook"></i>
                        <i class="social-btn-face active fa fa-lg fa-facebook facebook"></i>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a target="_blank" href="https://twitter.com/intent/tweet?url=<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" class="social-btn-flip" rel="nofollow">
                      <div class="social-btn-cube">
                        <i class="social-btn-face default fa fa-lg fa-twitter twitter"></i>
                        <i class="social-btn-face active fa fa-lg fa-twitter twitter"></i>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a target="_blank" href="https://www.linkedin.com/shareArticle?url=<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" class="social-btn-flip" rel="nofollow">
                      <div class="social-btn-cube">
                        <i class="social-btn-face default fa fa-lg fa fa-linkedin linkedin"></i>
                        <i class="social-btn-face active fa fa-lg fa fa-linkedin linkedin"></i>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a target="_blank" href="https://web.whatsapp.com/send?text=<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" class="social-btn-flip" rel="nofollow">
                      <div class="social-btn-cube">
                        <i class="social-btn-face default fa fa-lg fa-whatsapp whatsapp"></i>
                        <i class="social-btn-face active fa fa-lg fa-whatsapp whatsapp"></i>
                      </div>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="widget">
          <div class="widget-title">
            <h3 class="title">Search</h3>
          </div>
          <div class="widget-content">
            <div>
              <form action="search.php">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Search..." name="s" required>
                  <div class="input-group-append">
                    <input class="btn btn-outline-secondary" type="submit" value="Go">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php
        $sidebar_ads = mysqli_query($conn, "SELECT * FROM ads WHERE id = 2 AND status='Active'");
        while ($sidebar_ads_row = mysqli_fetch_assoc($sidebar_ads)) {
          $sidebar_ads_code = $sidebar_ads_row['code'];
        ?>
          <div class="widget">
            <div>
              <?php echo $sidebar_ads_code; ?>
            </div>
          </div>
        <?php } ?>
        <div class="widget">
          <div class="widget-title">
            <h3 class="title">Category</h3>
          </div>
          <div class="widget-content">
            <ul class="list-group">
              <?php
              $category_query = "SELECT * FROM categorys ORDER BY name";
              $category_query_result = mysqli_query($conn, $category_query);
              $category_count = mysqli_num_rows($category_query_result);
              if ($category_count > 0) {
                while ($category_row = mysqli_fetch_assoc($category_query_result)) {
                  $category_name = $category_row['name'];
                  $category_permalink = $category_row['permalink'];
              ?>
                  <li class="cat-list d-flex justify-content-between align-items-center"><?php echo "<a href='category/" . $category_permalink . "' style='test-align: left;'>" . $category_name . "</a>";
                                                                                          $post_count_cat_query = "SELECT * FROM posts WHERE category = '$category_name' AND status = 'Active'";
                                                                                          $post_count_cat_result = mysqli_query($conn, $post_count_cat_query);
                                                                                          $post_count_cat = mysqli_num_rows($post_count_cat_result);
                                                                                          echo "<span class='badge badge-dark badge-pill'>" . $post_count_cat . "</span>"; ?></li>
              <?php
                }
              } else {
                echo '<li class="cat-list d-flex justify-content-between align-items-center">No Category.</li>';
              }
              ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <?php
    $footer_ads = mysqli_query($conn, "SELECT * FROM ads WHERE id = 3 AND status='Active'");
    while ($footer_ads_row = mysqli_fetch_assoc($footer_ads)) {
      $footer_ads_code = $footer_ads_row['code'];
    ?>
      <div class="widget">
        <div>
          <?php echo $footer_ads_code; ?>
        </div>
      </div>
    <?php } ?>
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
  <script type="text/javascript">
    function reload() {
      img = document.getElementById("captcha");
      img.src = "include/captcha.php?rand_number=" + Math.random();
    }
  </script>
  <script src="assets/js/jquery-3.5.1.slim.min.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>