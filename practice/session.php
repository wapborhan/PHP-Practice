<?php 
session_start();
?>
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

    

            <div>
                <h2>Sessions</h2>
                <?php   
                $_SESSION['user'] = "Borhan";
                $_SESSION['pass'] = "123456";
                
                echo "Username is ".$_SESSION['user']."<br/>";
                echo "Username is ".$_SESSION['pass'];
                session_destroy();
                
                
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