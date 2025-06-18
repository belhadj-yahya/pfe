<?php
require_once "../db_con/cone.php";
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION["center_id"]) && !isset($_SESSION["event_id"])) {
    header("Location: select_center.php");
    exit;
}
$center_data_for_both_cases;
//here we will get the last date of donation that the user did
$last_don = $con->query("SELECT donation_date FROM donation_request WHERE user_id = " . $_SESSION["user"]["user_id"] . " AND (status = 'done' OR status = 'pending')");
$last_don = $last_don->fetchAll(PDO::FETCH_ASSOC);
if (isset($_SESSION["event_id"])) {
    // yahya remamber to fix the issue that if the user want to donait for a new event without anyone signing in it an error will happend that the table will be empty so you can loop using for each 
    $event_date_and_unit = $con->query("SELECT news_events.*,center_name FROM news_events JOIN donation_centers on news_events.center_id = donation_centers.center_id WHERE news_event_id = " . $_SESSION["event_id"]);
    $event_date_and_unit = $event_date_and_unit->fetch(PDO::FETCH_ASSOC);
    // this is here to sheck the first select and how can the user donait
    $total_request = $con->query("SELECT time_slots.slot AS donation_time_stamp,COALESCE(COUNT(donation_request.request_id), 0) AS total_requests FROM (SELECT 'morning' AS slot UNION ALL SELECT 'afternone' UNION ALL SELECT 'evining') AS time_slots LEFT JOIN donation_request ON time_slots.slot = donation_request.donation_time_stamp" . " AND donation_request.news_event_id = " . $_SESSION["event_id"] . " AND donation_request.status = 'pending' GROUP BY time_slots.slot ORDER BY FIELD(time_slots.slot, 'morning', 'afternone', 'evining')");
    $total_request = $total_request->fetchAll(PDO::FETCH_ASSOC);
    // this is here getting the max amount of users per day
    $select_settings = $con->query("SELECT max_limite_per_day FROM donation_centers WHERE center_id = " . $event_date_and_unit["center_id"]);
    $select_settings = $select_settings->fetch(PDO::FETCH_ASSOC);
    $select_settings = round($select_settings["max_limite_per_day"] / 3);
    //data to be displayed about the center that the donation will beat 
    $center_data_for_both_cases = $con->query("SELECT * from donation_centers WHERE center_id = " . $event_date_and_unit["center_id"]);
    $center_data_for_both_cases = $center_data_for_both_cases->fetch(PDO::FETCH_ASSOC);
} elseif (isset($_SESSION["center_id"])) {
    $select_settings = $con->query("SELECT max_limite_per_day FROM donation_centers WHERE center_id = " . $_SESSION["center_id"]);
    $select_settings = $select_settings->fetch(PDO::FETCH_ASSOC);
    $select_settings = round($select_settings["max_limite_per_day"] / 3);
    //data to be displayed about the center that the donation will beat 
    $center_data_for_both_cases = $con->query("SELECT * from donation_centers WHERE center_id = " . $_SESSION["center_id"]);
    $center_data_for_both_cases = $center_data_for_both_cases->fetch(PDO::FETCH_ASSOC);
    //to see if the blood type of the donor is allready at max units wi will reject hi
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["data"] == "ok") {
        $date = new DateTime($_POST["date"]);
        $formated_date = $date->format("Y-m-d");


        if (isset($_SESSION["event_id"])) {
            $shesk_if_already_there = $con->query("SELECT * FROM donation_request where news_event_id = " . $_SESSION["event_id"] . " AND user_id =" . $_SESSION["user"]["user_id"] . " AND status = 'pending'");
            $shesk_if_already_there = $shesk_if_already_there->fetch(PDO::FETCH_ASSOC);
            if (!empty($shesk_if_already_there)) {
                echo json_encode(["status" => "error", "message" => "you already have donation request for this urgent need"]);
            } else {
                if (str_contains(strtolower($event_date_and_unit["blood_type_needed"]), strtolower($_SESSION["user"]["blood_type_name"])) || $event_date_and_unit["blood_type_needed"] == "all" || $_SESSION["user"]["blood_type"] == "i dont know") {
                    $add_request = $con->prepare("INSERT INTO donation_request(status,request_date,donation_date,donation_time_stamp,news_event_id,center_id,user_id) values('pending',NOW(),?,?,?,NULL,?)");
                    $add_request->execute([$formated_date, $_POST["time_stemp"], $_SESSION["event_id"], $_SESSION["user"]["user_id"]]);
                    echo json_encode(["status" => "done", "message" => "your donation request was added"]);
                } else {
                    echo json_encode(["status" => "error", "message" => "Your blood type doesn't match the blood type in need"]);
                }
            }
        } else if (isset($_SESSION["center_id"])) {
            if (!empty($last_don)) {
                foreach ($last_don as $donation) {
                    $old_date = new DateTime($donation['donation_date']);
                    $diff = abs($date->diff($old_date)->days);
                    if ($diff < 15) {

                        echo json_encode(["status" => "error", "message" => "can't donate must wait 15 days between donations"]);
                        exit();
                    }
                }
            }

            $blood_supply = $con->query("SELECT blood_supplay.availible_unit,max_units,blood_type_name,blood_types.blood_type_id, center_id FROM blood_supplay JOIN blood_types on blood_supplay.blood_type_id = blood_types.blood_type_id WHERE blood_supplay.center_id = " . $_SESSION['center_id']);
            $blood_supply = $blood_supply->fetchAll(PDO::FETCH_ASSOC);
            foreach ($blood_supply as $type) {
                if ($type["blood_type_id"] == $_SESSION["user"]["blood_type"]) {
                    if ($type["availible_unit"] < $type["max_units"]) {
                        $add_request = $con->prepare("INSERT INTO donation_request(status,request_date,donation_date,donation_time_stamp,news_event_id,center_id,user_id) VALUES('pending',NOW(),?,?,NULL,?,?)");
                        $add_request->execute([$formated_date, $_POST["time_stemp"], $_SESSION["center_id"], $_SESSION["user"]["user_id"]]);
                        echo json_encode(["status" => "done", "message" => "your donation request was added"]);
                    } else {
                        echo json_encode(["status" => "error", "message" => "Your blood type is at max units in the donation center"]);
                        exit();
                    }
                }
            }
            exit();
        }
        exit();
    } elseif ($_POST["data"] == "date_change") {
        $dateString = $_POST["new_date"];
        $dateObject = new DateTime($dateString);
        $dateFormatted = $dateObject->format("Y-m-d");
        if (isset($_SESSION["event_id"])) {
            $total_request = $con->query("SELECT time_slots.slot AS donation_time_stamp, COALESCE(COUNT(donation_request.request_id), 0) AS total_requests FROM (SELECT 'morning' AS slot UNION ALL SELECT 'afternone' UNION ALL SELECT 'evining') AS time_slots LEFT JOIN donation_request ON time_slots.slot = donation_request.donation_time_stamp AND donation_request.donation_date = '$dateFormatted' AND donation_request.status = 'pending' AND donation_request.news_event_id = " . $_SESSION["event_id"] . " GROUP BY time_slots.slot ORDER BY FIELD(time_slots.slot, 'morning', 'afternone', 'evining')");
        } else if (isset($_SESSION["center_id"])) {
            $total_request = $con->query("SELECT time_slots.slot AS donation_time_stamp, COALESCE(COUNT(donation_request.request_id), 0) AS total_requests FROM (SELECT 'morning' AS slot UNION ALL SELECT 'afternone' UNION ALL SELECT 'evining') AS time_slots LEFT JOIN donation_request ON time_slots.slot = donation_request.donation_time_stamp AND donation_request.donation_date = '$dateFormatted' AND donation_request.status = 'pending' AND donation_request.center_id = " . $_SESSION["center_id"] . " GROUP BY time_slots.slot ORDER BY FIELD(time_slots.slot, 'morning', 'afternone', 'evining')");
        }
        $total_request = $total_request->fetchAll(PDO::FETCH_ASSOC);
        array_push($total_request, $select_settings);
        echo json_encode($total_request);
        exit();
    } elseif ($_POST["data"] == "first_request") {
        if (isset($_SESSION["event_id"])) {
            echo json_encode(["end_date" =>  $event_date_and_unit["news_events_date"]]);
        } elseif (isset($_SESSION["center_id"])) {
            $date_end = new DateTime("+1 month");
            $date_end = $date_end->format("Y-m-d");
            echo json_encode(["end_date" =>  ""]);
        }
        exit();
    }
    unset($_SESSION["event_id"]);
    unset($_SESSION["center_id"]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/pfe/user styles/request.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css ">
    <title>Document</title>
</head>

<body>
    <?php require_once "../inclueds/header.php" ?>
    <main>
        <div class="after_div">
            <div class="intro">
                <?php
                echo "<pre>";
                print_r($last_don);
                echo "</pre>";
                if (isset($_SESSION["event_id"])) {
                    echo "<h1>Emergency Donation Request</h1>";
                    echo "<p>You're responding to an urgent blood need. Thank you for helping save a life.</p>";
                } else {
                    echo "<h1>Donation Request</h1>";
                    echo "<p>thanks for donation your blood will be the resone someone live</p>";
                }
                ?>
            </div>

            <?php if (isset($_SESSION["event_id"])) { ?>
                <div class="blood_if_need">
                    <div class="data">
                        <div class="data1">
                            <img src="\pfe\user images\worning.svg" class="icon1" alt="">
                            <h2><?php echo $event_date_and_unit["title"] ?></h2>
                        </div>
                        <p class="first_p"><?php echo $event_date_and_unit["description"] ?></p>
                        <div class="info">
                            <div>
                                <img src="\pfe\user images\blood_error.svg" alt="">
                                <p>blood type: <?php echo $event_date_and_unit["blood_type_needed"] ?></p>
                            </div>
                            <div>
                                <img src="\pfe\user images\calnd_error.svg" alt="">
                                <p>needed by: <?php echo $event_date_and_unit["news_events_date"] ?></p>
                            </div>
                            <div>
                                <img src="\pfe\user images\worning.svg" alt="">
                                <p><?php echo $event_date_and_unit["max_units_needed"] ?> unit needed</p>
                            </div>
                        </div>
                        <p style="color:#f5bcbf"><?php echo $event_date_and_unit["center_name"] ?></p>
                    </div>
                </div>
            <?php } ?>


            <div class="donation_needed">
                <h3>Donation center</h3>
                <div class="don_div1">
                    <img src="<?php echo $center_data_for_both_cases["center_image"] ?>" class="center_img" alt="">
                    <div class="don_div2">
                        <div class="icon">
                            <img src="\pfe\user images\location.svg" alt="">
                        </div>
                        <div class="don_div3">
                            <p><?php echo $center_data_for_both_cases["center_name"] ?></p>
                            <p style="color:#e6d2db"><?php echo $center_data_for_both_cases["center_location"] ?></p>
                            <p style="color:#e6d2db"><?php echo $center_data_for_both_cases["contact_number"] ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <form method="post">
                <div>
                    <p><img src="\pfe\user images\calendar-days-solid.svg" alt=""> Donation Date</p>
                    <input type='text' class='date' readonly placeholder='select a date first dd / mm / yyyy' id="datepicker">
                </div>
                <div>
                    <p><img src="\pfe\user images\clock-solid.svg" alt=""> Time Prefrence</p>
                    <select class="time_stamp" id="">
                        <option value="">Select your preferred time</option>
                        <?php
                        foreach ($total_request as $select) {
                            if ($select["count(request_id)"] < $select_settings) {
                                echo "<option value='" . $select["donation_time_stamp"] . "'>" . $select["donation_time_stamp"] . " - avilibile" . "</option>";
                            } else {
                                echo "<option  style='color:#f5bcbf' disabled value='" . $select["donation_time_stamp"] . "'>" . $select["donation_time_stamp"] . " - full"  . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="submit">
                    <input type="submit" class="send" value="<?php echo isset($_SESSION["event_id"]) ? "Confirm Emergency Donation" : "Confirm Donation" ?>">
                    <p class="error">error</p>
                </div>
            </form>
        </div>
    </main>
    <?php require_once "../inclueds/footer.php" ?>
    <script src="/pfe/jquery-3.7.1.js"></script>

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js "></script>
    <script src="/pfe/user scripts/request.js"></script>
</body>

</html>