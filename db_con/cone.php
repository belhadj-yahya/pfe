<?php
$cdn = "mysql:host=localhost;dbname=blood";
$user = "root";
$pass = "";

try {
    $con = new PDO($cdn, $user, $pass);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $th) {
    echo $th->getMessage();
}
