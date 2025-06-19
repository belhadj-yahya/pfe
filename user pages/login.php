<?php
require_once "../db_con/cone.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";
    if (isset($email) && isset($password)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL, FILTER_NULL_ON_FAILURE)) {
            $user = $con->prepare("SELECT users.*,blood_type_name FROM users JOIN blood_types on users.blood_type_id = blood_types.blood_type_id where user_email = ?");
            if ($user->execute([$email])) {
                $user = $user->fetch(PDO::FETCH_ASSOC);
                if (!empty($user)) {
                    if (strlen($password) >= 8) {
                        if (password_verify($password, $user["user_password"])) {
                            $_SESSION["user"] = ["user_id" => $user["user_id"], "blood_type" => $user["blood_type_id"], "blood_type_name" => $user["blood_type_name"]];
                            echo json_encode(["p_class" => "go", "message" => "incurect password", "on" => [".email"], "value" => ""]);
                            exit();
                        } else {
                            echo json_encode(["p_class" => ".error2", "message" => "incurect password", "on" => [".email"], "value" => ""]);
                            exit();
                        }
                    } else {
                        echo json_encode(["p_class" => ".error2", "message" => "password must be 8 caracters", "on" => [".password"], "value" => ""]);
                        exit();
                    }
                } else {
                    $sheck_admin = $con->prepare("SELECT * FROM admins WHERE admen_email = ?");
                    $sheck_admin->execute([$email]);
                    $sheck_admin = $sheck_admin->fetch(PDO::FETCH_ASSOC);
                    if (!empty($sheck_admin)) {
                        if (password_verify($password, $sheck_admin["admen_password"])) {
                            $_SESSION["admin"] = ["admin_id" => $sheck_admin["admen_id"], "center_id" => $sheck_admin["center_id"]];
                            echo json_encode(["p_class" => "its admin", "message" => "there is no user with this email", "on" => [".email", ".password"], "value" => ""]);
                            exit();
                        }
                    }
                    echo json_encode(["p_class" => ".error1", "message" => "there is no user with this email", "on" => [".email", ".password"], "value" => ""]);
                    exit();
                }
            } else {
                echo json_encode(["p_class" => ".error", "message" => "an error acured try again", "on" => [".email", ".password"], "value" => ""]);
                exit();
            }
        } else {
            echo json_encode(["p_class" => ".error", "message" => "enter a valid email", "on" => [".email", ".password"], "value" => ""]);
            exit();
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/pfe/user styles/login.css">
    <title>logIn</title>
</head>

<body>
    <main>
        <div class="above_form">
            <h1>Welcome Back</h1>
            <p>Log in to continue to DonateLife</p>
        </div>
        <div class="midel">
            <div class="flex">
                <p><img src="/pfe/user images/envelope-solid.svg" alt=""> Email:</p>
                <input type="email" name="email" class="email" id="" placeholder="Enter your email">
            </div>
            <p class="error1"></p>
            <div class="flex">
                <div class="choice">
                    <p><img src="/pfe/user images/lock-solid.svg" alt=""> Password:</p>
                    <a href="../user pages/password.php">Forgot password?</a>
                </div>
                <input type="password" name="password" class="password" id="" placeholder="Enter your password">
            </div>
            <p class="error2"></p>
            <div class="flex last">
                <form action="" method="post">
                    <a href="../index.php" class="lastp">Back to Home</a>
                    <input type="submit" class="sign" value="Sign In">
                    <p class="error"></p>
                </form>
            </div>
        </div>
        <div class="under_form">
            <p>Don't have an account? <a href="/pfe/user pages/sign.php" class="sign_link">Sign up</a></p>
        </div>
    </main>
    <script src="/pfe/jquery-3.7.1.js"></script>
    <script src="/pfe/user scripts/login.js?v=1.0.1"></script>
</body>

</html>