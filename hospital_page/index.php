<?php
require_once "../db_con/cone.php";
$centers = $con->query("SELECT center_id,center_name FROM donation_centers");
$centers = $centers->fetchAll(PDO::FETCH_ASSOC);
//blood types
$blood_types = $con->query("SELECT * FROM blood_types");
$blood_types = $blood_types->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect & sanitize inputs
    $hospital_name = trim($_POST["hospital_name"] ?? "");
    $person_name = trim($_POST["person_name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $blood_type_id = intval($_POST["blood_type"] ?? 0);
    $units = intval($_POST["units"] ?? 0);
    $date_needed = $_POST["date"] ?? null;
    $status = trim($_POST["level"] ?? "");
    $description = trim($_POST["message"] ?? "");
    $center_id = intval($_POST["center"] ?? 0);
    $in_need_name = trim($_POST["in_need_name"] ?? "");

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL, FILTER_NULL_ON_FAILURE)) {
        echo json_encode(["status" => "error", "message" => "Invalid email"]);
        exit();
    }
    $today = date("Y-m-d");
    if (!$date_needed || $date_needed < $today) {
        echo json_encode(["status" => "error", "message" => "Date must be today or in the future"]);
        exit();
    }
    if (!ctype_digit($phone)) {
        echo json_encode(["status" => "error", "message" => "Phone number not valid"]);
        exit();
    }
    if (filter_var($units, FILTER_VALIDATE_INT) === false || $units <= 0) {
        echo json_encode(["status" => "error", "message" => "Units must be a valid number greater than 0"]);
        exit();
    }
    $units = intval($units);
    $stmt = $con->prepare("INSERT INTO blood_request (needed_units,request_status,hospital_name,location,status,created_at,blood_type_id,center_id,contact,needed_at,Description,person_in_need_name) VALUES (:units,'pending',:hospital,:location,:status,NOW(),:blood_type,:center_id,:contact,:needed_at,:description,:person_in_need_name)");
    $stmt->execute([
        ':units' => $units,
        ':hospital' => $hospital_name,
        ':location' => "", // no input provided in your form — leave blank or add field
        ':status' => $status,
        ':blood_type' => $blood_type_id,
        ':center_id' => $center_id,
        ':contact' => "$person_name | $phone | $email",
        ':needed_at' => $date_needed,
        ':description' => $description,
        ':person_in_need_name' => $in_need_name
    ]);

    echo json_encode(["status" => "done", "message" => "Blood requerst was send successfully"]);

    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <main>
        <div class="content">
            <div class="start">
                <h1><img src="hospital-solid.svg" alt=""> Hospital Blood Request</h1>
                <p>Request blood units from donation centers</p>
            </div>
            <div class="the_form">
                <h3>Blood request Form</h3>
                <p>Hospital Information</p>
                <form action="">
                    <div class="first_div">
                        <div>
                            <label for="name">Hospital name</label>
                            <input type="text" name="" placeholder="enter hospital name" id="name">
                        </div>
                        <div>
                            <label for="persone">Contact persone</label>
                            <input type="text" name="" placeholder="contacr persone name" id="persone">
                        </div>
                        <div>
                            <label for="email">Email</label>
                            <input type="text" name="" placeholder="hospital@gmail.com" id="email">
                        </div>
                        <div>
                            <label for="phone">Phone</label>
                            <input type="text" name="" placeholder="phone number" id="phone">
                        </div>
                        <div>
                            <label for="location">Hospital Location</label>
                            <input type="text" name="" placeholder="enter hospital location" id="location">
                        </div>
                    </div>
                    <h3>Blood Request Details</h3>
                    <label for="center">Donation center</label>
                    <select name="" id="center">
                        <option value="">Select donation center</option>
                        <?php
                        foreach ($centers as $center) {
                            echo "<option value='" . $center["center_id"] . "'>" . $center["center_name"] . "</option>";
                        }
                        ?>
                    </select>
                    <div class="second_div">
                        <div>
                            <label for="blood_type">Blood type</label>
                            <select name="" id="blood_type">
                                <option value="">Select blood type</option>
                                <?php
                                foreach ($blood_types as $blood) {
                                    if ($blood["blood_type_name"] != "i dont know") {
                                        echo "<option value='" . $blood["blood_type_id"] . "'>" . $blood["blood_type_name"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="blood_type">Person in need</label>
                            <input type="text" name="" placeholder="name of the person in need" id="name_of_person">
                            
                        </div>
                        <div>
                            <label for="units">Units needed</label>
                            <input type="number" name="" min="1" id="units">
                        </div>
                        <div>
                            <label for="date">Date needed</label>
                            <input type="date" name="" id="date">
                        </div>
                    </div>
                    <label for="level">Urgenct Level</label>
                    <select name="" id="level">
                        <option value="normal">Normal</option>
                        <option value="urgent">Urgent</option>
                        <option value="critical">Critical</option>
                    </select>
                    <p>Description/Message *</p>
                    <textarea name="" id="message"></textarea>
                </form>
                <button class="btn">Submit Blood Request</button>
                <p class="error">error</p>
            </div>
        </div>
    </main>
    <script src="../jquery-3.7.1.js"></script>
    <script src="scrpit.js"></script>
</body>

</html>