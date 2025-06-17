<?php
require_once "db_con/cone.php";
session_start();
unset($_SESSION["center_id"]);
unset($_SESSION["event_id"]);



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["limit"])) {
        $news_data = $con->query("SELECT title,description,type FROM news_events where data_of_relais <= now() and type = 'news' limit 5");
        $event_data = $con->query("SELECT title,description,type FROM news_events where data_of_relais <= now() and type = 'event' limit 5");
        $news_data = $news_data->fetchAll(PDO::FETCH_ASSOC);
        $event_data = $event_data->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(["news" => $news_data, "events" => $event_data]);
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main pages/index.css">
    <title>main</title>
</head>

<body>
    <?php require_once "inclueds/header.php" ?>
    <main>
        <h1>Be the Reason Someone Lives</h1>
        <p>Your single blood donation can save up to three lives. Join our mission to make a difference — it starts with you</p>
        <a href="user pages/select_center.php" class="sned_to">Donate Now</a>
    </main>
    <section>
        <div class="right">
            <h3>Support Our Mission</h3>
            <p>We're dedicated to making a positive impact in our community through innovative programs and initiatives. Your support helps us continue our work and reach more people in need.</p>
            <p>Every contribution makes a difference, no matter the size. Together, we can create meaningful change and build a better future for everyone.</p>
            <a href="user pages/select_center.php" class="sned_to">Donate Now <img src="/pfe/user images/arrow-right-solid.svg" class="sned_to_img" alt=""></a>
            <p>Our organization is committed to transparency and accountability. We ensure that your donations are used effectively to support our programs and the communities we serve.</p>
        </div>
        <div class="left">
            <div class="top">
                <div class="first_above_text">
                    <h1>News</h1>
                    <a href="user pages/blood_need_news.php">See More ></a>
                </div>
                <div class="first_text">
                    <button class="icon1 first_pre_button"><img src="/pfe/user images/arrow-left-solid.svg" class="icon1_img" alt="error"></button>
                    <div class="icon_text">
                        <img src="/pfe/user images/heart-solid.svg" class="icon1_img_solo" alt="error">
                        <div>
                            <h2 class="news_title">Latest Updates</h2>
                            <p class="news_des">
                                We're excited to announce our new community initiative that will launch next month. This program aims to provide resources and support to local families in need.
                                Our recent fundraising campaign exceeded expectations, allowing us to expand our services and reach more people in the community.
                                May 10, 2025
                            </p>
                        </div>

                    </div>
                    <button class="icon1 first_next_button"><img src="/pfe/user images/arrow-right-solid.svg" class="icon1_img" alt="error"></button>
                </div>
            </div>
            <div class="bottom">
                <div class="second_above_text">
                    <h1>Events</h1>
                    <a href="user pages/blood_need_news.php">See More ></a>
                </div>
                <div class="second_text">
                    <button class="icon2 first_pre_button"><img src="/pfe/user images/arrow-left-solid.svg" class="icon2_img" alt="error"></button>
                    <div class="icon_text">
                        <img src="/pfe/user images/calendar-days-solid.svg" class="icon2_img_solo" alt="">
                        <div>
                            <h2 class="event_title">Upcoming Events</h2>
                            <p class="event_text">Join us for our annual community gathering on June 15th. The event will feature guest speakers, workshops, and networking opportunities for all attendees.

                                Our monthly volunteer meetup is scheduled for the last Saturday of each month. Come learn how you can contribute to our mission and make a difference.

                                Next event: June 15, 2025</p>
                        </div>

                    </div>
                    <button class="icon2 first_next_button"><img src="/pfe/user images/arrow-right-solid.svg" class="icon2_img" alt="error"></button>
                </div>
            </div>
        </div>
    </section>
    <?php require_once "inclueds/footer.php" ?>
    <script src="/pfe/jquery-3.7.1.js"></script>
    <script src="/pfe/user scripts/main_page.js"></script>
</body>

</html>