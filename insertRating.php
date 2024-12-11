<?php
session_start();
include "db_conn.php";
// Here the user id is harcoded.
// You can integrate your authentication code here to get the logged in user id
//$userId = 5;


//require_once ('db.php');
// Here the user id is harcoded.
// You can integrate your authentication code here to get the logged in user id
$user_id = $_SESSION['user_id'];


if (isset($_POST["index"], $_POST["pg_id"])) {

    $pg_id = $_POST["pg_id"];
    $rating = $_POST["index"];

    $checkIfExistQuery = "select * from tbl_rating where user_id = '" . $user_id . "' and pg_id = '" . $pg_id . "'";
    if ($result = mysqli_query($con, $checkIfExistQuery)) {
        $rowcount = mysqli_num_rows($result);
    }

    if ($rowcount == 0) {
        $insertQuery = "INSERT INTO tbl_rating(user_id,pg_id, rating) VALUES ('" . $user_id . "','" . $pg_id . "','" . $rating . "') ";
        $result = mysqli_query($con, $insertQuery);
        echo "success";
    } else {
        echo "Already Voted!";
    }
}




?>
