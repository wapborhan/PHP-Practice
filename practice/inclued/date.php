<?php include  'header.php'; ?>
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
<?php include  'footer.php'; ?>