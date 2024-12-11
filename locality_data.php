<?php
/*include "db_conn.php";
$get_locality="SELECT * FROM tbl_locality WHERE district_id = '$_GET['d_id']";
$q_result=mysqli_query($con,$get_locality);
$json=[];
while ($data=mysqli_fetch_assoc($q_result)) {
  $json[$data['id']]= $data['name'];
}
echo json_encode($json);

*/
?>
<?php
include "db_conn.php";
$sql = "SELECT * FROM tbl_locality

      WHERE district_id LIKE '%".$_GET['id']."%'";


$result = mysqli_query($con,$sql);


$json = [];

while($row = mysqli_fetch_assoc($result)){

     $json[$row['id']] = $row['name'];

}


echo json_encode($json);

?>
