<?php
require_once "../db_con/cone.php";
require_once "../vendor/autoload.php";
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: ../user pages/login.php");
}


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
//for normal request
$normal_request = $con->query("SELECT donation_request.*,user_full_name,user_email,blood_type_name,phone FROM donation_request join users on donation_request.user_id = users.user_id JOIN blood_types on users.blood_type_id = blood_types.blood_type_id WHERE center_id is not null and center_id =" . $_SESSION["admin"]["center_id"]);
$normal_request = $normal_request->fetchAll(PDO::FETCH_ASSOC);
//for events request
$event_request = $con->query("SELECT donation_request.*,title,users.user_full_name,user_email,blood_type_name,phone FROM donation_request JOIN news_events on donation_request.news_event_id = news_events.news_event_id JOIN users on donation_request.user_id = users.user_id JOIN blood_types on users.blood_type_id = blood_types.blood_type_id WHERE donation_request.center_id is null");
$event_request = $event_request->fetchAll(PDO::FETCH_ASSOC);

// from here on we will deal with the request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["action"] == "change") {
        $change = $con->query("UPDATE donation_request SET status = '" . $_POST["new_statu"] . "' WHERE request_id = " . (int)$_POST["request_id"]);
        echo json_encode(["status" => "ok", "message" => "the status has changed successfully."]);
    } elseif ($_POST["action"] == "send_as_will") {
        $change = $con->query("UPDATE donation_request SET status = '" . $_POST["new_statu"] . "' WHERE request_id = " . (int)$_POST["request_id"]);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'bitiljusgamer@gmail.com';
            $mail->Password   = 'rqlo xqrj xqgu jibo';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('bitiljusgamer@gmail.com', 'blood donation center tanger');
            $mail->addAddress($_POST["user_email"], $_POST["user_name"]);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Your reuqest canceled';
            $mail->Body = '<h2>' . $_POST["resone"] . '</h2>.';
            $mail->send();
            echo json_encode(["status" => "ok", "message" => "The email was sent successfully."]);
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => "an error acured sending the gmail try sending it from sending gmail page."]);
        }
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../admin style/request.css">
    <title>Donation Requests</title>
</head>

<body>
    <script src="../jquery-3.7.1.js"></script>
    <?php require_once "../inclueds/admin_side_bar.php" ?>

    <main>
        <div class="content">
            <header><img src="../admen images/open.svg" class="open" alt=""> <img src="../admen images/donations.svg" alt="">
                <p>Donation requests</p>
            </header>
            <div class="settings">
                <input type="text" class="event_search" id="" placeholder="seach by Donor name">
                <select class="type_of_donation" id="">
                    <option value="normal">Regular Donations</option>
                    <option value="event">Emergency Donations</option>
                </select>
                <select class="type_status" id="">
                    <option value="">All status</option>
                    <option value="pending">Pending</option>
                    <option value="cancled">cancled</option>
                    <option value="done">done</option>
                </select>
            </div>
            <div class="tables">
                <table class="normal_request">
                    <thead>
                        <th>Donor name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Blood type</th>
                        <th>Request Date</th>
                        <th>Prefered Time</th>
                        <th>Time stamp</th>
                        <th>status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($normal_request as $request) {
                            $user_full_name = htmlspecialchars($request['user_full_name']);
                            $user_email = htmlspecialchars($request['user_email']);
                            $phone = htmlspecialchars($request['phone']);
                            $blood_type_name = htmlspecialchars($request['blood_type_name']);
                            $request_date = htmlspecialchars($request['request_date']);
                            $donation_date = htmlspecialchars($request['donation_date']);
                            $donation_time_stamp = htmlspecialchars($request['donation_time_stamp']);
                            $status = htmlspecialchars($request['status']);
                            $request_id = htmlspecialchars($request['request_id']);

                            echo <<<HTML
                                    <tr class="ho" data-name="$user_full_name" data-status="$status">
                                        <td>$user_full_name</td>
                                        <td>$user_email</td>
                                        <td>$phone</td>
                                        <td>$blood_type_name</td>
                                        <td>$request_date</td>
                                        <td>$donation_date</td>
                                        <td>$donation_time_stamp</td>
                                        <td><p class="$status">$status</p></td>
                                        <td>
                                            <button class="change" data-name="$user_full_name" data-id="$request_id" data-email="$user_email">Change status</button>
                                        </td>
                                    </tr>
                                HTML;
                        }

                        ?>
                    </tbody>
                </table>
                <table class="event_reuqest">
                    <thead>
                        <th>Donor name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Blood type</th>
                        <th>Request Date</th>
                        <th>Prefered Time</th>
                        <th>Time stamp</th>
                        <th>status</th>
                        <th>Event name</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($event_request as $request) {
                            // Sanitize all values that come from user or database
                            $user_full_name = htmlspecialchars($request['user_full_name'], ENT_QUOTES, 'UTF-8');
                            $user_email = htmlspecialchars($request['user_email'], ENT_QUOTES, 'UTF-8');
                            $phone = htmlspecialchars($request['phone'], ENT_QUOTES, 'UTF-8');
                            $blood_type_name = htmlspecialchars($request['blood_type_name'], ENT_QUOTES, 'UTF-8');
                            $request_date = htmlspecialchars($request['request_date'], ENT_QUOTES, 'UTF-8');
                            $donation_date = htmlspecialchars($request['donation_date'], ENT_QUOTES, 'UTF-8');
                            $donation_time_stamp = htmlspecialchars($request['donation_time_stamp'], ENT_QUOTES, 'UTF-8');
                            $status = htmlspecialchars($request['status'], ENT_QUOTES, 'UTF-8');
                            $title = htmlspecialchars($request['title'], ENT_QUOTES, 'UTF-8');
                            $request_id = htmlspecialchars($request['request_id'], ENT_QUOTES, 'UTF-8');

                            echo <<<HTML
                                <tr class="ho" data-name="$user_full_name" data-status="$status">
                                    <td>$user_full_name</td>
                                    <td>$user_email</td>
                                    <td>$phone</td>
                                    <td>$blood_type_name</td>
                                    <td>$request_date</td>
                                    <td>$donation_date</td>
                                    <td>$donation_time_stamp</td>
                                    <td><p class="$status">$status</p></td>
                                    <td>$title</td>
                                    <td>
                                        <button class="change" data-id="$request_id" data-email="$user_email">Change status</button>
                                    </td>
                                </tr>
                            HTML;
                        }

                        ?>
                    </tbody>
                </table>
            </div>
            <dialog id="add">
                <div class="main_div">
                    <div class="settings2">
                        <h2>Change request status</h2>
                        <p class="close">&#10006;</p>
                    </div>
                    <form action="" method="post">
                        <div>
                            <label for="full_name">status</label>
                            <select class="new_status" id="">
                                <option value="">Select a status</option>
                                <option value="pending">pending</option>
                                <option value="done">done</option>
                                <option value="canceled">canceled</option>
                            </select>
                        </div>
                        <div class="text">
                            <p>Reason for cancellation</p>
                            <textarea name="" id="resone"></textarea>
                        </div>
                    </form>
                    <div class="last_div">
                        <button id="change_status">Update</button>
                        <p class="error1"></p>
                    </div>
                </div>
            </dialog>
        </div>
    </main>
    <script src="../admen scripts/request.js"></script>
</body>

</html>