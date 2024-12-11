<?php
include('header.php');


?>


<div >
        <b><h3 class="tit9 t-center p-b-62 p-t-200">
           login
        </h3><b>
    <center >
     <form action="" method="post"  style="max-width:500px;margin:auto; ">

        <div class="input-container">
          <i class="fa fa-envelope icon"></i>
          <input class="input-field" type="email" placeholder="email" name="email">
        </div>
<br>
<br>

        <div class="input-container">
          <i class="fa fa-key icon"></i>
          <input class="input-field" type="password" placeholder="password" name="password">
        </div>


<br>



                <input type="submit" name="submit" id="submit" value="LOGIN" class="btn">






            </form>
        </center>

</div>

<?php
       // session_start(); // Starting Session
        $error=''; // Variable To Store Error Message
        include('db_conn.php');
    if (isset($_POST['submit']))
    {

            // Define $username and $password
            $username=$_POST['email'];
            $password=$_POST['password'];
          //  $username = stripslashes($username);
          //  $password = stripslashes($password);

            // SQL query to fetch information of registerd users and finds user match.
            $query = "select * from tbl_user where 	encrypted_passowrd='$password' AND email='$username'";
            $result= mysqli_query($con,$query);
            if(mysqli_num_rows($result)>0)
                            {
                                $rows = mysqli_fetch_assoc($result);
                                $_SESSION["user"]=$rows['name'];
                                $_SESSION["user_id"]=$rows['id'];
                                $_SESSION["user_type"]=$rows['user_type'];// Initializing Session
                               // header("location: profile.php"); // Redirecting To Other Page
                           echo"<script>location.replace('profile.php')</script>";
                         }
        else
                {

                  echo "
                     <h3 class='tit7 t-center p-b-62 p-t-30'>
                     email password doesnt match
                     </h3>";
                //$error ="Username or Password is invalid";



                //echo $error;
              //  echo"<br><center class='txt20'>".$error."</center>";
            }
              //  mysql_close($connection); // Closing Connection

            }
include 'script.php';
        ?>
