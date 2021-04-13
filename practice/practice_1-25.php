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
                <h2>Echo Code</h2>

                <?php
                echo "This is my", " frist php ";

                $fon = "site";

                echo $fon;
                ?>

            </div>
            <div>
                <h2>Math</h2>

                <?php
                $a = 10;
                $b = 5;
                $c = $a + $b;

                echo $c;
                ?>

            </div>

            <div>
                <h2>Type</h2>

                <?php $doc = print("Borhan");
                echo "<br>";
                var_dump($doc);
                ?>


            </div>
            <div>
                <h2>alphabet count</h2>
                <?php
                $x = "PHP Strings-";
                echo $x;
                echo strlen($x);
                ?>
            </div>

            <div>
                <h2>word count</h2>
                <?php
                $x = "PHP Strings-";
                echo $x;
                echo str_word_count($x);
                ?>
            </div>

            <div>
                <h2>Alphabet Reversed</h2>
                <?php
                $x = "PHP Strings - ";
                echo $x;
                echo strrev($x);
                ?>
            </div>

            <div>
                <h2>Word Position</h2>
                <?php
                $x = "PHP is Nice - ";
                echo $x;
                echo strpos($x, "Nice");
                ?>
            </div>
            <div>
                <h2>Word Replace</h2>
                <?php
                $x = "PHP is Nice - ";
                echo $x;
                echo str_replace("PHP", "Java", $x);
                ?>
            </div>

            <div>
                <h2>Value Define</h2>
                <?php
                define("hg", "I love to coding");
                echo hg;
                ?><br>


                <?php
                define("HB", "I love to coding", true);
                echo hb;
                ?>

                <br>
                <?php
                define("HD", "I love to coding");

                function jkl()
                {
                    echo HD;
                }


                jkl();
                ?>

                <br>
                <?php
                define("HS", "I love to coding");

                function jkls()
                {
                    return HS;
                }


                echo jkls();
                ?>


            </div>

            <div>
                <h2>Arithmetic Operators</h2>
                <h5>x=10, y=20</h5>
                <?php
                $x = 10;
                $y = 20;
                ?>
                <?php echo $x + $y;  ?>+<br>
                <?php echo $x - $y;  ?>-<br>
                <?php echo $x * $y;  ?>*<br>
                <?php echo $y / $x;  ?>/<br>
                <?php echo $y % $x;  ?> modiulas<br>
            </div>
            <div>
                <h2>Increment/Decriment</h2>
                <?php
                $x = 10;
                ?>
                <?php echo ++$x; ?><br>
                <?php echo --$x;  ?><br>
                <?php $x++;
                echo $x; ?><br>
                <?php $x--;
                echo $x; ?><br>
            </div>

            <div>
                <h2>Logical Operation</h2>
                <?php
                $x = 10;
                $y = 20;

                if ($x == 10 and $y == 20) {
                    echo "I love Coding";
                } else {
                    echo "Wrong";
                }

                ?>

                <br>
                <?php if ($x == 10 && $y == 20) {
                    echo "I love Coding";
                } else {
                    echo "Wrong";
                }  ?>

                <br>
                <?php if ($x == 10 and $y == 30) {
                    echo "I love Coding";
                } else {
                    echo "Wrong";
                }  ?>

                <br>
                <?php if ($x == 10 || $y == 20) {
                    echo "I love Coding";
                } else {
                    echo "Wrong";
                }  ?>


                <br>
                <?php if ($x == 10 or $y == 30) {
                    echo "I love Coding";
                } else {
                    echo "Wrong";
                }  ?>

                <br>
                <?php if ($x == 20 xor $y == 20) {
                    echo "I love Coding";
                } else {
                    echo "Wrong";
                }  ?>

            </div>


            <div>
                <h2>String Operation</h2>
                <?php
                $x = "training with ";
                $y = "live Project";
                $z = $x . $y;
                echo $z;
                ?>
            </div>


            <div>
                <h2>Array Operation</h2>
                <?php
                $x = array(
                    "a" => "Dhaka",
                    "b" => "Sylhet",
                );
                $y = array(
                    "c" => "comilla",
                    "d" => "Rajshahi",
                );
                var_dump($x + $y);
                var_dump($x == $y);
                var_dump($x === $y);
                ?>
            </div>





            <div>
                <h2>Switch Statements</h2>
                <?php
                $coding = "php";
                switch ($coding) {

                    case "html";
                        echo "I html";
                        break;

                    case "css";
                        echo "I css";
                        break;

                    case "php";
                        echo "I Love Php";
                        break;

                    default:
                        echo "I love Programing";
                }
                ?>
            </div>

            <div>
                <h2>While Loops</h2>
                <?php
                $x = 1;
                while ($x <= 5) {
                    echo "This is $x Number <br/>";
                    $x++;
                }
                ?>
                <h2> Do While Loops</h2>
                <?php
                $y = 7;
                do {
                    echo " This Is $y Number <br/>";
                } while ($y <= 5);

                ?>

            </div>

            <div>
                <h2>While Loops</h2>
                <?php
                for ($i = 0; $i < 10; $i++) {
                    echo "This is $i Number <br/>";
                }


                ?>

            </div>


            <div>
                <h2>foreach Loops</h2>
                <?php
                $colors = array("Green", "Blue", "Grey");
                foreach ($colors as $color) {
                    echo "$color <br/>";
                };

                ?>

            </div>
            <div>
                <h2>Functions</h2>
                <?php
                function school()
                {
                    echo "This Is Good School";
                }

                school();
                ?>

                <?php echo "<br/>"  ?>

                <?php
                function schools($name)
                {
                    echo "$name is a good school";
                }

                schools("Dharampur High school");
                ?>

                <?php echo "<br/>"  ?>

                <?php
                function schoold($names)
                {
                    echo "$names is a good school<br/>";
                }


                schoold("Shatbaria High school");
                schoold("Dharampur High school");
                schoold("Bheramara High school");
                ?>


                <?php echo "<br/>"  ?>

                <?php
                function schoolg($nameq, $year)
                {
                    echo "$nameq is Started $year<br/>";
                }


                schoolg("Shatbaria High school", "1996");
                schoolg("Dharampur High school", "1972");
                schoolg("Bheramara High school", "2000");
                ?>

                <?php echo "<br/>"  ?>

                <?php
                function schoolb($namez = "My School")
                {
                    echo "$namez is Started <br/>";
                }


                schoolb("Shatbaria High school");
                schoolb();
                schoolb("Bheramara High school");
                ?>

                <?php echo "<br/>"  ?>

                <?php
                function sum($x, $y)
                {
                    $z = $x + $y;
                    return $z;
                }
                echo "5+10 equal " . sum(5, 10);
                ?>
            </div>



            <div>
                <h2>Arrays</h2>
                <?php
                $j = array(5, 10, 15, 20, 25);
                echo $j[3];
                echo "<br/>";
                echo count($j);
                ?>
                <?php echo "<br/>"  ?>
                <?php
                $f = array(5, 10, 15, 20, 25);
                $lenth = count($f);

                for ($i = 0; $i < $lenth; $i++) {
                    echo $f[$i];
                    echo "<br/>";
                };
                ?>
                <?php echo "<br/>"  ?>
                <hr />
                <?php
                $ages = array("Karim" => "25", "Rahim" => "32", "Mobin" => "45",);

                foreach ($ages as $x => $age) {
                    echo "Name = " . $x . ", Age = " . $age;
                    echo "<br/>";
                }
                ?>
                <hr />
                <?php
                $cars = array(
                    array("BMQ", 50, "Nice"),
                    array("Odi", 50, 25),
                    array("Volvo", 50, 30),
                    array("Runner", 40, 38)
                );
                echo $cars[0][0];
                echo $cars[0][2];
                echo "<br/>";
                echo "<br/>";

                for ($row = 0; $row < 4; $row++) {
                    echo "<p>Row Number = $row</p>";
                    echo "<ul>";
                    for ($col = 0; $col < 3; $col++) {
                        echo "<li>" . $cars[$row][$col] . "</li>";
                    }
                    echo "</ul>";
                }

                ?>

            </div>


            <div>
                <h2>Sorting Arrays</h2>
                <?php
                $names = array("Badol", "Jabir", "Alom", "Ridoy", "Karim",);
                sort($names);
                $lenth = count($names);
                for ($a = 0; $a < $lenth; $a++) {
                    echo $names[$a];
                    echo "<br/>";
                }
                echo "<hr/>";
                $number = array(5, 15, 10, 25, 30, 35, 20);
                rsort($number);

                $lenth = count($number);
                for ($n = 0; $n < $lenth; $n++) {
                    echo $number[$n];
                    echo "<br/>";
                }
                ?>

            </div>




            <div>
                <h2>Variable Scope</h2>

                <?php
                $x = 10;

                function test1()
                {
                    global $x;
                    $a = 15;
                    echo "Local Variable " . $a;
                    echo "<br/>";
                    echo "Global Variable " . $x;
                    echo "<br/>";
                }

                test1();


                ?>

            </div>




            <div>
                <h2>Superglobals</h2>

                <?php
                $x = 10;
                $y = 20;

                function test()
                {
                    $GLOBALS['z'] = $GLOBALS['x'] + $GLOBALS['y'];
                }
                test();
                echo $z;
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