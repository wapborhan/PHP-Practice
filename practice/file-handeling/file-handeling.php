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
                <h2>File Handling</h2>
           <?php 
            echo readfile ("text.txt");
           ;?>

            </div>



            <div>
                <h2>File Open/Read/Close</h2>
           <?php 

           $openfile = fopen ("text2.txt", "r") or die ("File Not Found !!");
            //echo fread ($openfile,filesize("text2.txt"));
            echo "<br/>";
            //echo fgets ($openfile,filesize("text2.txt"));
            //echo fgetc ($openfile);
            while (!feof($openfile)){
                echo fgets ($openfile)."<br/>";
                        }
            fclose ($openfile);
           ;?>

            </div>



           

        </div>
        <section id="footer">
            <div class="foot"> <?php echo "www.php.net"; ?>
            </div>
        </section>
    </section>

</body>

</html>