
<?php
session_start();
include "config.php";
include 'db_conn.php';

         $userid=$_SESSION["user_id"];


$id = $_POST['id'];
$rating = $_POST['rating'];
// Check entry within table
$query = "SELECT COUNT(*) AS cntcourse FROM tbl_rating WHERE pg_id='$id' AND user_id='$userid'";

$result = mysqli_query($con,$query);
$fetchdata = mysqli_fetch_array($result);
$count = $fetchdata['cntcourse'];

if($count == 0){
    $insertquery = "INSERT INTO tbl_rating(user_id,pg_id,rating) values('$userid','$pg_id','$rating')";
    mysqli_query($con,$insertquery);
}else {
    $updatequery = "UPDATE rating SET rating='$rating' WHERE user_id= '$userid'  AND pg_id= '$pg_id'";
    mysqli_query($con,$updatequery);
}


// get average
$query = "SELECT ROUND(AVG(rating),1) as averageRating FROM rating WHERE pg_id='$id'";
$result = mysqli_query($con,$query) or die(mysqli_error());
$fetchAverage = mysqli_fetch_array($result);
$averageRating = $fetchAverage['averageRating'];

$return_arr = array("averageRating"=>$averageRating);
//echo "<h1>Hi</h1>";
echo json_encode($return_arr);
