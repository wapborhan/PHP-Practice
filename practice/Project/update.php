<?php
include('config.php');
error_reporting();
$nm = $_GET['nm'];
$pw = $_GET['pw'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .header {
            background: #888;
            padding: 20px 0px;
            text-align: center;
        }

        .form {
            text-align: center;
            padding: 40px 0px;
            background: antiquewhite;
        }

        input {
            padding: 10px 5px;
            margin-bottom: 15px;
            text-transform: capitalize;
        }

        button[type="submit"] {
            background: darkorange;
            padding: 10px 30px;
            border: none;
            border-radius: 20px;
            color: #fff;
            font-weight: 700;
            cursor: pointer;
        }

        table {
            border-collapse: collapse;
            width: 400px;
            color: #588c7e;
            font-family: monospace;
            font-size: 25px;
            text-align: left;
            background: #fff;
            margin: 0 auto;
        }

        th {
            background-color: #588c7e;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2
        }


        .database {
            text-align: center;
            /* padding: 20px 0px; */
            background: chocolate;
            /* width: 400px; */
            align-items: center;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="form">
        <form>
            <input type="text" name="username" value="<?php echo $nm; ?>"><br>
            <input type="password" name="password" value="<?php echo $pw; ?>"><br>
            <button type="submit" value="Submit">Submit</button><br>
        </form>
    </div>
</body>

</html>

<?php
if ($_GET['submit']) {
    $name = $_GET['username'];
    $password = $_GET['password'];
}

$query = "UPDATE login SET username='$name', password='password' Where username='$name'";

$data = mysqli_query($conn, $query);

if ($data) {
    echo "<script> alert('Updated database')</script>";
} else {
    echo "Update Faild";
}
?>