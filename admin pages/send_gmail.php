<?php
require_once "../db_con/cone.php";
require_once "../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();
$blood_types = $con->query("SELECT * from blood_types");
$blood_types = $blood_types->fetchAll(PDO::FETCH_ASSOC);
$users = $con->query("SELECT user_email,user_full_name,blood_type_name FROM users JOIN blood_types on users.blood_type_id = blood_types.blood_type_id");
$users = $users->fetchAll(PDO::FETCH_ASSOC);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Server settings (configure once)
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'bitiljusgamer@gmail.com';
        $mail->Password   = 'rqlo xqrj xqgu jibo';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('bitiljusgamer@gmail.com', 'blood donation center tanger');
        $mail->isHTML(true);
        $mail->Subject = $_POST["subject"];

        foreach ($_POST["data"] as $user) {
            $mail->clearAddresses();
            $mail->addAddress($user[1], $user[0]);
            $mail->Body = $_POST["content"];
            if (!$mail->send()) {
                echo json_encode([
                    "status" => "error",
                    "message" => "Email to {$user["user_email"]} could not be sent. Error: {$mail->ErrorInfo}"
                ]);
                exit();
            }
        }
        echo json_encode([
            "status" => "ok",
            "message" => "email were send seccusfuly"
        ]);
    } catch (Exception $e) {
        echo json_encode([
            "status" => "error",
            "message" => "Mailer Error: " . $e->getMessage()
        ]);
    }


    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../admin style/gmails.css">
    <title>Send gmails</title>
</head>

<body>
    <script src="../jquery-3.7.1.js"></script>
    <?php require_once "../inclueds/admin_side_bar.php" ?>
    <main>
        <div class="content">
            <header><img src="../admen images/open.svg" class="open" alt=""> <img src="../admen images/emails.svg" alt="">
                <p>Send emails</p>
            </header>
        </div>
        <div class="parts">
            <div class="part_one">
                <h1>Select users</h1>
                <div class="settings">
                    <input type="text" id="searsh_by_name">
                    <select name="" id="type">
                        <option value="">All types</option>
                        <?php
                        foreach ($blood_types as $type) {
                            echo "<option value='" . $type["blood_type_name"] . "'>" . $type["blood_type_name"] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="users">
                    <?php
                    foreach ($users as $user) {
                        // Sanitize user data
                        $user_full_name = htmlspecialchars($user['user_full_name'], ENT_QUOTES, 'UTF-8');
                        $user_email = htmlspecialchars($user['user_email'], ENT_QUOTES, 'UTF-8');
                        $blood_type_name = htmlspecialchars($user['blood_type_name'], ENT_QUOTES, 'UTF-8');

                        echo <<<HTML
                            <div class="user">
                                <input type="checkbox" data-type="$blood_type_name" data-name="$user_full_name" data-email="$user_email" id="">
                                <div class="info">
                                    <b>$user_full_name</b>
                                    <u>$user_email</u>
                                    <b>$blood_type_name</b>
                                </div>
                            </div>
                        HTML;
                    }

                    ?>
                </div>
                <b class="users_count">Selected Users: <span>0</span></b>
            </div>
            <div class="part_two">
                <h1>Compose Email</h1>
                <div class="subject">
                    <b>Subject</b>
                    <input type="text" class="subject_text" name="" id="" placeholder="subject of the email...">
                </div>
                <div class="content">
                    <b>Content</b>
                    <textarea name="" id="" placeholder="Email content here...."></textarea>
                </div>
                <div class="settings_2">
                    <button class="send">Send</button>
                    <button class="cls">Clear</button>
                </div>
                <p class="errors"></p>
            </div>
        </div>
    </main>
    <script src="../admen scripts/gmail.js"></script>

</body>

</html>