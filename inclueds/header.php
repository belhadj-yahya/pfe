<head>
    <link rel="stylesheet" href="/pfe/inclueds/header.css">
</head>
<header>
    <img src="/pfe/user images/logo.png" class="main_logo" alt="">
    <nav class="header_nav">
        <a href="/pfe/index.php">Home</a>
        <a href="/pfe/user pages/blood_need_news.php">Events</a>
        <a href="/pfe/user pages/select_center.php">donate request</a>
    </nav>
    <?php
    if (isset($_SESSION["user"])) {
        echo "<a href='/pfe/user pages/account.php' class='acount'>Acount</a>";
    } else {
        echo "<a href='user pages/login.php' class='login'>log in</a>";
    }
    ?>
    <button class="open_button">&#9776;</button>
</header>
<nav class="side_bar">
    <button class="close_button">&#10006;</button>
    <a href="/pfe/index.php">Home</a>
    <a href="/pfe/user pages/blood_need_news.php">Events</a>
    <a href="/pfe/user pages/request.php">donate request</a>
    <?php
    if (isset($_SESSION["user"])) {
        echo "<a href='/pfe/user pages/account.php' class='account'>Acount</a>";
    } else {
        echo "<a href='user pages/login.php' class='login'>log in</a>";
    }
    ?>
</nav>
<script src="/pfe/jquery-3.7.1.js"></script>
<script src="\pfe\inclueds\header.js"></script>