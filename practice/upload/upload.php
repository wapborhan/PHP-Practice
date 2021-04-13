<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Php Practice</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <section id="site">
        <section id="header">
            <div class="head">
                <?php echo "PHP FUNDAMENTAL TRAINING"; ?>
            </div>
        </section>
        <div class="main">



            <div>
                <h2>File/Image Upload</h2>
                <?php
                if (isset($_FILES['image'])) {
                    $filename = $_FILES['image']['name'];
                    $filetmp = $_FILES['image']['tmp_name'];
                    move_uploaded_file($filetmp,"images/".$filename);
                    echo "Image Uploded";
                }




                ?>

                <form method="POST" action="" enctype="multipart/form-data">
                    <input type="file" name="image">
                    <input type="submit" value="Submit">
                </form>
            </div>





        </div>
        <section id="footer">
            <div class="foot"> <?php echo "www.php.net"; ?>
            </div>
        </section>
    </section>

</body>

</html>