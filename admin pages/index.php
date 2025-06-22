<?php
require_once "../db_con/cone.php";
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: ../user pages/login.php");
}
// total blood units in the center
$total_blood_unit = $con->query("SELECT SUM(availible_unit) as units FROM blood_supplay WHERE center_id = " . $_SESSION["admin"]["center_id"]);
$total_blood_unit = $total_blood_unit->fetch(PDO::FETCH_ASSOC);
// years for select:
$years = $con->query("SELECT DISTINCT YEAR(donation_date) AS year FROM donation_request ORDER BY year");
$years = $years->fetchAll(PDO::FETCH_ASSOC);

//total users

$total_users = $con->query("SELECT COUNT(users.user_id) as total_users FROM users");
$total_users = $total_users->fetch(PDO::FETCH_ASSOC);

// total donation that has been done
$total_donations = $con->query("SELECT COUNT(dr.request_id) AS total_donation
FROM donation_request dr
LEFT JOIN news_events ne ON dr.news_event_id = ne.news_event_id
WHERE COALESCE(dr.center_id, ne.center_id) = " . $_SESSION["admin"]["center_id"]);
$total_donations = $total_donations->fetch(PDO::FETCH_ASSOC);

// total urgent need now 
$total_urgent = $con->query("SELECT COUNT(news_events.news_event_id) as total_urgent_need FROM news_events WHERE type = 'event'");
$total_urgent = $total_urgent->fetch(PDO::FETCH_ASSOC);

// for the sharts
$blood = $con->query("SELECT blood_supplay.availible_unit FROM blood_supplay WHERE center_id = " . $_SESSION["admin"]["center_id"]);
$blood = $blood->fetchAll(PDO::FETCH_ASSOC);
// to get total donations pur month
$donations_per_month = $con->query("SELECT  IFNULL(COUNT(dr.donation_date), 0) AS total_requests FROM ( SELECT 1 AS m, 'January' AS month UNION ALL SELECT 2, 'February' UNION ALL SELECT 3, 'March' UNION ALL SELECT 4, 'April' UNION ALL SELECT 5, 'May' UNION ALL SELECT 6, 'June' UNION ALL SELECT 7, 'July' UNION ALL SELECT 8, 'August' UNION ALL SELECT 9, 'September' UNION ALL SELECT 10, 'October' UNION ALL SELECT 11, 'November' UNION ALL SELECT 12, 'December') AS months LEFT JOIN donation_request dr ON MONTH(dr.donation_date) = months.m AND YEAR(dr.donation_date) = 2025 GROUP BY  months.m, months.month ORDER BY months.m;");
$donations_per_month = $donations_per_month->fetchAll(PDO::FETCH_ASSOC);
// to get 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["action"] == "") {
        $bloodUnits = array_map(function ($row) {
            return $row['availible_unit'];
        }, $blood);

        $monthlyRequests = array_map(function ($row) {
            return (int)$row['total_requests'];
        }, $donations_per_month);

        echo json_encode([
            "blood_supply" => $bloodUnits,
            "requests" => $monthlyRequests
        ]);
    } elseif ($_POST["action"] == "new_date") {
        $donations_per_month = $con->query("SELECT  IFNULL(COUNT(dr.donation_date), 0) AS total_requests FROM ( SELECT 1 AS m, 'January' AS month UNION ALL SELECT 2, 'February' UNION ALL SELECT 3, 'March' UNION ALL SELECT 4, 'April' UNION ALL SELECT 5, 'May' UNION ALL SELECT 6, 'June' UNION ALL SELECT 7, 'July' UNION ALL SELECT 8, 'August' UNION ALL SELECT 9, 'September' UNION ALL SELECT 10, 'October' UNION ALL SELECT 11, 'November' UNION ALL SELECT 12, 'December') AS months LEFT JOIN donation_request dr ON MONTH(dr.donation_date) = months.m AND YEAR(dr.donation_date) = " . $_POST["year"] . " GROUP BY  months.m, months.month ORDER BY months.m;");
        $donations_per_month = $donations_per_month->fetchAll(PDO::FETCH_ASSOC);
        $monthly_Requests = array_map(function ($row) {
            return (int)$row['total_requests'];
        }, $donations_per_month);
        echo json_encode(["request" => $monthly_Requests]);
    }
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../admin style/index.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>dashboard</title>
</head>

<body>
    <script src="../jquery-3.7.1.js"></script>
    <?php require_once "../inclueds/admin_side_bar.php" ?>
    <main>
        <div class="content">
            <header><img src="../admen images/open.svg" class="open" alt=""> <img src="../admen images/dashboard.svg" alt="">
                <p>Dashboard</p>
            </header>
            <div class="cards">
                <div class="d1">
                    <div>
                        <p>Total users</p> <img src="../admen images/users.svg" alt="">
                    </div>
                    <p style="font-weight: bold;"><?php echo htmlspecialchars($total_users["total_users"]) ?></p>
                </div>
                <div class="d1">
                    <div>
                        <p>Total Blood units</p> <img src="../admen images/blood_supply.svg" alt="">
                    </div>
                    <p style="font-weight: bold;"><?php echo htmlspecialchars($total_blood_unit["units"]) ?></p>
                </div>
                <div class="d1">
                    <div>
                        <p>Total request</p> <img src="../admen images/donations.svg" alt="">
                    </div>
                    <p style="font-weight: bold;"><?php echo htmlspecialchars($total_donations["total_donation"]) ?></p>
                </div>
                <div class="d1">
                    <div>
                        <p>Urgent need</p> <img src="../admen images/TIPS.svg" class="tip" alt="">
                    </div>
                    <p style="font-weight: bold;"><?php echo htmlspecialchars($total_urgent["total_urgent_need"]) ?></p>
                </div>
            </div>
            <div class="before_chart">
                <div class="change">
                    <canvas id="bloodTypeChart"></canvas>
                </div>
                <div>
                    <div class="select_div">
                        <select name="date" id="">
                            <?php
                            foreach ($years as $year) {
                                echo "<option value='" . $year["year"] . "'>" . $year["year"] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <canvas id="monthlyDonationsChart"></canvas>
                </div>

            </div>
        </div>
    </main>
    <script src="../admen scripts/index.js"></script>
</body>

</html>