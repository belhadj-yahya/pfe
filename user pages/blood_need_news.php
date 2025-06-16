<?php
require_once "../db_con/cone.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["event_id"] = $_POST["id"];
    echo "done";
    exit();
}
$blood_needs = $con->query("SELECT news_event_id,blood_type_needed,title,description,news_events_date,center_location,max_units_needed,center_name,news_events.center_id FROM news_events JOIN donation_centers on news_events.center_id = donation_centers.center_id WHERE type = 'event' AND data_of_relais <= NOW() AND news_events_date > NOW()");
$blood_needs = $blood_needs->fetchAll(PDO::FETCH_ASSOC);
$news = $con->query("SELECT data_of_relais,title,description,center_name FROM news_events JOIN donation_centers on news_events.center_id = donation_centers.center_id WHERE type = 'news' AND data_of_relais <= NOW()");
$news = $news->fetchAll(PDO::FETCH_ASSOC);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/pfe/user styles/blood_needs_and_news.css">
    <title>blood need and events</title>
</head>

<body>
    <?php require_once "../inclueds/header.php" ?>
    <main>

        <div class="after_main">
            <div class="div1">
                <h1>blood needs & News</h1>
                <div class="under_line"></div>
            </div>
            <div class="div2">
                <button class="btn1">Blood Needs</button>
                <button class="btn2">News</button>
            </div>
            <div class="events_and_news">
                <?php
                foreach ($blood_needs as $event) {
                    echo <<<HTML
                        <div class="div4">
                            <div class="type_place"><span class="type">{$event["blood_type_needed"]}</span></div>
                            <div class="event_data">
                                <h2 class="event_title">{$event["title"]}</h2>
                                <p class="event_des">{$event["description"]}</p>
                                <div class="event_info">
                                    <div class="date">
                                        <img src="/pfe/user images/calnder_pink.svg" class="data_img" alt="">
                                        <p>Needed by {$event["news_events_date"]}</p>
                                    </div>
                                    <div class="location">
                                        <img src="/pfe/user images/location_pink.svg" class="data_img" alt="">
                                        <p>{$event["center_location"]}</p>
                                    </div>
                                    <div class="unit_needed">
                                        <img src="/pfe/user images/blood_pink.svg" class="data_img" alt="">
                                        <p><span class="unit">{$event["max_units_needed"]}</span> units needed</p>
                                    </div>
                                </div>
                                <div class="last_place">
                                    <p class="center_name">{$event["center_name"]}</p>
                                    <button value="{$event['news_event_id']}" class="donait">Donate Now <img src="/pfe/user images/arrow-right-solid.svg" class="data_img" alt=""></button>
                                </div>
                            </div>
                        </div>
                    HTML;
                }
                ?>
            </div>
            <div class="events_and_news1">
                <?php

                foreach ($news as $new) {
                    echo <<<HTML
                    <div class="div5">
                        <div class="white_ball"></div>
                            <div class="news_info">
                                <div><img src="/pfe/user images/alnder-gray.svg" class="data_img" alt=""> <p>{$new["data_of_relais"]}</p></div>
                                <h2>{$new["title"]}</h2>
                                <p class="center_des">{$new["description"]}</p>
                                <p class="center_name">{$new["center_name"]}</p>
                            </div>
                    </div>
                    HTML;
                }
                ?>
            </div>
        </div>
    </main>
    <?php require_once "../inclueds/footer.php" ?>
    <script src="/pfe/jquery-3.7.1.js"></script>
    <script src="/pfe/user scripts/blood_need_news.js"></script>
</body>

</html>