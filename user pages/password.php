<?php
require_once "../db_con/cone.php";
require_once "../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"])) {
        if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL, FILTER_NULL_ON_FAILURE)) {
            $sheck_user = $con->prepare("SELECT * FROM users WHERE user_email = ?");
            $sheck_user->execute([$_POST["email"]]);
            $sheck_user = $sheck_user->fetch(PDO::FETCH_ASSOC);
            if (!empty($sheck_user)) {
                try {
                    // Server settings
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'bitiljusgamer@gmail.com';
                    $mail->Password   = 'rqlo xqrj xqgu jibo';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port       = 587;

                    // Recipients
                    $mail->setFrom('bitiljusgamer@gmail.com', 'blood donation center tanger');
                    $mail->addAddress($sheck_user["user_email"], $sheck_user["user_full_name"]);

                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Reset Password';
                    $mail->Body = 'Your Temporary password is: <h1>' . $_POST["temp_password"] . '</h1>.';
                    $mail->send();
                    echo json_encode(["status" => "ok", "message" => "an email was sent to you with your temporary password", "user_id" => $sheck_user["user_id"]]);
                } catch (Exception $e) {
                    echo "Email could not be sent. Error: {$mail->ErrorInfo}";
                }
            } else {
                echo json_encode(["status" => "error", "message" => "there is no user with this email"]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "email is not valid"]);
        }
        exit();
    } else if (isset($_POST["new_pass"])) {
        $pass = password_hash($_POST["new_pass"], PASSWORD_DEFAULT);
        $change = $con->prepare("UPDATE users SET user_password = ? WHERE user_id = ?");
        $change->execute([$pass, $_POST["id"]]);
        echo "ok";
        exit();
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="/pfe/user styles/password.css">
</head>

<body>
    <main>
        <div class="first_div">
            <h1>Reset Password</h1>
            <p>Enter your email to receive a reset link</p>
        </div>
        <div class="second_div">
            <form class="first_form" method="post">
                <div>
                    <p class="email2"><img src="\pfe\user images\envelope-solid.svg" alt=""> Email</p>
                    <input type="email" class="email send1" id="" placeholder="enter your email to recive the password">
                </div>
                <div>
                    <input type="submit" class="first_send" value="Send">
                    <p class="errors1"></p>
                </div>
            </form>
            <form class="second_form" method="post">
                <div>
                    <p class="email2"><img src="\pfe\user images\lock-solid.svg" alt=""> Temporary Password</p>
                    <input type="password" class="email send2" id="" placeholder="enter the password you resived in your gmail">
                </div>
                <div>
                    <input type="submit" class="second_send" value="Send">
                    <p class="errors2"></p>
                </div>
            </form>
            <form class="last_form" method="post">
                <div>
                    <p class="email2"><img src="\pfe\user images\lock-solid.svg" alt=""> New Password</p>
                    <input type="password" class="email send3" id="" placeholder="enter your new password">
                </div>
                <div>
                    <p class="email2"><img src="\pfe\user images\lock-solid.svg" alt=""> Confirm New Password</p>
                    <input type="password" class="email send4" id="" placeholder="confirm your new password">
                </div>
                <div>
                    <input type="submit" class="last_send" value="Send">
                    <p class="errors3"></p>
                </div>
            </form>
        </div>
        <div class="last_div">
            <a href="/pfe/user pages/sign.php"><img src="\pfe\user images\arrow-left-solid.svg" alt=""> Back To Sign In</a>
        </div>
    </main>
    <script src="/pfe/jquery-3.7.1.js"></script>
    <script src="/pfe/user scripts/password.js?v=1.0.8"></script>
</body>

</html>