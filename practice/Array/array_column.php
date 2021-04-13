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
                <h2>Array_column</h2>
                <?php
                $name = array(
                    array(
                        'id' => '200',
                        'frist_name' => 'Borhan',
                        'last_name' => 'Uddin',
                    ),
                    array(
                        'id' => '201',
                        'frist_name' => 'Zihad',
                        'last_name' => 'Biswas',
                    ),
                    array(
                        'id' => '202',
                        'frist_name' => 'Rabby',
                        'last_name' => 'Biswas',
                    ),
                );

                $fristname = array_column($name, 'frist_name', 'id');
                print("<pre>");
                print_r($fristname);
                print("</pre>");

                ?>


            </div>


            <div>
                <h2>array_combine</h2>
                <?php
                $name = array("Akbar", "Mamun", "Delower");
                $age = array("25", "41", "32");

                $comb = array_combine($name, $age);

                print("<pre>");
                print_r($comb);
                print("</pre>");
                ?>


            </div>

            <div>
                <h2>array_count_values</h2>
                <?php
                $name = array("Akbar", "Mamun", "Delower", "Mamun", "Akbar", "Delower", "Akbar");
                $age = array("25", "41", "32");





                print("<pre>");
                print_r(array_count_values($name));
                print("</pre>");
                ?>


            </div>



            <div>
                <h2>array_diff</h2>
                <?php
                $name_1 = array(
                    'a' => 'red',
                    'b' => 'blue',
                    'c' => 'green'
                );
                $name_2 =  array(
                    'a' => 'red',
                    'e' => 'yellow',
                    'b' => 'blue'
                );
                $name_3 =   array(
                    'a' => 'red',
                    'k' => 'pink',
                    'b' => 'blue'
                );


                $diff = array_diff_assoc($name_1, $name_2, $name_3);


                print("<pre>");
                print_r($diff);
                print("</pre>");
                ?>


            </div>


            <div>
                <h2>array_diff_key</h2>
                <?php
                $name_1 = array(
                    'a' => 'red',
                    'b' => 'green',
                    'c' => 'Blue',
                    'c' => 'yellow'

                );
                $name_2 =  array(
                    'a' => 'red',
                    'c' => 'blue',
                    'd' => 'pink'
                );



                $diff = array_diff_key($name_1, $name_2);


                print("<pre>");
                print_r($diff);
                print("</pre>");
                ?>


            </div>



            <div>
                <h2>array_intersect</h2>
                <?php
                $name_1 = array(
                    'a' => 'red',
                    'b' => 'green',
                    'c' => 'blue',
                    'f' => 'yellow'

                );
                $name_2 =  array(
                    'a' => 'red',
                    'c' => 'blue',
                    'd' => 'pink',
                    'key' => 'value'
                );



                $diff = array_intersect($name_1, $name_2);


                print("<pre>");
                print_r($diff);
                print("</pre>");
                ?>


            </div>
            <div>
                <h2>array_intersect_assoc</h2>
                <?php
                $name_1 = array(
                    'a' => 'red',
                    'b' => 'green',
                    'c' => 'blue',
                    'f' => 'yellow'

                );
                $name_2 =  array(
                    'a' => 'red',
                    'c' => 'blue',
                    'd' => 'pink',
                    'key' => 'value'
                );



                $diff = array_intersect_assoc($name_1, $name_2);


                print("<pre>");
                print_r($diff);
                print("</pre>");
                ?>


            </div>


            <div>
                <h2>array_intersect_key</h2>
                <?php
                $name_1 = array(
                    'a' => 'red',
                    'b' => 'green',
                    'c' => 'blue',
                    'f' => 'yellow'

                );
                $name_2 =  array(
                    'a' => 'red',
                    'c' => 'blue',
                    'd' => 'pink',
                    'key' => 'value'
                );

                $diff = array_intersect_key($name_1, $name_2);

                print("<pre>");
                print_r($diff);
                print("</pre>");
                ?>
            </div>


            <div>
                <h2>array_key_exists</h2>
                <?php
                $arr = array(
                    "name" => "Akbar",
                    "age" => "32"
                );




                if (array_key_exists("name", $arr)) {
                    echo "Key Already Exist.";
                } else {
                    echo "Key Dose not Exist.";
                }

                echo "<br>";

                $arr2 = array("name", "age");
                if (array_key_exists(0, $arr2)) {
                    echo "Key Already Exist.";
                } else {
                    echo "Key Dose not Exist.";
                }


                ?>
            </div>


            <div>
                <h2>array_key_exists</h2>
                <?php
                $arr = array(
                    "name" => "Akbar",
                    "age"  => "32",
                    "roll" => "01"
                );

                $results = array_keys($arr);

                print("<pre>");
                print_r($results);
                print("</pre>");

                $result2 = array_keys($arr, "Akbar");
                print("<pre>");
                print_r($result2);
                print("</pre>");


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