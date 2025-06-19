<?php
require_once "../db_con/cone.php";
session_start();

$blood_types = $con->query("SELECT * from blood_types");
$blood_types = $blood_types->fetchAll(PDO::FETCH_ASSOC);

$users = $con->query("SELECT users.user_id,users.user_full_name,users.user_email,users.phone,users.location,blood_type_name,users.blood_type_id,COUNT(request_id) AS total_requests FROM users LEFT JOIN blood_types ON users.blood_type_id = blood_types.blood_type_id LEFT JOIN donation_request ON users.user_id = donation_request.user_id GROUP BY users.user_id, users.user_full_name,users.user_email,blood_type_name,users.phone,users.location,users.blood_type_id");
$users = $users->fetchAll(PDO::FETCH_ASSOC);


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"])) {
    if ($_POST["action"] === "add_user") {
        $name = trim($_POST["full_name"] ?? '');
        $type = trim($_POST["type"] ?? '');
        $phone = trim($_POST["phone"] ?? '');
        $email = trim($_POST["email"] ?? '');
        $password = trim($_POST["password"] ?? '');
        $location = trim($_POST["location"] ?? '');

        if (!$name || !$type || !$phone || !$email || !$password || !$location) {
            echo json_encode(["status" => "error", "message" => "Missing fields"]);
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(["status" => "error", "message" => "Invalid email"]);
            exit;
        }

        if (strlen($password) < 8) {
            echo json_encode(["status" => "error", "message" => "Password too short."]);
            exit;
        }

        $stmt = $con->prepare("SELECT * FROM users WHERE user_email = ? OR phone = ?");
        $stmt->execute([$email, $phone]);
        if ($stmt->fetch(PDO::FETCH_ASSOC)) {
            echo json_encode(["status" => "error", "message" => "Email or phone already in use."]);
            exit;
        }

        // Get blood_type_id from name
        $stmt = $con->prepare("SELECT blood_type_id FROM blood_types WHERE blood_type_name = ?");
        $stmt->execute([$type]);
        $blood = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$blood) {
            echo json_encode(["status" => "error", "message" => "Invalid blood type"]);
            exit;
        }
        $blood_id = $blood["blood_type_id"];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $con->prepare("INSERT INTO users (user_full_name, user_email, phone, user_password, blood_type_id, location) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $phone, $hashed_password, $blood_id, $location]);
        echo json_encode(["status" => "done", "message" => "User added successfully"]);
        exit;
    } elseif ($_POST["action"] === "update_user") {
        $user_id = $_POST["user_id"] ?? null;
        $name = trim($_POST["name"] ?? '');
        $email = trim($_POST["email"] ?? '');
        $phone = trim($_POST["phone"] ?? '');
        $location = trim($_POST["city"] ?? '');
        $blood_type_id = $_POST["blood_type"] ?? null;

        if (!$user_id || !$name || !$email || !$phone  || !$location || !$blood_type_id) {
            // echo  "user_id: " . $user_id . "user_name:  " . $name . "user_email:  " . $email . "user_phone:  " . $phone . "user_location:  " . $location . "user_blood_type:  " . $blood_type_id;
            echo json_encode(["status" => "error", "message" => "Missing required fields"]);
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(["status" => "error", "message" => "Invalid email format"]);
            exit;
        }

        // Checkoing if email is used by another user
        $stmt = $con->prepare("SELECT * FROM users WHERE user_email = ? AND user_id != ?");
        $stmt->execute([$email, $user_id]);
        if ($stmt->fetch(PDO::FETCH_ASSOC)) {
            echo json_encode(["status" => "error", "message" => "Email already in use by another user"]);
            exit;
        }

        // Checking if phone is used by another user
        $stmt = $con->prepare("SELECT * FROM users WHERE phone = ? AND user_id != ?");
        $stmt->execute([$phone, $user_id]);
        if ($stmt->fetch(PDO::FETCH_ASSOC)) {
            echo json_encode(["status" => "error", "message" => "Phone number already in use by another user"]);
            exit;
        }


        // Update the user data
        $stmt = $con->prepare("UPDATE users SET user_full_name = ?, user_email = ?, phone = ?, location = ?, blood_type_id = ? WHERE user_id = ?");
        $updated = $stmt->execute([$name, $email, $phone, $location, $blood_type_id, $user_id]);

        if ($updated) {
            echo json_encode(["status" => "done", "message" => "User updated successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to update user"]);
        }

        exit;
    } elseif ($_POST["action"] === "delete_user") {
        $user_id = $_POST["user_id"] ?? null;

        if (!$user_id) {
            echo json_encode(["status" => "error", "message" => "User ID missing"]);
            exit;
        }
        $stmt = $con->prepare("DELETE FROM users WHERE user_id = ?");
        $deleted = $stmt->execute([$user_id]);

        if ($deleted) {
            echo json_encode(["status" => "done", "message" => "User deleted successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to delete user"]);
        }

        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../admin style/users.css">
    <title>Users</title>
</head>

<body>
    <script src="../jquery-3.7.1.js"></script>
    <?php require_once "../inclueds/admin_side_bar.php" ?>
    <main>
        <div class="content">
            <header><img src="../admen images/open.svg" class="open" alt=""> <img src="../admen images/users.svg" alt="">
                <p>Users</p>
            </header>
            <div class="action">
                <input type="text" placeholder="Searsh User by name" class="searsh_by_name">
                <select name="type" id="">
                    <option value="">All types</option>
                    <?php
                    foreach ($blood_types as $type) {
                        echo "<option value='" . $type["blood_type_name"] . "'>" . $type["blood_type_name"] . "</option>";
                    }
                    ?>
                </select>
                <button class="add">Add user</button>
            </div>
            <section>
                <table>
                    <thead>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Blood type</th>
                        <th>Donations</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($users as $user) {
                            $user_full_name = htmlspecialchars($user['user_full_name']);
                            $blood_type_name = htmlspecialchars($user['blood_type_name']);
                            $user_email = htmlspecialchars($user['user_email']);
                            $phone = htmlspecialchars($user['phone']);
                            $blood_type_id = htmlspecialchars($user['blood_type_id']);
                            $total_requests = htmlspecialchars($user['total_requests']);
                            $location = htmlspecialchars($user['location']);
                            $user_id = htmlspecialchars($user['user_id']);
                            echo <<<HTML
                                <tr class="user_name" data-name="$user_full_name" data-type="$blood_type_name">
                                    <td class="name">$user_full_name</td>
                                    <td class="email">$user_email</td>
                                    <td class="phone">$phone</td>
                                    <td class="blood_type" data-blood_type="$blood_type_id">$blood_type_name</td>
                                    <td>$total_requests</td>
                                    <td class="city">$location</td>
                                    <td class="action">
                                        <button class="adite">Edite</button>
                                        <input type="hidden" name="user_id" value="$user_id">
                                        <button class="delete-user-btn">Delete</button>
                                    </td>
                                </tr>
                            HTML;
                        }
                        ?>
                    </tbody>
                </table>
                <dialog id="add">
                    <div class="main_div">
                        <div class="settings">
                            <h2>Add user</h2>
                            <p class="close">&#10006;</p>
                        </div>
                        <form action="" method="post">
                            <div>
                                <label for="full_name">Full Name</label>
                                <input type="text" name="" id="full_name">
                            </div>
                            <div>
                                <label for="">Blood type</label>
                                <select name="add_type" id="">
                                    <option value="">All types</option>
                                    <?php
                                    foreach ($blood_types as $type) {
                                        echo "<option value='" . $type["blood_type_name"] . "'>" . $type["blood_type_name"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label for="phone">Phone number</label>
                                <input type="number" name="" id="phone">
                            </div>
                            <div>
                                <label for="em">Email</label>
                                <input type="email" name="" id="em">
                            </div>
                            <div>
                                <label for="pass">Password</label>
                                <input type="password" name="" id="pass">
                            </div>
                            <div>
                                <label for="con_pass">Confirm password</label>
                                <input type="password" name="" id="con_pass">
                            </div>
                            <div>
                                <label for="loc">Location</label>
                                <input type="text" name="" id="loc">
                            </div>
                        </form>
                        <div class="last_div">
                            <button>Add</button>
                            <p class="error1"></p>
                        </div>
                    </div>
                </dialog>
                <dialog id="edite">
                    <div class="new_main_div">
                        <div class="settings">
                            <h2>Edite user</h2>
                            <p class="close">&#10006;</p>
                        </div>
                        <form action="" method="post">
                            <div>
                                <label for="new_full_name">New Full Name</label>
                                <input type="text" name="" id="new_full_name">
                            </div>
                            <div>
                                <label for="">New Blood type</label>
                                <select name="new_type" id="new_type">
                                    <option value="">All types</option>
                                    <?php
                                    foreach ($blood_types as $type) {
                                        echo "<option value='" . $type["blood_type_id"] . "'>" . $type["blood_type_name"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label for="new_phone">New Phone number</label>
                                <input type="number" name="" id="new_phone">
                            </div>
                            <div>
                                <label for="new_em">New Email</label>
                                <input type="email" name="" id="new_em">
                            </div>
                            <div>
                                <label for="new_loc">Location</label>
                                <input type="text" name="" id="new_loc">
                            </div>
                        </form>
                        <div class="last_div">
                            <button id="confirmEdit">Update</button>
                            <p class="error2"></p>
                        </div>
                    </div>
                </dialog>
            </section>
        </div>
    </main>

    <script src="../admen scripts/user.js?v=1.0.2"></script>
</body>

</html>