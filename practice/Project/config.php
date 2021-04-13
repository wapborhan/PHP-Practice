<?php 
$conn = mysqli_connect("localhost", "root", "", "php_project_1");
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
?>