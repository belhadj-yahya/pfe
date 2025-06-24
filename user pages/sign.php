<?php
require_once "../db_con/cone.php";
session_start();
$blood = $con->query("SELECT * FROM blood_types");
$blood = $blood->fetchAll(PDO::FETCH_ASSOC);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"] ?? "";
    $phone = $_POST["phone_number"] ?? "";
    if (filter_var($email, FILTER_VALIDATE_EMAIL, FILTER_NULL_ON_FAILURE)) {
        $check_user = $con->prepare("SELECT user_id FROM users WHERE user_email = ? OR phone = ?");
        $check_user->execute([$email, $phone]);
        $check_user = $check_user->fetch(PDO::FETCH_ASSOC);
        $check_admin = $con->prepare("SELECT admen_id FROM admins WHERE  admen_email = ? OR phone = ?");
        $check_admin->execute([$email, $phone]);
        $check_admin = $check_admin->fetch(PDO::FETCH_ASSOC);
        if (empty($check_user) && empty($check_admin)) {
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $add_user = $con->prepare("INSERT INTO users(user_full_name,user_email,user_password,location,phone,blood_type_id) VALUES(?,?,?,?,?,?)");
            if ($add_user->execute([$_POST["f_name"] . " " . $_POST["l_name"], $email, $password, $_POST["city"] . " " . $_POST["street"], $_POST["phone_number"], $_POST["blood_type_id"]])) {
                $id = $con->lastInsertId();
                $get_user = $con->query("SELECT users.*,blood_type_name FROM users JOIN blood_types on users.blood_type_id = blood_types.blood_type_id where user_id = $id");
                $get_user = $get_user->fetch(PDO::FETCH_ASSOC);
                $_SESSION["user"] = ["blood_type" => $_POST["blood_type_id"], "user_id" => $id, "blood_type_name" => $get_user["blood_type_name"]];
                echo json_encode(["class" => "done", "message" => "welcome to DonaitLife"]);
                exit();
            } else {
                echo json_encode(["class" => ".all_error", "message" => "an error acured try again"]);
                exit();
            }
        } else {
            echo json_encode(["class" => ".all_error", "message" => "this email or phone number is allready used"]);
            exit();
        }
    } else {
        echo json_encode(["class" => ".email_error", "message" => "invalid email", "email" => $email]);
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/pfe/user styles/sign.css">
    <title>logIn</title>
</head>

<body>
    <main>
        <div class="above_form">
            <h1>Create Account</h1>
            <p class="note">Sign in to join DonateLife</p>
        </div>
        <form method="post" class="midel">
            <div class="top">
                <div class="left_side">
                    <div class="filed">
                        <p class="id"><img src="/pfe/user images/user.svg" alt="">First Name</p>
                        <input type="text" class="first_name" name="first_name" placeholder="Enter Your First Name">
                        <p class="error f_name_error">first name is required</p>
                    </div>
                    <div class="filed">
                        <p class="id"><img src="/pfe/user images/envelope-solid.svg" alt=""> Email</p>
                        <input type="email" name="email" class="email" placeholder="Enter Your Email">
                        <p class="error email_error">email is required</p>
                    </div>
                    <div class="filed">
                        <p class="id"><img src="/pfe/user images/lock-solid.svg" alt=""> Password</p>
                        <input type="password" name="password" class="password" id="" placeholder="Enter Your Password (8 characters)">
                        <p class="error password_error">password shoulde be 8 characters or more</p>
                    </div>
                    <div class="filed">
                        <p class="id"><img src="/pfe/user images/lock-solid.svg" alt=""> Confirm Password</p>
                        <input type="password" name="confirm_password" class="confirm_password" id="" placeholder="Confirm Your Password (8 characters)">
                        <p class="error confirm_error">confirm password shoulde be 8 characters or more</p>
                    </div>
                    <div class="filed">
                        <p class="id"><img src="/pfe/user images/phone-solid(1).svg" alt=""> Phone Number</p>
                        <input type="tel" name="phone_number" class="phone_number" id="" placeholder="Enter Your Phone Number">
                        <p class="error phone_error">phone is required</p>
                    </div>
                </div>
                <div class="right_side">
                    <div class="filed">
                        <p class="id"><img src="/pfe/user images/user.svg" alt=""> Last Name</p>
                        <input type="text" class="last_name" name="last_name" placeholder="Enter Your Last Name">
                        <p class="error l_name_error">last name is required</p>
                    </div>
                    <div class="filed">
                        <p class="id"><img src="/pfe/user images/location.svg" alt=""> City</p>
                        <input type="text" name="city" class="city" id="" placeholder="Enter Your City">
                        <p class="error city_error">city is required</p>
                    </div>
                    <div class="filed">
                        <p class="id"><img src="/pfe/user images/location.svg" alt=""> Street</p>
                        <input type="text" name="street" class="street" id="" placeholder="Enter Your Street">
                        <p class="error street_error">street name is required</p>
                    </div>
                    <div class="filed">
                        <p class="id"><img src="/pfe/user images/blood.svg" alt=""> Blood Type</p>
                        <select name="blood_type" class="blood_type" id="">
                            <option value="">Select Your Blood Type</option>
                            <?php
                            foreach ($blood as $type) {
                                echo "<option value='" . $type["blood_type_id"] . "'>" . $type["blood_type_name"] . "</option>";
                            }
                            ?>
                        </select>
                        <p class="error select_error">blood type is required</p>
                    </div>
                </div>
            </div>
            <div class="bottom">
                <p class="error all_error">dcfnsdn</p>
                <a href="/pfe/index.php">Back To Home</a>
                <input type="submit" class="create" value="Create Account">
            </div>
        </form>
        <div class="under_form">
            <p class="note">Already have an account? <a href="/pfe/user pages/login.php" class="sign_link">Log in</a></p>
        </div>
    </main>
    <script src="/pfe/jquery-3.7.1.js"></script>
    <script src="/pfe/user scripts/sign.js?v=0.1.9"></script>
</body>

</html>