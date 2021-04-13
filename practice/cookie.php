<?php 
setcookie('visited', '', time() - 3600);
echo "Cookie deleted";
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
                <h2>Cookie</h2>
                <?php   
                if (!isset($_COOKIE['visited'])){
                    setcookie('visited', '1', time()+86400, '/') or die("Could not set Cookie ");
                    echo "This is frist visit";
                } else{
                    echo "You are old visitor";
                }
                
                
                
                
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