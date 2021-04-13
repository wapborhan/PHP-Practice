<?php 
    include ("config.php");
    error_reporting(0);

    $id = $_GET['rn'];
    $quary = "DELETE FROM LOGIN WHERE ID='$id'";

    $data = mysqli_query($conn,$quary);

    if($data){
        echo "<script>alert('Record Delete')</script>";
        echo header('location:http://localhost/php/Project/indext.php');
    } else{
        echo "Faild To Delete";
    }

?>

