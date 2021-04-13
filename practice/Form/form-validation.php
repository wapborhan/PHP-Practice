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
                <h2>Form Validation</h2>


                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <table>
                        <tr>
                            <td>Name</td>
                            <td> <input type="text" name="name">  </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td> <input type="text" name="email"> </td>
                        </tr>
                        <tr>
                            <td>Website</td>
                            <td> <input type="text" name="website"> </td>
                        </tr>
                        <tr>
                            <td>Comment</td>
                            <td> <textarea name="comment" id="" cols="30" rows="5"> </textarea> </td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td>
                                <input type="radio" name="gender" value="Female" />Female
                                <input type="radio" name="gender" value="Male" />Male
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" name="submit" value="Submit"></td>
                        </tr>
                    </table>
                </form>

                <?php

                $sname = $email = $website = $comment = $gender = "";


                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                    if (empty($_POST["name"])) {
                        $errsname = "Name Requred";
                    } else {
                        $sname = validate($_POST["name"]);
                    }

                    if (empty($_POST["email"])) {
                        $erremail = "Email Requred";
                    } else {
                        $email = validate($_POST["email"]);
                    }

                    if (empty($_POST["website"])) {
                        $errwebsite = "Website Requred";
                    } else {
                        $website = validate($_POST["website"]);
                    }



                    $comment = validate($_POST["comment"]);
                    $gender = validate($_POST["gender"]);
                }


                echo "Name: " . $sname . "<br/>";
                echo "E-mail: " . $email . "<br/>";
                echo "Website: " . $website . "<br/>";
                echo "Comment: " . $comment . "<br/>";
                echo "Gender: " . $gender . "<br/>";


                function validate($data)
                {
                    $data = trim($data);
                    $data = stripcslashes($data);
                    $data = htmlspecialchars($data);
                    return ($data);
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