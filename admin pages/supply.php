<?php
require_once "../db_con/cone.php";
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: ../user pages/login.php");
}

//blood types
$data_to_send = "";
$blood_types = $con->query("SELECT * from blood_types");
$blood_types = $blood_types->fetchAll(PDO::FETCH_ASSOC);
//blood suppkly
$supply = $con->query("SELECT blood_supplay.*,blood_types.blood_type_name FROM blood_supplay JOIN blood_types on blood_supplay.blood_type_id = blood_types.blood_type_id where center_id = " . $_SESSION["admin"]["center_id"]);
$supply = $supply->fetchAll(PDO::FETCH_ASSOC);
//years for select filter
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $update = $con->prepare("UPDATE blood_supplay SET availible_unit = ? ,last_update = NOW() WHERE blood_supplay_id = ?");
    $update->execute([$_POST["new_value"], $_POST["blood_supply_id"]]);

    $supply = $con->query("SELECT blood_supplay.*,blood_types.blood_type_name FROM blood_supplay JOIN blood_types on blood_supplay.blood_type_id = blood_types.blood_type_id where center_id = " . $_SESSION["admin"]["center_id"]);
    $supply = $supply->fetchAll(PDO::FETCH_ASSOC);
    foreach ($supply as $row) {
        $high_threshold = $row['max_units'] * 0.75;

        if ($row['availible_unit'] >= $high_threshold) {
            $status = "good";
        } elseif ($row['availible_unit'] >= $row['required_units']) {
            $status = "normal";
        } else {
            $status = "bad";
        }

        // Sanitize all dynamic data
        $statusEsc = htmlspecialchars($status, ENT_QUOTES, 'UTF-8');
        $blood_type_name = htmlspecialchars($row['blood_type_name'], ENT_QUOTES, 'UTF-8');
        $availible_unit = htmlspecialchars($row['availible_unit'], ENT_QUOTES, 'UTF-8');
        $max_units = htmlspecialchars($row['max_units'], ENT_QUOTES, 'UTF-8');
        $required_units = htmlspecialchars($row['required_units'], ENT_QUOTES, 'UTF-8');
        $last_update = htmlspecialchars($row['last_update'], ENT_QUOTES, 'UTF-8');
        $blood_type_id = htmlspecialchars($row['blood_type_id'], ENT_QUOTES, 'UTF-8');
        $blood_supplay_id = htmlspecialchars($row['blood_supplay_id'], ENT_QUOTES, 'UTF-8');

        $data_to_send .= <<<HTML
        <tr data-status="$statusEsc" data-blood_type="$blood_type_name">
            <td>$blood_type_name</td>
            <td class="td">
                <p class="will_change">$availible_unit</p>
                <input class="change_value" type="number" value="$availible_unit" min="1" max="$max_units">
                <button class="save_change_value" data-min_units="$required_units" data-max_unit="$max_units" data-blood_type="$blood_type_id" data-id="$blood_supplay_id">save</button>
                <button class="cancel_change">cancel</button>
                <p class="error" style="color:red"></p>
            </td>
            <td>$max_units</td>
            <td>$required_units</td>
            <td>$last_update</td>
            <td><p class="$statusEsc">$statusEsc</p></td>
        </tr>
    HTML;
    }

    echo $data_to_send;

    exit();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../admin style/supply.css">
    <title>Blood supply</title>
</head>

<body>
    <script src="../jquery-3.7.1.js"></script>
    <?php require_once "../inclueds/admin_side_bar.php" ?>
    <main>
        <div class="content">
            <header><img src="../admen images/open.svg" class="open" alt=""> <img src="../admen images/blood_supply.svg" alt="">
                <p>Blood supply</p>
            </header>
            <div class="settings">
                <select class="type" id="">
                    <option value="">All types</option>
                    <?php
                    foreach ($blood_types as $type) {
                        if ($type["blood_type_name"] != "i dont know") {
                            echo "<option value='" . $type["blood_type_name"] . "'>" . $type["blood_type_name"] . "</option>";
                        }
                    }
                    ?>
                </select>
                <select class="status" id="">
                    <option value="">All</option>
                    <option value="normal">normal</option>
                    <option value="good">good</option>
                    <option value="bad">bad</option>
                </select>
            </div>
            <div class="use_case_for_user">
                <div>
                    <img src="../admen images/TIPS.svg" class="tip" alt="">
                    <p><span>Tip:</span> Double-click on any Available Units row, to edit directly in the table.</p>
                </div>
            </div>
            <div class="table">
                <table>
                    <thead>
                        <th>Blood Type</th>
                        <th>Available Units</th>
                        <th>Maximum Amount</th>
                        <th>Minimum Amount</th>
                        <th>Last Update</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($supply as $row) {
                            $high_threshold = $row['max_units'] * 0.75;

                            if ($row['availible_unit'] >= $high_threshold) {
                                $status = "good";
                            } elseif ($row['availible_unit'] >= $row['required_units']) {
                                $status = "normal";
                            } else {
                                $status = "bad";
                            }
                            echo <<<HTML
                                <tr data-status="{$status}" data-blood_type="{$row['blood_type_name']}">
                                    <td>{$row['blood_type_name']}</td>
                                    <td class="td">
                                        <p class="will_change">{$row['availible_unit']}</p>
                                        <input class="change_value" type="number" value="{$row['availible_unit']}" min="1" max="{$row['max_units']}">
                                        <button class="save_change_value" data-min_units="{$row['required_units']}" data-max_unit="{$row['max_units']}" data-blood_type="{$row['blood_type_id']}" data-id="{$row['blood_supplay_id']}">save</button>
                                        <button class="cancel_change">cancel</button>
                                        <p class="error" style="color:red"></p>
                                    </td>
                                    <td>{$row['max_units']}</td>
                                    <td>{$row['required_units']}</td>
                                    <td>{$row['last_update']}</td>
                                    <td>
                            HTML;
                            echo "<p class='" . $status . "'>" . $status . "</p>";
                            echo <<<HTML
                                    </td>
                                </tr>
                            HTML;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <script src="../admen scripts/supply.js"></script>
</body>

</html>