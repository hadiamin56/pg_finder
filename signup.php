 <?php
  include('header.php');

    $password_error=$email_error="";

    include('db_conn.php');

    if(isset($_POST["submit"])){
// echo"$_FILES['image'][name]" ;
          //$uploadedfilename=$_FILES['images']["name"];
        //echo"$uploadedfilename";
        $flag=true;
        $name=$_POST["name"];
        $email=$_POST["email"];
        $password=$_POST["password"];
        $c_password=$_POST["confirm_password"];

        if($password!=$c_password){
            $flag=false;
        }

        $gender=$_POST["gender"];
        $contact=$_POST["contact"];
        $query = "select * from tbl_user where  email='$email'";
        $output= mysqli_query($con,$query);
        $rows = mysqli_num_rows($output);
            if ($rows == 1){
                $email_error="Account alredy exist";
                echo"<center class='txt9'><h1>Signup Failed</h1></center>";
            }
        else if(!$flag){
            $password_error="Password and Confirm password does not match";
             echo"<center class='txt9'><h1>Signup Failed</h1></center>";
        }
        else{
              if(!empty($_FILES["images"]["name"]))
                  {
                    $uploadedfilename=$_FILES["images"]["name"];
                    $uploadedfiletemporaryname=$_FILES["images"]["tmp_name"];
                    $uploadedfile_type=$_FILES["images"]["type"];
                    $fileextension=GetImageExt($uploadedfile_type);
                    $imagenewname=date("d-m-y")."-".time().$fileextension;
                    $target_path="images/users/".$imagenewname;
                    if(move_uploaded_file($uploadedfiletemporaryname,$target_path))
                    {
                      if(!empty($name & $email & $contact & $gender & $password))
                      {

                                $sql_query="INSERT INTO tbl_user(name,email,encrypted_passowrd,user_type,created_at,contact,gender,image) VALUES('$name','$email','$password','2',now(),'$contact','$gender','$target_path')";
                                $result=mysqli_query($con,$sql_query);
                          if($result)
                          {
                              $query_ = "select * from tbl_user where  email='$email'";
                                $output_= mysqli_query($con,$query_);
                         if(mysqli_num_rows($output_)>0)
                            {
                                $rows_ = mysqli_fetch_assoc($output_);
                                $_SESSION["user"]=$rows_['name'];
                                $_SESSION["user_id"]=$rows_['id'];
                                $_SESSION["user_type"]=$rows_['user_type'];// Initializing Session
                               // header("location: profile.php"); // Redirecting To Other Page
                                echo"<script>location.replace('profile.php')</script>";
                         }
           }
	       else
	       {
                // echo "error in input  ".$sql.$con->error;
             //echo"<center class='txt9'><h1>Signup del</h1></center>".$sql_query.$con->error;
     //.$sql_query.$con->error;
	       }

                      }
                    }
                    else
                    {
                      exit("error while uploading image to server");
                    }
                }
                else{
                  echo "image cant be empty";
                }

        }


    }

?>

<head>
    <title>Signup </title>

</head>

<body>
<div style="background-color:grey; position:relative; top:10px; height:100%;">
    <div class="container" >
        <h3 class="tit7 t-center p-b-62 p-t-105">
          <br>
          <br><b>Signup For Free </b>
        </h3>

        <form action="signup.php" method="POST" enctype="multipart/form-data" class="wrap-form-reservation size22 m-l-r-auto">
            <div class="row">
              <div class="input-container">
                <i class="fa fa-user icon"></i>
                <input class="input-field" type="text" placeholder="name" name="name" required>
              </div>
              <div class="input-container">
                <i class="fa fa-envelope icon"></i>
                <input class="input-field" type="email" placeholder="email" name="email" required>
              </div>




              <div class="input-container">
                <i class="fa fa-key icon"></i>
                <input class="input-field" type="password" placeholder="password" name="password" required>
              </div>

              <div class="input-container">
                <i class="fa fa-key icon"></i>
                <input class="input-field" type="password" placeholder="confirm password" name="confirm_password" required>
              </div>
              <div class="input-container">
                <i class="fa fa-address-card icon"></i>
                <input class="input-field" type="text" placeholder="phone number" name="contact" required>
              </div>


                    <!-- Email -->


                    <div class="input-container">
                      <i class="fa fa-group icon"></i>
                        <select name="gender"  class="input-field" required>
                            <?php
		 						foreach($g_array as $key=> $value)
		 							{
		 								$selected = (($status== $key)? "selected" : "") ;
		 								echo "<option value= '$key' $selected> $value </option>";
		 							}
		 					?>
                        </select>

</div>
          <div class="input-container">
            <i class="fa fa-file-image-o icon"></i>
              <input type="file" name="images" class="input-field" id="files" placeholder="Images" required style="display:none;">
              <label for="files">&nbsp;&nbsp;choose a profile picture</label>
          </div>

        <div class="input-container">
              <input type="submit" name="submit" id="submit" value="Sign Up" class="btn">&nbsp;&nbsp;
  <a href="login.php" class="btn">Login</a>
          </div>


          <br>

                    </div>
                </div>


            </div>




            <br>








        </form>



    </div>
</div>
</div>

</body>

<?php

include 'script.php';
include 'footer.php';
?>
<script>
    $(function() {
        $('#c_password').change(function() {
            //alert('Hi');
            var password = document.getElementsById("password").value;
            var c_password = document.getElementById("c_password").value;
            if (password != c_password) {

                $("#submit").attr("readonly", "true");
                alert("password doesnt match");
            }

            //var $form = $(this).closest('form');
            //$form.find('input[type=submit]').click();
        });
    });
</script>

</html>
