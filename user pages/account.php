<?php
require_once "../db_con/cone.php";
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: /pfe/index.php");
}
$normal_request = $con->query("SELECT center_name,center_location,donation_date,status FROM donation_request JOIN donation_centers on donation_request.center_id = donation_centers.center_id WHERE user_id = " . $_SESSION["user"]["user_id"]);
$normal_request = $normal_request->fetchAll(PDO::FETCH_ASSOC);
$events_donation = $con->query("SELECT title,center_name,donation_date,center_location,status FROM donation_request as d JOIN news_events as n on d.news_event_id = n.news_event_id JOIN donation_centers as c ON n.center_id = c.center_id  WHERE d.news_event_id is NOT NULL AND user_id = " . $_SESSION["user"]["user_id"]);
$events_donation = $events_donation->fetchAll(PDO::FETCH_ASSOC);
$user_info = $con->query("SELECT users.*,blood_type_name FROM users JOIN blood_types on users.blood_type_id = blood_types.blood_type_id WHERE user_id = " . $_SESSION["user"]["user_id"]);
$user_info = $user_info->fetch(PDO::FETCH_ASSOC);
$mimic_name = explode(" ", $user_info["user_full_name"]);
$mimic_location = explode(" ", $user_info["location"]);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["delete"])) {
        unset($_SESSION["user"]);
        session_unset();
        session_destroy();
        echo "ok";
        exit();
    } else {        
        $sheck_email_and_phone = $con->prepare("SELECT user_id FROM users WHERE (user_email = ? OR phone = ?) and user_id != ?");
        $sheck_email_and_phone->execute([$_POST["new_email"], $_POST["new_phone"], $_SESSION["user"]["user_id"]]);
        $sheck_email_and_phone = $sheck_email_and_phone->fetch(PDO::FETCH_ASSOC);
        if (empty($sheck_email_and_phone)) {
            $update_user = $con->prepare("UPDATE users SET user_full_name = ?,user_email = ?,location = ?,phone = ? where user_id = ?");
            $update_user->execute([$_POST["f_name"] ." ". $_POST["l_name"], $_POST["new_email"], $_POST["new_city"] ." ". $_POST["new_street"], $_POST["new_phone"], $_SESSION["user"]["user_id"]]);
            echo json_encode(["status" => "done", "message" => "your information has been updated"]);
        } else {
            echo json_encode(["status" => "error", "message" => "phone number or email already used"]);
        }
        exit();
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/pfe/user styles/account.css">
    <title>Account</title>
</head>

<body>
    <?php require_once "../inclueds/header.php" ?>

    <main>
        <div class="after_main">
            <div class="div1">
                <h1>My Account</h1>
                <div class="under_line"></div>
            </div>
            <div class="div2">
                <button class="btn1">Regular Donation</button>
                <button class="btn2">Emergency Need Donation</button>
                <button class="btn3">Profile Information</button>
            </div>
            <div class="div3_normal">
                <?php
                foreach ($normal_request as $request) {
                    echo <<<HTML
                            <div class="request">
                                <div class="request_div1">
                                    <div class="img_background">
                                        <img src="/pfe/user images/heart-solid.svg" class="icon" alt="">
                                    </div>
                                    <div class="after_img_text">
                                        <h2>{$request["center_name"]}</h2>
                                        <p>Regular Donation</p>
                                    </div>
                                </div>
                                <div class="request_div2">
                                    <div>
                                        <img src="\pfe\user images\calnder_pink.svg" class="icon" alt="">
                                        <p>{$request["donation_date"]}</p>
                                    </div>
                                    <div>
                                        <img src="\pfe\user images\location_pink.svg" class="icon" alt="">
                                        <p>{$request["center_location"]}</p>
                                    </div>
                                    <div>
                        HTML;
                    if ($request["status"] == "pending") {
                        echo "<div class='pending'><p>pending</p></div>";
                    } else if ($request["status"] == "done") {
                        echo "<div class='done'><p>done</p></div>";
                    }
                    echo <<<HTML
                                    </div>
                                </div>
                            </div>
                        HTML;
                }
                ?>
            </div>
            <div class="div4_events">
                <?php
                foreach ($events_donation as $request) {
                    echo <<<HTML
                            <div class="request">
                                <div class="request_div1">
                                    <div class="img_background">
                                        <img src="/pfe/user images/heart-solid.svg" class="icon" alt="">
                                    </div>
                                    <div class="after_img_text">
                                        <h2>{$request["center_name"]}</h2>
                                        <p>Emergency Need {$request["title"]}</p>
                                    </div>
                                </div>
                                <div class="request_div2">
                                    <div>
                                        <img src="\pfe\user images\calnder_pink.svg" class="icon" alt="">
                                        <p>{$request["donation_date"]}</p>
                                    </div>
                                    <div>
                                        <img src="\pfe\user images\location_pink.svg" class="icon" alt="">
                                        <p>{$request["center_location"]}</p>
                                    </div>
                                    <div>
                        HTML;
                    if ($request["status"] == "pending") {
                        echo "<div class='pending'><p>pending</p></div>";
                    } else if ($request["status"] == "done") {
                        echo "<div class='done'><p>done</p></div>";
                    }
                    echo <<<HTML
                                    </div>
                                </div>
                            </div>
                        HTML;
                }
                ?>

            </div>
            <div class="div5_info">
                <form method="POST" enctype="multipart/form-data">
                    <div class="first_after_form">
                        <h1 class="h1">Profile Information</h1>
                        <div class="buttons">
                            <button class="open">Edite Profile</button>
                            <button class="save">save</button>
                            <button class="cancel">Cancel</button>
                        </div>
                    </div>
                    <div class="second_after_form">
                        <div class="side1">
                            <div>
                                <p><img src="\pfe\user images\user.svg" alt="" class="icon11"> First Name</p>
                                <input type="text" class="new_f_name" disabled value="<?php echo $mimic_name[0] ?>">
                            </div>
                            <div>
                                <p><img src="\pfe\user images\user.svg" alt="" class="icon11"> Last Name</p>
                                <input type="text" class="new_l_name" disabled value="<?php echo $mimic_name[1] ?>">
                            </div>
                            <div>
                                <p><img src="\pfe\user images\envelope-solid.svg" alt="" class="icon11"> Email</p>
                                <input type="text" class="new_email" disabled value="<?php echo $user_info["user_email"] ?>">
                            </div>
                        </div>
                        <div class="side2">
                            <div>
                                <p><img src="\pfe\user images\location.svg" alt="" class="icon11"> City</p>
                                <input type="text" class="new_city" disabled value="<?php echo $mimic_location[0] ?>">
                            </div>
                            <div>
                                <p><img src="\pfe\user images\location.svg" alt="" class="icon11"> Street</p>
                                <input type="text" class="new_street" disabled value="<?php echo $mimic_location[1] ?>">
                            </div>
                            <div>
                                <p><img src="\pfe\user images\phone-solid(1).svg" alt="" class="icon11"> Phone Number</p>
                                <input type="text" class="new_phone" disabled value="<?php echo $user_info["phone"] ?>">
                            </div>
                        </div>
                    </div>

                    <div class="blood_type">
                        <p><img src="\pfe\user images\blood.svg" class="icon11" alt=""> Blood Type <span>(Can't be Change)</span></p>
                        <p class="blood_type_p"><?php echo $user_info["blood_type_name"] ?></p>
                    </div>
                    <p class="error"></p>
                </form>
            </div>
        </div>
        <button class="signout">Sign Out</button>
    </main>
    <?php require_once "../inclueds/footer.php" ?>

    <script src="/pfe/jquery-3.7.1.js"></script>
    <script src="/pfe/user scripts/account.js"></script>
</body>

</html>