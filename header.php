<?php
    session_start();
include "config.php";
 include('db_conn.php');
?>
<html>

	<title>Home</title>
	<meta charset="UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/themify/themify-icons.css">
  <!--===============================================================================================-->
  <!--link rel="stylesheet" type="text/css" href="vendor/animate/animate.css"-->
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/lightbox2/css/lightbox.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <head>
    <style>
  body {font-family: Arial, Helvetica, sans-serif;}
  * {box-sizing: border-box;}

  .input-container {
    display: -ms-flexbox; /* IE10 */
    display: flex;
    width: 100%;
    margin-bottom: 15px;
  }

  .icon {
    padding: 10px;
    background: dodgerblue;
    color: white;
    min-width: 50px;
    text-align: center;
  }

  .input-field {
    width: 100%;
    padding: 10px;
    outline: none;
  }

  .input-field:focus {
    border: 2px solid dodgerblue;
  }

  /* Set a style for the submit button */
  .btn {
    background-color: dodgerblue;
    color: white;
    padding: 100px 20px;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
  }

  .btn:hover {
    opacity: 1;
  }
  </style>
</head>
<body class="">

	<!-- Header -->
	<header>
		<!-- Header desktop -->
		<div class="wrap-menu-header gradient1 trans-0-4">
			<div class="container h-full ">
				<div class="wrap_header trans-0-3">
					<!-- Logo -->

					<!-- Menu -->

						<nav class="menu" >
							<ul class="main_menu" >

                <li>



                </li>
								<li>
                  <a href="/pg/index.php" > <font size='4px' color='black' ><i class='fa fa-home'>&nbsp;&nbsp;Home</i></font></a>
                	</li>
                                	<li>
                                    <a href="/pg/list_pg.php" > <font size='4px'color='black'  ><i class='fa fa-upload'>&nbsp;&nbsp;list your pg</i></font></a>
								</li>
                <li>
                  <a href="/pg/pgs.php" > <font size='4px' color='black' ><i class='fa fa-th-list'>&nbsp;&nbsp;pg list</i></font></a>
                </li>
                                <?php
                                    if(isset($_SESSION["user"])){



                            $user_id=$_SESSION["user_id"];
                        // echo"<b>$user_id</b>";
                     $sql_query="SELECT * FROM tbl_user WHERE id=$user_id";
                    $result= mysqli_query($con, $sql_query);

                   if(mysqli_num_rows($result)>0)
                   {

                     while ($row=mysqli_fetch_assoc($result))
                     {
                    echo"

                    <li>
                    <a href='/pg/profile.php' > <font size='4px' color='red'  ><i class='fa fa-user'>&nbsp;&nbsp;$row[name]</i></font></a>

                             </li>";
                     }
                   }
                                        echo"<li>
                                        <a href='/pg/logout.php'> <font size='4px' color='black'  ><i class='fa fa-chevron-circle-right'>&nbsp;&nbsp;Logout</i></font></a>

								            </li>";

                                    }
                                else{
                                       echo"<li>
									           <a href='/pg/signup.php'> <font size='4px' color='black'  ><i class='glyphicon glyphicon-arrow-up'>Signup</i> </font> </a>
								            </li>
                                            <li>
									           <a href='/pg/login.php'><font size='4px' color='black'> <b><i class='glyphicon glyphicon-arrow-DOWN'>LOGIN</i></b></font> </a>
								            </li>";
                                }

                                if(isset($_SESSION["user"]) && $_SESSION["user_type"]==1){
                           echo"
                                   <li><a href='/pg/admin/user/index.php'> <font size='4px' color='black' >Admin</font></a></li>

                                <font face='blue'>  <button class='btn-show-sidebar  trans-0-4'></button></font>
                                  </ul>
                                 </div>";




                                ?>
								<!--li>
									<a href="menu.html">Menu</a>
								</li>

								<li>
									<a href="reservation.html">Reservation</a>
								</li>

								<li>
									<a href="gallery.html">Gallery</a>
								</li>

								<li>
									<a href="about.html">About</a>
								</li-->




						</nav>
					</div>

					<!-- Social -->
				<?php
                                                    }
                    ?>

				</div>
			</div>
		</div>

		<!-- Sidebar -->
	<aside class="sidebar trans-0-4">
		<!-- Button Hide sidebar -->
		<button class="btn-hide-sidebar ti-close color0-hov trans-0-4"></button>

		<!-- - -->
		<ul class="menu-sidebar p-t-95 p-b-70">
            <li class="t-center m-b-13">
				<!-- Button3 -->
				<a href="/pg/admin/region/" class="txt19">
					Region
				</a>
			</li>
			<li class="t-center m-b-13">
				<a href="/pg/admin/district/index.php" class="txt19">District</a>
			</li>
            	<li class="t-center m-b-13">
				<a href="/pg/admin/locality/index.php" class="txt19">Locality</a>
			</li>
            <li class="t-center m-b-13">
				<a href="/pg/admin/facility/index.php" class="txt19">PG Facility</a>
			</li>
               <li class="t-center m-b-13">
				<a href="/pg/admin/rule/index.php" class="txt19">PG Rules</a>
			</li>
             <li class="t-center m-b-13">
				<a href="/pg/admin/pg/index.php" class="txt19">Pg's</a>
			</li>
               <li class="t-center m-b-13">
				<a href="/pg/admin/user/index.php" class="txt19">Users</a>
			</li>




		</ul>

		<!-- - -->
		<div class="gallery-sidebar t-center p-l-60 p-r-60 p-b-40">

		</div>
	</aside>
