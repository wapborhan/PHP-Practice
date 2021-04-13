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
                <h2>Date & Time</h2>

                <?php
                echo "Today " . date("d/m/Y") . "<br/>";
                echo "Day " . date("l") . "<br/>";
                echo "Time " . date("h:i:sa") . "<br/>";

                date_default_timezone_set('Asia/Dhaka');
                echo "Time Dhaka " . date("h:i:sa") . "<br/>";
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