<?php
include '../include/functions.php';
include '../include/config.php';
if (isset($_SESSION['loginsuccess'])) {
   $_SESSION['successMessage'] = "You are logged in.";
   redirectTo("dashboard.php");
}else{
if (isset($_POST['submit'])) {
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = mysqli_real_escape_string($conn, md5($_POST['password']));
   $checkadmin = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM admins WHERE email = '$email' AND password = '$password'"));
   if (empty($email) || empty($password)) {
      $_SESSION['errorMessage'] = "All feild is required.";
   }elseif ($checkadmin != 1) {
      $_SESSION['errorMessage'] = "Incorrect email address or password.";
   }elseif ($checkadmin == 1) {
      $query_login = mysqli_query($conn, "SELECT * FROM admins WHERE email = '$email' AND password = '$password'");
      while ($query_login_row = mysqli_fetch_assoc($query_login)) {
         $firstName = $query_login_row['first_name'];
         $lastName = $query_login_row['last_name'];
         $_SESSION['successMessage'] = "Welcome, "."$firstName"." "."$lastName";
         $_SESSION['loginsuccess'] = "$firstName"." "."$lastName";
         $_SESSION['loginsuccessemail'] = "$email";
         redirectTo("dashboard.php");
      }
   }else{
    $_SESSION['errorMessage'] = "Something went wrong.";  
   }
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Admin Login</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="../assets/css/admin-style.css">
      <style type="text/css">
         html,
         body {
         height: 100%;
         }
         body {
         display: -ms-flexbox;
         display: flex;
         -ms-flex-align: center;
         align-items: center;
         padding-top: 40px;
         padding-bottom: 40px;
         background-color: #f5f5f5;
         }
         .form-signin {
         width: 100%;
         max-width: 330px;
         padding: 15px;
         margin: auto;
         }
         .form-signin .checkbox {
         font-weight: 400;
         }
         .form-signin .form-control {
         position: relative;
         box-sizing: border-box;
         height: auto;
         padding: 10px;
         font-size: 16px;
         }
         .form-signin .form-control:focus {
         z-index: 2;
         }
         .form-signin input[type="email"] {
         margin-bottom: -1px;
         border-bottom-right-radius: 0;
         border-bottom-left-radius: 0;
         }
         .form-signin input[type="password"] {
         margin-bottom: 10px;
         border-top-left-radius: 0;
         border-top-right-radius: 0;
         }
      </style>
   </head>
   <body class="text-center">
      <div class="container">
         <div style="background: #F8F9FA;border: 1px solid #DDDDDD; border-radius: 05px; max-width: 400px; margin: auto;">
            <form method="POST" class="form-signin">
               <h1 class="h3 mb-3 font-weight-normal">Admin Sign In</h1>
               <hr><br>
<?php
        echo errorMessage();
        echo successMessage();
?>
               <label for="inputEmail" class="sr-only">Email address</label>
               <input name="email" type="email" id="inputEmail" class="form-control" value="<?php if(isset($email)){echo $email;} ?>" placeholder="Email address" required autofocus>
               <label for="inputPassword" class="sr-only">Password</label>
               <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
               <button name="submit" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            </form>
         </div>
      </div>
    <script src="../assets/js/jquery-3.5.1.slim.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
   </body>
</html>
<?php } ?>