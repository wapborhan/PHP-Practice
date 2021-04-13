<?php
$conn = mysqli_connect('localhost', 'root', '', 'crud');
if (isset($_POST['btn'])) {
    $stdname = $_POST['stdname'];
    $stdreg = $_POST['stdreg'];

    if (!empty($stdname) && !empty($stdreg)) {
        $query = "INSERT INTO student(stdname,stdnumber) VALUE('$stdname',$stdreg)";
        $createquery = mysqli_query($conn, $query);
        if ($createquery) {
            echo "Your Data Submited";
        }
    } else {
        echo "Should not be empty";
    }
}

?>
<?php
if (isset($_GET['delete'])) {
    $stdid = $_GET['delete'];
    $query = "DELETE FROM student WHERE id={$stdid}";
    $deletequery = mysqli_query($conn, $query);
    if ($deletequery) {
        echo "Data Removed Successfuly.";
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>



    <div class="container shadow m-5 p-3">
        <form action="" method="post" class="d-flex justify-content-around">
            <input class="form-control" type="text" name="stdname" id="" placeholder="Your Name">
            <input class="form-control" type="number" name="stdreg" id="" placeholder="Your Number">
            <input type="submit" value="Submit" name="btn" class="btn btn-warning">
        </form>
    </div>
    <div class="container m-5 p-3">
        <form action="" method="post" class="d-flex justify-content-around">
            <?php
            if (isset($_GET['update'])) {
                $stdid = $_GET['update'];
                $query = "SELECT * FROM student WHERE id={$stdid}";
                $getdata = mysqli_query($conn, $query);
                while ($up = mysqli_fetch_assoc($getdata)) {
                    $stdid = $up['id'];
                    $stdname = $up['stdname'];
                    $stdnumber = $up['stdnumber'];

            ?>
                    <input class="form-control" type="text" name="stdname" id="" value="<?php echo $stdname  ?>">
                    <input class="form-control" type="number" name="stdreg" id="" value="<?php echo $stdnumber  ?>">
                    <input type="submit" value="update" name="update_btn" class="btn btn-primary">
            <?php }
            }  ?>


            <?php 
                if(isset($_POST['update_btn'])){
                    $stdname = $_POST['stdname'];
                    $stdnumber = $_POST['stdreg'];

                    $query = "UPDATE student SET stdname='$stdname', stdnumber=$stdnumber WHERE id=$stdid";

                    $uodatequery = mysqli_query($conn, $query);
                    if($uodatequery){
                        echo "Update Data";
                    }

                }
            ?>
        </form>
    </div>
    <div class="container">
        <table class="table table-bordered">
            <tr>
                <th>Student Id</th>
                <th>Student Name</th>
                <th>Student Reg</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            $query = "SELECT * FROM student";
            $readquery = mysqli_query($conn, $query);
            if ($readquery->num_rows > 0) {
                while ($rd = mysqli_fetch_assoc($readquery)) {
                    $stdid = $rd['id'];
                    $stdname = $rd['stdname'];
                    $stdnumber = $rd['stdnumber'];

            ?>

                    <tr>
                        <td><?php echo $stdid;  ?></td>
                        <td><?php echo $stdname;  ?></td>
                        <td><?php echo $stdnumber;  ?></td>
                        <td><a href="index.php?update=<?php echo $stdid;  ?>" class="btn btn-success">Update</a></td>
                        <td><a href="index.php?delete=<?php echo $stdid;  ?>" class="btn btn-danger">Delete</a></td>
                    </tr>
            <?php }
            } else {
                echo "No data show";
            } ?>
        </table>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>