<?php
require_once "../db_con/cone.php";
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: ../user pages/login.php");
}
$blood_types = $con->query("SELECT * from blood_types");
$blood_types = $blood_types->fetchAll(PDO::FETCH_ASSOC);
$events = $con->query("SELECT * FROM news_events WHERE type = 'event'");
$news = $con->query("SELECT * FROM news_events WHERE type = 'news'");
$news = $news->fetchAll(PDO::FETCH_ASSOC);
$events = $events->fetchAll(PDO::FETCH_ASSOC);
$data = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["action"] == "events") {
        $add = $con->prepare("INSERT INTO news_events(title,description,news_events_date,type,max_units_needed,center_id,data_of_relais,blood_type_needed) VALUES(?,?,?,'event',?,?,NOW(),?)");
        if ($add->execute([$_POST["event_title"], $_POST["event_content"], $_POST["event_date"], $_POST["units"], $_SESSION["admin"]["center_id"], strtoupper($_POST["event_blood_type"])])) {
            echo json_encode(["status" => "done", "message" => "urgent blood need was added"]);
        } else {
            echo json_encode(["status" => "error", "message" => "an error happned try again later"]);
        }
    } else if ($_POST['action'] == "news") {
        $add = $con->prepare("INSERT INTO news_events(title,description,news_events_date,type,max_units_needed,center_id,data_of_relais,blood_type_needed) VALUES(?,?,NULL,'news',NULL,?,NOW(),NULL)");
        if ($add->execute([$_POST["news_title"], $_POST["news_content"], $_SESSION["admin"]["center_id"]])) {
            echo json_encode(["status" => "done", "message" => "new artical was added"]);
        } else {
            echo json_encode(["status" => "error", "message" => "an error happned try again later"]);
        }
    } else if ($_POST["action"] == "delete") {
        $delete = $con->prepare("DELETE from news_events where news_event_id = ?");
        if ($delete->execute([$_POST["id"]])) {

            if ($_POST["table"] == ".events_tbody") {
                $events = $con->query("SELECT * FROM news_events WHERE type = 'event'");
                $events = $events->fetchAll(PDO::FETCH_ASSOC);
                foreach ($events as $event) {
                    $data .= <<<HTML
                                <tr data-evnet_title="{$event['title']}" data-event_blood_type="{$event['blood_type_needed']}">
                                    <td>{$event["title"]}</td>
                                    <td style="width:200px">{$event["description"]}</td>
                                    <td>{$event["data_of_relais"]}</td>
                                    <td>{$event["news_events_date"]}</td>
                                    <td>{$event["max_units_needed"]}</td>
                                    <td>{$event["blood_type_needed"]}</td>
                                    <td>
                                        <button class="delete" data-event_id="{$event['news_event_id']}" data-table=".events_tbody">Delete</button>
                                    </td>
                                </tr>
                            HTML;
                }
            } else {
                $news = $con->query("SELECT * FROM news_events WHERE type = 'news'");
                $news = $news->fetchAll(PDO::FETCH_ASSOC);
                foreach ($news as $new) {
                    $data .= <<<HTML
                                <tr data-news_title="{$new['title']}">
                                    <td style="width:200px">{$new["title"]}</td>
                                    <td style="width:300px">{$new["description"]}</td>
                                    <td style="padding-inline: 50px;">{$new["data_of_relais"]}</td>
                                    <td>
                                        <button class="delete" data-event_id="{$new['news_event_id']}">Delete</button>
                                    </td>
                                </tr>
                            HTML;
                }
            }
            echo json_encode(["status" => "done", "data" => $data]);
        } else {
            echo json_encode(["status" => "error"]);
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
    <link rel="stylesheet" href="../admin style/event_news.css">
    <title>Blood need and news</title>
</head>

<body>
    <script src="../jquery-3.7.1.js"></script>
    <?php require_once "../inclueds/admin_side_bar.php" ?>
    <main>
        <div class="content">
            <header><img src="../admen images/open.svg" class="open" alt=""> <img src="../admen images/calnder.svg" alt="">
                <p>news and blood need</p>
            </header>
            <div class="first_settings">
                <button class="blood_need_switch">blood need</button>
                <button class="news_switch">News</button>
            </div>
            <div class="after_main">
                <div class="second_settings">
                    <input type="text" class="event_search" id="" placeholder="seach blood need by title">
                    <button class="add_event">+ add event</button>
                    <select class="type_for_event" id="">
                        <option value="">All types</option>
                        <?php
                        foreach ($blood_types as $type) {
                            if($type["blood_type_name"] != "I don't know"){
                                echo "<option value='" . $type["blood_type_name"] . "'>" . $type["blood_type_name"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="table_of_events">
                    <table>
                        <thead>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Date of relaise</th>
                            <th>Date of need</th>
                            <th>Units needed</th>
                            <th>Blood types in need</th>
                            <th>Action</th>
                        </thead>
                        <tbody class="events_tbody">
                        <?php
                            foreach ($events as $event) {
                                // Escape all values
                                $title = htmlspecialchars($event['title']);
                                $description = htmlspecialchars($event['description']);
                                $date_of_relais = htmlspecialchars($event['data_of_relais']);
                                $news_events_date = htmlspecialchars($event['news_events_date']);
                                $max_units_needed = htmlspecialchars($event['max_units_needed']);
                                $blood_type_needed = htmlspecialchars($event['blood_type_needed']);
                                $news_event_id = htmlspecialchars($event['news_event_id']);

                                echo <<<HTML
                                <tr class="event_tr" data-event_title="$title" data-event_blood_type="$blood_type_needed">
                                    <td>$title</td>
                                    <td style="width:200px">$description</td>
                                    <td>$date_of_relais</td>
                                    <td>$news_events_date</td>
                                    <td>$max_units_needed</td>
                                    <td>$blood_type_needed</td>
                                    <td>
                                        <button class="delete" data-event_id="$news_event_id" data-table=".events_tbody">Delete</button>
                                    </td>
                                </tr>
                                HTML;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <dialog id="edite">
                    <div class="new_main_div">
                        <div class="settings">
                            <h2>Add event</h2>
                            <p class="close">&#10006;</p>
                        </div>
                        <form action="" method="post">
                            <div>
                                <label for="new_full_name">Title</label>
                                <input type="text" name="" class="event_title" placeholder="title of the emergency">
                            </div>
                            <div>
                                <label for="new_phone">Content</label>
                                <textarea name="" class="event_content" id="" placeholder="context of the emergency"></textarea>
                            </div>
                            <div>
                                <label for="">Blood types in need</label>
                                <input type="text" class="blood_type_in_need" placeholder="enter all blood type in need or type all for all types">
                            </div>
                            <div>
                                <label for="">Units needed</label>
                                <input type="number" min="1" class="units" placeholder="units of blood in need">
                            </div>
                            <div>
                                <label for="new_em">Date of need</label>
                                <input type="date" name="" class="date_of_need">
                            </div>
                        </form>
                        <div class="last_div">
                            <button id="confirmEdit">add</button>
                            <p class="error2"></p>
                        </div>
                    </div>
                </dialog>
            </div>
            <div class="after_main2">
                <div class="second_settings2">
                    <input type="text" class="news_search" id="" placeholder="seach news by title">
                    <button class="add_news">+ add News</button>
                </div>
                <div class="table_of_news">
                    <table>
                        <thead>
                            <th>Title</th>
                            <th>Description</th>
                            <th style="padding-inline: 50px;">Date of relaise</th>
                            <th>Action</th>
                        </thead>
                        <tbody class="news_tbody">
                            <?php
                            foreach ($news as $new) {
                                echo <<<HTML
                                <tr data-news_title="{$new['title']}" class="news_tr">
                                    <td class="test">{$new["title"]}</td>
                                    <td class='small'>{$new["description"]}</td>
                                    <td style="padding-inline: 50px;">{$new["data_of_relais"]}</td>
                                    <td>
                                        <button class="delete" data-event_id="{$new['news_event_id']}" data-table=".news_tbody">Delete</button>
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
                            <h2>Add a News Article</h2>
                            <p class="close">&#10006;</p>
                        </div>
                        <form action="" method="post">
                            <div>
                                <label for="full_name">Ttile</label>
                                <input type="text" name="" id="full_name">
                            </div>
                            <div>
                                <p>Content</p>
                                <textarea name="" id="news_content"></textarea>
                            </div>
                        </form>
                        <div class="last_div">
                            <button id="add_news_button">Add</button>
                            <p class="error1"></p>
                        </div>
                    </div>
                </dialog>
            </div>
        </div>

    </main>
    <script src="../admen scripts/news.js?v=1.0.1"></script>
</body>

</html>