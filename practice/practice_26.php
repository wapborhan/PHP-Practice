<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Php Practice</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <section id="site">
        <section id="header">
            <div class="head">
                <?php echo "PHP FUNDAMENTAL TRAINING"; ?>
            </div>
        </section>
        <div class="main">

            <?php
            echo "Directory: ";
            echo $_SERVER['PHP_SELF'];
            echo "<br/>";

            echo "Server Name: ";
            echo $_SERVER['SERVER_NAME'];
            echo "<br/>";

            echo "Script Name: ";
            echo $_SERVER['SCRIPT_NAME'];
            echo "<br/>";

            echo "Script Name: ";
            echo $_SERVER['HTTP_USER_AGENT'];
            echo "<br/>";

            echo "IP Adress: ";
            echo $_SERVER['SERVER_ADDR'];
            ?>

            <div>
                <h2>Superglobals($_REQUEST & $_POST)</h2>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                    User Name: <input type="text" id="fname" name="username">

                    <input type="submit" value="Submit">
                </form>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $name = $_REQUEST['username'];
                    if (empty($name)) {
                        echo "<span style='color:red;'>Username Field Must Not be Empth!!</span>";
                    } else {
                        echo "<span style='color:green;'>You Have Submitted: " . $name . "</span>";
                    }
                }
                ?>

            </div>

            <div>
                <h2>Superglobals($_GET)</h2>
                <a href="text.php?msg=Hello&txt=Borhan">Send TEXT</a>
                <?php

                ?>

            </div>



           

        </div>
        <section id="footer">
            <div class="foot"> <?php echo "www.php.net"; ?>
            </div>
        </section>
    </section>

</body>

</html>