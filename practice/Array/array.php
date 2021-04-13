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
                <h2>PHP Indexed Arrays</h2>
                <?php
                $car = array("Volvo", "BMW", "Toyota");
                echo $car[0] . "<br/>";

                $lenth = count($car) . "<br/>";
                echo "Total Array : " . $lenth;

                for ($i = 0; $i < $lenth; $i++)
                    echo $car[$i] . "<br/>";



                ?>
            </div>

            <div>
                <h2>PHP Associative Arrays</h2>
                <?php
                $members = array(
                    "Abdullah" => "30",
                    "Manmun" => "40",
                    "Momin" => "20",
                    "Ridoy" => "35",
                );
                foreach ($members as $name=>$age){
                    echo "Name : ".$name." Age : ".$age."<br/>";
                }
                ?>
            </div>


            <div>
                <h2>PHP - Multidimensional Arrays</h2>
                <?php
               $brand = array(
                 array("Volvo", "30", "India"),
                 array("BMW", "50", "Bangladesh"),
                 array("Toyota", "40", "Pakistan")  
               );
                echo $brand[0][1];
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