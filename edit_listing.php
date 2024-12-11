<?php
       include('header.php');

    $id=isset($_GET["id"]) ? $_GET["id"] : '';

        if(!isset($_SESSION["user"]) )
            {
                // mysql_close($connection); // Closing Connection
                // header('Location: login.php'); // Redirecting To Home Page
                echo"<script>location.replace('login.php')</script>";
            }

    echo"$id";
    $select_data="SELECT * FROM tbl_pg WHERE status=1 AND  id='$id'";
    $result=mysqli_query($con,$select_data);
    if(mysqli_num_rows($result)>0){
       while($row=mysqli_fetch_assoc($result)){

           $title=$row['pg_title'];
           $address=$row['address'];
           $budget=$row['budget_per_month'];
           $contact=$row['contact'];
           $image=$row['img'];
           $description=$row['pg_description'];
           $landmark=$row['landmark'];
           $status=$row['status'];
           $locality=$row['locality_id'];
           $region=$row['region_id'];
          $district=$row['district_id'];
           $user=$row['user_id'];
           $meal_type=$row['meal_type'];
           $video=$row['video'];
         //  echo" $title";
       }
    }

    if(isset($_POST['submit'])){
          $image_not_edited=$_POST['edit_image'];
          $video_not_changed=$_POST['edit_video'];
            $pg_id=$_POST['id'];
            $user_id=$_POST['user_id'];
        $title=user_input($_POST['title']);
        $meal=user_input($_POST['meal']);
    	$address= user_input($_POST['address']);
        $description=user_input($_POST['description']);
    	//$locality=user_input($_POST['locality']);
    	$budget=user_input($_POST['budget']);
        $landmark=user_input($_POST['landmark']);
    	$contact=user_input($_POST['contact']);
        $locality=user_input($_POST['locality']);
        $status=user_input($_POST['status']);
        $region=$_POST['region'];
        $district=$_POST['district'];




if(!empty($_FILES["image"]["name"] && $_FILES["video"]["name"]) )
		{
			$uploadedfilename= $_FILES["image"]["name"];
			$uploadedfiletempname=$_FILES["image"]["tmp_name"];
			$uploadedfile_type=$_FILES["image"]["type"];
			$fileextension=GetImageExt($uploadedfile_type);
			$imagenewname= date("dd-mm-yy")."-".time().$fileextension;
			$target_path="images/pgs/".$imagenewname;
      //for video
      $target_dir = "videos/";
      $target_video = $target_dir . basename($_FILES["video"]["name"]);
      $uploadedvideo_type = pathinfo($target_video,PATHINFO_EXTENSION);
      $uploadedvideotmpname=$_FILES["video"]["tmp_name"];
			if(move_uploaded_file($uploadedfiletempname, $target_path) && move_uploaded_file($uploadedvideotmpname,$target_video))
			{

          $sql= "UPDATE tbl_pg SET user_id= '$user_id',pg_title= '$title' , address= '$address' , pg_description='$description',budget_per_month='$budget' , contact='$contact', img='$target_path',video='$target_video',meal_type='$meal',district_id='$district',landmark='$landmark',
          locality_id='$locality', region_id='$region',status='$status',updated_at=now()
          WHERE id ='$pg_id'";
          $message= mysqli_query($con,$sql);
                $message=mysqli_query($con,$sql);
                if($message)
   			          {
                        //$pg_id=mysqli_insert_id($con);
                        //echo"$res_id";
                        //define('myConstant',"$res_id");
                        // echo"myConstant";

                    $pr="DELETE FROM tbl_pgrules where pg_id='$pg_id'";

                    $result_= mysqli_query($con,$pr);
                    if($result_){
                        $rule=$_POST['rules'];
                        // $length=sizeof($asset);
                    foreach($rule as $rule_id)
                    {
                            //echo"$asset_id <br>";
                            //$asset_id = mysqli_real_escape_string($asset_id);
                            $second_query="INSERT INTO  tbl_pgrules(pg_id,rule_id) values($pg_id,$rule_id)";
                            $ms=mysqli_query($con,$second_query);
                        if($ms==1)
                        {
                            //echo"$res_id<br>";
                            $flag=true;
                        }
                        else
                            {
                                $flag=false;
                            }
				        //$msg= mysqli_query($con,$table);
                        }
                    }
                        $pf="DELETE FROM tbl_pgfacility where pg_id='$pg_id'";
                         $result= mysqli_query($con,$pf);
                            if($result){
                      $facility=$_POST['facilities'];
		      // $length=sizeof($asset); foreach($facility as $facility_id)

                //echo"$asset_id <br>";
                //$asset_id = mysqli_real_escape_string($asset_id);
                      foreach($facility as $facility_id)
                    {
                            $second_query_="INSERT INTO  tbl_pgfacility(pg_id,facility_id) values($pg_id,$facility_id)";
                            $ms_=mysqli_query($con,$second_query_);
                        if($ms_==1)
                        {
                        //echo"$res_id<br>";
                            $flag=true;
                        }
                        else
                        {
                            $flag=false;
                        }
				                    //$msg= mysqli_query($con,$table);
                    }
                            }


                                /* for($ast[0]; $ast<=$length; $ast++)
				{
                $table="insert into tbl_resource_asset(room_id,asset_id) values ('$res_id','$ast')";
				 mysqli_query($con,$table);
				}*/

			echo"<h3 class='tit7 t-center p-b-62 p-t-105'>
       successfully updated
        </h3>";
  			}
				else
   			{
                      //echo "error in input  ".$sql.$con->error;
			//echo "$con.$sql->error";
       		echo'<script>alert("Failed To update")</script>';
   			}
		}else{
                	echo'<script>alert("Failed To move image to server ")</script>';
            }
}
else
	{

          $sql= "UPDATE tbl_pg SET user_id= '$user_id' , pg_title= '$title' , address= '$address' , pg_description='$description',budget_per_month='$budget' , contact='$contact', img='$image_not_edited',video='$video_not_changed',meal_type='$meal',district_id='$district',landmark='$landmark',locality_id='$locality',region_id='$region',status='$status',updated_at=now()
          WHERE id='$pg_id'";
        //  $message= mysqli_quer

	  $message= mysqli_query($con,$sql);

    if($message)
    {

         //$pg_id=mysqli_insert_id($con);
                    //echo"$res_id";
                //define('myConstant',"$res_id");
               // echo"myConstant";

                    $pr="DELETE FROM tbl_pgrules where pg_id='$pg_id'";

                    $result_= mysqli_query($con,$pr);
                    if($result_){
                        $rule=$_POST['rules'];
                        // $length=sizeof($asset);
                    foreach($rule as $rule_id)
                    {
                            //echo"$asset_id <br>";
                            //$asset_id = mysqli_real_escape_string($asset_id);
                            $second_query="INSERT INTO  tbl_pgrules(pg_id,rule_id) values($pg_id,$rule_id)";
                            $ms=mysqli_query($con,$second_query);
                        if($ms==1)
                        {
                            //echo"$res_id<br>";
                            $flag=true;
                        }
                        else
                            {
                                $flag=false;
                            }
				        //$msg= mysqli_query($con,$table);
                        }
                    }
                        $pf="DELETE FROM tbl_pgfacility where pg_id='$pg_id'";
                         $result= mysqli_query($con,$pf);
                            if($result){
                      $facility=$_POST['facilities'];
		      // $length=sizeof($asset); foreach($facility as $facility_id)

                //echo"$asset_id <br>";
                //$asset_id = mysqli_real_escape_string($asset_id);
                     foreach($facility as $facility_id)
                    {
                            $second_query_="INSERT INTO  tbl_pgfacility(pg_id,facility_id) values($pg_id,$facility_id)";
                            $ms_=mysqli_query($con,$second_query_);
                        if($ms_==1)
                        {
                        //echo"$res_id<br>";
                            $flag=true;
                        }
                        else
                        {
                            $flag=false;
                        }
				    //$msg= mysqli_query($con,$table);
                    }


                                /* for($ast[0]; $ast<=$length; $ast++)
				{
                $table="insert into tbl_resource_asset(room_id,asset_id) values ('$res_id','$ast')";
				 mysqli_query($con,$table);
				}*/

			echo"<h3 class='tit7 t-center p-b-62 p-t-105'>
        successfully updated
        </h3>";


    }
    }
    else
    {
      echo "error in input  ".$sql.$con->error;
    }
    }
}












?>
<?php include ("script.php");?>

<?php include ("_pgform.php"); ?>




<?php include ("footer.php");?>
