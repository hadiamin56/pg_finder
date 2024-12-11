<?php
   
    include('db_conn.php'); 
     //session_start();// Starting Session
    // Storing Session
    $user_check=$_SESSION['login_user'];
    // SQL Query To Fetch Complete Information Of User
    $ses_sql="select name from user where email='$user_check'";

   $result= mysqli_query($con,$ses_sql);
      if(mysqli_num_rows($result)>0)
        {
           
            $row = mysqli_fetch_assoc($result);
            $login_session =$row['name'];
          
        }
  
?>
