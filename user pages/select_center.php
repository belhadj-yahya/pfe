<?php
require_once "../db_con/cone.php";
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}
unset($_SESSION["event_id"]);
$centers = $con->query("SELECT * FROM donation_centers");
$centers = $centers->fetchAll(PDO::FETCH_ASSOC);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["center_id"] = $_POST["id"];
    echo "done";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/pfe/user styles/centers.css">
    <title>centers</title>
</head>

<body>
    <main>
        <div class="small_header">
            <img src="/pfe/user images/logo.png" class="logo" alt="">
            <a class="back" href="/pfe/index.php"><img src="/pfe/user images/arrow-left-solid.svg" class="icon" alt="">Go Back</a>
        </div>
        <div class="intro">
            <h1>Select a Center</h1>
            <p>Please select a donation center from the list below. Your selection will be used to process your request.</p>
        </div>
        <section>
            <?php
            foreach ($centers as $center) {
                echo <<<HTML
                        <div class="first_div">
                                <input type="hidden" value="{$center['center_id']}" name="center_id">
                            <div class="second_div">
                                <img src="{$center['center_image']}" class="center_img" alt="">
                                <div>
                                    <div class="first_text">
                                        <p>{$center['center_name']}</p>
                                    </div>
                                    <div class="text_div">
                                        <p class="location_p"><img src="/pfe/user images/location.svg" class="icon" alt=""> {$center['center_location']}</p>
                                        <p class="phone_p"><img src="/pfe/user images/phone-solid(1).svg" class="icon" alt=""> {$center['contact_number']}</p>
                                        <p>Open From {$center['opening_hours']} To {$center['closing_hour']}</p>
                                    </div>
                                </div>
                                <img src="/pfe/user images/circle-check-solid.svg"  class="icon1" alt="">
                            </div>
                        </div>
                    HTML;
            }
            ?>
        </section>
        <form method="post">
            <input type="submit" class="send" value="Confirm Selection">
        </form>
    </main>
    <script src="/pfe/jquery-3.7.1.js"></script>
    <script src="/pfe/user scripts/center.js"></script>
</body>

</html>