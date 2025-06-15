<?php
require_once "../db_con/cone.php";
require_once "../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
session_start();
$requests = $con->query("SELECT br.*, bt.blood_type_name, dc.center_name 
    FROM blood_request br
    JOIN blood_types bt ON br.blood_type_id = bt.blood_type_id
    JOIN donation_centers dc ON br.center_id = dc.center_id
    ORDER BY br.created_at DESC
");
$requests = $requests->fetchAll(PDO::FETCH_ASSOC);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_data = "";
    $update = $con->prepare("UPDATE blood_request set request_status = ? WHERE blood_request_id = ?");
    if ($update->execute([$_POST["status"], $_POST["id"]])) {
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
            $mail->addAddress($_POST["email"], $_POST['name']);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Blood request';
            $mail->Body = '<h1>' . $_POST["message"] . '</h1>.';
            $mail->send();
            $requests = $con->query("SELECT br.*, bt.blood_type_name, dc.center_name 
                FROM blood_request br
                JOIN blood_types bt ON br.blood_type_id = bt.blood_type_id
                JOIN donation_centers dc ON br.center_id = dc.center_id
                ORDER BY br.created_at DESC
            ");
            $requests = $requests->fetchAll(PDO::FETCH_ASSOC);
            foreach ($requests as $req) {
                $hospital_name = htmlspecialchars($req["hospital_name"]);
                $status = htmlspecialchars($req["status"]);
                $request_status = htmlspecialchars($req["request_status"]);
                $blood_request_id = htmlspecialchars($req["blood_request_id"]);
                $contact_raw = htmlspecialchars($req["contact"]);
                $blood_type_name = htmlspecialchars($req["blood_type_name"]);
                $needed_units = htmlspecialchars($req["needed_units"]);
                $needed_at = htmlspecialchars($req["needed_at"]);
                $created_at = htmlspecialchars($req["created_at"]);
                $description = htmlspecialchars($req["Description"]);
                $urgencyClass = strtolower($req["status"]);

                $new_data .= <<<HTML
                    <tr data-name="$hospital_name" data-status="$status" data-center_status="$request_status">
                    <td>$hospital_name</td>
                    <td>
                HTML;

                $contact = explode('|', $contact_raw);
                for ($i = 0; $i < count($contact); $i++) {
                    $new_data .= "<p style='margin-block:5px'>" . htmlspecialchars($contact[$i]) . "</p>";
                }

                $new_data .= <<<HTML
            </td>
            <td>$description</td>
            <td>$blood_type_name</td>
            <td>$needed_units</td>
            <td>$needed_at</td>
            <td><span class="$urgencyClass">$status</span></td>
            <td><span class="$request_status">$request_status</span></td>
            <td>
                <button class="respond-btn" 
                    data-id="$blood_request_id"
                    data-hospital="$hospital_name"
                    data-contact="$contact_raw"
                    data-type="$blood_type_name"
                    data-units="$needed_units"
                    data-date="$needed_at"
                    data-status="$status"
                    data-desc="$description">
                    Respond
                </button>
            </td>
        </tr>
    HTML;
            }

            echo json_encode(["status" => "ok", "message" => "an email was sent successfully", "new_data" => $new_data]);
        } catch (Exception $e) {
            echo "Email could not be sent. Error: {$mail->ErrorInfo}";
        }
    } else {
        echo json_encode(["status" => "error", "message" => "an error acured"]);
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../admin style/blood_reuqest.css" />
    <title>Blood request</title>
</head>

<body>
    <script src="../jquery-3.7.1.js"></script>
    <?php require_once "../inclueds/admin_side_bar.php" ?>
    <main>
        <div class="content">
            <header>
                <img src="../admen images/open.svg" class="open" alt="">
                <img src="../admen images/hospital.svg" class="sohpital" alt="">
                <p>Blood Requests</p>
            </header>
            <div class="settings">
                <input type="text" class="searsh_hospital" placeholder="searsh hospital by name">
                <select class="status">
                    <option value="">All hospital need status</option>
                    <option value="normal">Normal</option>
                    <option value="urgent">Urgent</option>
                    <option value="critical">Critical</option>
                </select>
                <select class="request_status">
                    <option value="">All requerst status</option>
                    <option value="pending">pending</option>
                    <option value="cancled">cancled</option>
                    <option value="done">done</option>
                </select>
            </div>
            <section>
                <table>
                    <thead>
                        <th>Hospital</th>
                        <th>Contact</th>
                        <th>Description</th>
                        <th>Blood Type</th>
                        <th>Units</th>
                        <th>Date Needed</th>
                        <th>Urgency</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody class="tbody">
                        <?php
                        foreach ($requests as $req) {
                            // Sanitize dynamic values
                            $hospital_name = htmlspecialchars($req["hospital_name"]);
                            $status = htmlspecialchars($req["status"]);
                            $request_status = htmlspecialchars($req["request_status"]);
                            $blood_request_id = htmlspecialchars($req["blood_request_id"]);
                            $contact_raw = htmlspecialchars($req["contact"]);
                            $blood_type_name = htmlspecialchars($req["blood_type_name"]);
                            $needed_units = htmlspecialchars($req["needed_units"]);
                            $needed_at = htmlspecialchars($req["needed_at"]);
                            $created_at = htmlspecialchars($req["created_at"]);
                            $description = htmlspecialchars($req["Description"]);
                            $urgencyClass = strtolower($req["status"]);

                            echo <<<HTML
                                <tr data-name="$hospital_name" data-status="$status" data-center_status="$request_status">
                                    <td>$hospital_name</td>
                                    <td>
                            HTML;

                            $contact = explode('|', $req["contact"]);
                            for ($i = 0; $i < count($contact); $i++) {
                                echo "<p style='margin-block:5px'>" . htmlspecialchars($contact[$i]) . "</p>";
                            }

                            echo <<<HTML
                            </td>
                            <td>$description</td>
                            <td>$blood_type_name</td>
                            <td>$needed_units</td>
                            <td>$needed_at</td>
                            <td><span class="$urgencyClass">$status</span></td>
                            <td><span class="$request_status">$request_status</span></td>
                            <td>
                                <button class="respond-btn" 
                                    data-id="$blood_request_id"
                                    data-hospital="$hospital_name"
                                    data-contact="$contact_raw"
                                    data-type="$blood_type_name"
                                    data-units="$needed_units"
                                    data-date="$needed_at"
                                    data-status="$status"
                                    data-desc="$description">
                                    Respond
                                </button>
                            </td>
                        </tr>
                    HTML;
                        }

                        ?>
                    </tbody>
                </table>
            </section>

            <dialog id="edite">
                <form>
                    <div class="settings2">
                        <h2>Respond to Blood Request</h2>
                        <p id="cancel-dialog">&#10006;</p>
                    </div>
                    <div id="dialog-content">
                    </div>
                    <label for="response_status">Response Status:</label>
                    <select id="response_status">
                        <option value="">Select a status</option>
                        <option value="pending">pending</option>
                        <option value="done">done</option>
                        <option value="canceled">canceled</option>
                    </select>
                    <label for="response_msg">Response Message:</label>
                    <textarea id="response_msg" rows="4" placeholder="Provide pickup instructions or reason for rejection..."></textarea>
                    <div class="dialog-actions">
                        <button class="send">Send Response</button>
                        <p class="error"></p>
                    </div>
                </form>
            </dialog>
        </div>
    </main>
    <script src="../admen scripts/blood_request.js"></script>
</body>

</html>