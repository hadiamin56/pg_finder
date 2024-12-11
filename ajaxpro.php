<?php
include "db_conn.php";
$sql = "SELECT * FROM tbl_district

      WHERE region_id LIKE '%".$_GET['id']."%'";


$result = mysqli_query($con,$sql);


$json = [];

while($row = mysqli_fetch_assoc($result)){

     $json[$row['id']] = $row['name'];

}


echo json_encode($json);

?>
