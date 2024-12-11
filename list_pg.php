<?php
    include('header.php');
 if(!isset($_SESSION["user"]))
    {
       // mysql_close($connection); // Closing Connection
       // header('Location: login.php'); // Redirecting To Home Page
      echo"<script>location.replace('login.php')</script>";
    }
?>
<?php

   $flag="";
if(isset($_POST['submit']))
{
        if(isset($_SESSION["user_id"])){
                      $user_id=$_SESSION["user_id"];
                  }

    	$title=user_input($_POST['title']);
    	$meal=user_input($_POST['meal']);
    	$address= user_input($_POST['address']);
        $description=user_input($_POST['description']);
    	//$locality=user_input($_POST['locality']);
    	$budget=user_input($_POST['budget']);
        $landmark=user_input($_POST['landmark']);
    	$contact=user_input($_POST['contact']);
        $locality=user_input($_POST['locality']);
        $region=$_POST['region'];
        $district=$_POST['district'];
    /*	$find_district="SELECT district_id FROM tbl_locality WHERE id='$locality'";
          $result_query= mysqli_query($con,$find_district);
            if(mysqli_num_rows($result_query)>0)
                            {
                                $data = mysqli_fetch_assoc($result_query);
                               $district=$data['district_id'];
                         }
    $find_region="SELECT region_id FROM tbl_district WHERE id='$district'";
          $result_query_= mysqli_query($con,$find_region);
            if(mysqli_num_rows($result_query_)>0)
                            {
                                $data_ = mysqli_fetch_assoc($result_query_);
                               $region=$data_['region_id'];
                         }*/

    	//$image = implode(',', $_POST['image']);
		//$assets = implode(',', $_POST['asset']);



if(!empty($_FILES["image"]["name"] && $_FILES["video"]["name"])  )
		{
      //for images
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

    //  $uploadedvideoname= $_FILES["video"]["name"];

      //$uploadedvideo_type=$_FILES["video"]["type"];
      //$videoextension=GetImageExt($uploadedvideo_type);
      //$videonewname= date("dd-mm-yy")."-".time().$videoextension;
      //$target_path_video="videos/".$videonewname;

			if(move_uploaded_file($uploadedfiletempname, $target_path) && move_uploaded_file($uploadedvideotmpname,$target_video))
			{
                $sql= "INSERT INTO tbl_pg(pg_title,address,budget_per_month,
                contact,created_at,district_id,img,pg_description,landmark,locality_id,region_id,user_id,status,meal_type,video) VALUES('$title', '$address', '$budget', '$contact',now(), '$district','$target_path','$description','$landmark','$locality','$region','$user_id','2','$meal','$target_video')";
                $message=mysqli_query($con,$sql);
                if($message)
   			  {
                $pg_id=mysqli_insert_id($con);
                    //echo"$res_id";
                //define('myConstant',"$res_id");
               // echo"myConstant";
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
                      $facility=$_POST['facilities'];
		      // $length=sizeof($asset);
                foreach($facility as $facility_id)
                {
                //echo"$asset_id <br>";
                //$asset_id = mysqli_real_escape_string($asset_id);
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
                    } /* for($ast[0]; $ast<=$length; $ast++)
				{
                $table="insert into tbl_resource_asset(room_id,asset_id) values ('$res_id','$ast')";
				 mysqli_query($con,$table);
				}*/

			echo"<h3 class='tit7 t-center p-b-62 p-t-105'>
          Your PG will be Listed after Admin Approval
        </h3>";
  			}
				else
   			{
                      echo $sql.$con->error;
			//echo "$con.$sql->error";
       		echo'<script>alert("Failed To Insert")</script>';
   			}
		}
}
else
	{
		echo '<script>alert("Choose a file to upload")</script>'; }
}




?>
<?php
        include 'script.php';
      include "_pgform.php";
      // include "script.php";
      echo"<br>";
      include "footer.php";

?>
