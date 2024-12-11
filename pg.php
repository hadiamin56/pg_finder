
<style>
    body {
      margin: 20px;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
      text-align: left;
    }
  </style>
<?php
  include('header.php');

if(!isset($_SESSION["user"]))
    {
       // mysql_close($connection); // Closing Connection
       // header('Location: login.php'); // Redirecting To Home Page
      echo"<script>location.replace('login.php')</script>";
    }

    $id= isset($_GET['id'])? $_GET['id']: '';
     if(isset($_SESSION["user_id"])){
                      $user_id=$_SESSION["user_id"];
                  }

    if(isset($_POST['post_comment']))
    {
       // $user_id=$_POST["user"];
        $comment=$_POST["comment"];
        //$user_id=$user_id;
        $pg_id=$id;


        $sql_insert="INSERT INTO tbl_comments(user_id,pg_id,comment) VALUES('$user_id','$pg_id','$comment')";
        $sql_result=mysqli_query($con,$sql_insert);
        if($sql_result){
            //echo"comment Added";

        }
    }

  $id= isset($_GET['id'])? $_GET['id']: '';
$select_query="select tbl_pg.*,tbl_user.name,tbl_region.name AS 'rname',tbl_locality.name AS 'lname',tbl_district.name AS 'dname' from
	(
      (  ((tbl_pg
	inner join tbl_user on tbl_pg.user_id=tbl_user.id)

	  inner join tbl_region on tbl_pg.region_id=tbl_region.id)
        inner join tbl_locality on tbl_pg.locality_id=tbl_locality.id)
       inner join tbl_district on tbl_pg.district_id=tbl_district.id)

	  where tbl_pg.id='$id'";
   $result= mysqli_query($con, $select_query);
            $row= $result->fetch_array();
        $locality=$row['locality_id'];




/*echo"<section class='bg-title-page flex-c-m p-t-160 p-b-80 p-l-15 p-r-15' style='background-image: url($row[img]);'>
		<h2 class='tit6 t-center'>
		$row[pg_title]
		</h2>
	</section>";*/
         ?>


<br>
<br><br>
<br><br>
<br>

        <div class="container">
		<div class="bread-crumb bo5-b p-t-17 p-b-17">
			<div class="container">
				<a href="/pg/index.php" class="txt27">
					Home
				</a>
                <span class="txt29 m-l-10 m-r-10">/</span>

				<span class="txt29">
					<?php echo $row['pg_title'] ;?>
				</span>
			</div>
		</div>


			<div class="row ">
				<div class="col-md-8 col-lg-9">
					<div class="p-t-80 p-b-124 bo5-r p-r-50 h-full p-r-0-md bo-none-md">
						<!-- Block4 -->
						<div class="blo4 p-b-63">
							<!-- - -->
							<div class="pic-blo4 hov-img-zoom bo-rad-10 pos-relative">
								<a href="#">
									<img src="<?php echo $row['img'] ;?>" alt="IMG-BLOG">
								</a>

								<div class="date-blo4 flex-col-c-m">
									<span class="txt25 m-b-4">
										<?php echo $row['budget_per_month'] ;?>
									</span>

									<span class="txt25">
										<b>per, month</b>
									</span>
								</div>
							</div>

							<!-- - -->
							<div class="text-blo4 p-t-33">
								<h4 class="p-b-16">
									<a href="#" class="tit9"><?php echo $row['pg_title'] ;?>

                  </a>
								</h4>

								<div class="txt32 flex-w p-b-24">
                                    <span>
										By: <?php echo $row['name'] ;?>
										<span class="m-r-6 m-l-4">|</span>
									</span>

									<span>
										Address: <?php echo $row['address'] ;?>
										<span class="m-r-6 m-l-4">|</span>
									</span>

									<span>
										Locality :<?php echo $row['lname'];?>
										<span class="m-r-6 m-l-4">|</span>
									</span>

									<span>
										District: <?php echo $row['dname'];?>
										<span class="m-r-6 m-l-4">|</span>
									</span>

									<span>
										Region :  <?php echo $row['rname'];?>
                                        	<span class="m-r-6 m-l-4">|</span>
									</span>
                                    	<span>
										Meal type :  <?php    foreach ($m_array as $key => $value) {
					$meal=$row['meal_type'];
					if($key==$meal)
					echo " $value ";

				} ?>
                                        	<span class="m-r-6 m-l-4">|</span>
									</span>
                                       <span>
										Whatsapp owner :  <a href="https://api.whatsapp.com/send?phone=<?php echo $row['contact'];?>" target="_blank"><i class="fa fa-whatsapp  "></i></a>
									</span>

								</div>
                                <div class="row">
								    <p align="justify">
									   <?php echo $row['pg_description'];?>
								    </p>
                                </div>  <h4 class="p-b-16">

								    </h4>
                                    <?php
                            $sql="select tbl_comments.*,tbl_user.name from
	                               tbl_comments inner join tbl_user on tbl_comments.user_id where tbl_comments.user_id=tbl_user.id AND  tbl_comments.pg_id='$id'";
                            $out=mysqli_query($con,$sql);
                        if(mysqli_num_rows($out)>0){
                                $number=1;
                                while($comm=mysqli_fetch_assoc($out)){
                                    echo"$number.<span class='txt32 flex-w p-b-24'> $comm[name]:&nbsp; &nbsp;$comm[comment] <br></span> ";
                                    $number++;
                            }
                        }

                                        ?>
						<!-- Leave a comment -->
						<form action="" method="post" class="leave-comment p-t-10">

							<textarea class="bo-rad-10 size29 bo2 txt10 p-l-20 p-t-15 m-b-10 m-t-40" name="comment" placeholder="Comment..." required></textarea>
							<!-- Button3 -->
							<input type="submit" name="post_comment" value="Post Comment" class="btn3 flex-c-m size31 txt11 trans-0-4">


						</form>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-4 col-lg-3">
					<div class="sidebar2 p-t-80 p-b-80 p-l-20 p-l-0-md p-t-0-md">
						<!-- Search
						<div class="search-sidebar2 size12 bo2 pos-relative">
							<input class="input-search-sidebar2 txt10 p-l-20 p-r-55" type="text" name="search" placeholder="Search">
							<button class="btn-search-sidebar2 flex-c-m ti-search trans-0-4"></button>
						</div-->

						<!-- Categories -->
						<div class="categories">
              <h4 class="txt33 bo5-b p-b-35 p-t-58">
                Video
              </h4>
              <video width="300" height="200" controls>
                    <source src="<?php echo $row['video']; ?>"  >
              </video>
							<h4 class="txt33 bo5-b p-b-35 p-t-58">
								Facilities
							</h4>

							<ul>
                                <?php $facility="SELECT tbl_pgfacility.*,tbl_facilite.* FROM tbl_pgfacility INNER JOIN   tbl_facilite ON tbl_pgfacility.facility_id WHERE tbl_pgfacility.facility_id=tbl_facilite.id AND tbl_pgfacility.pg_id='$id' ";
                                 $result= mysqli_query($con,$facility);
                        if(mysqli_num_rows($result)>0)
                        {

                            while ($row=mysqli_fetch_assoc($result))
                            {

								echo"<li class='bo5-b p-t-8 p-b-8'>";
                                   if(empty($row['facility_icon'])){
                                   echo" <i class='fa fa-check'></i>";
                                   }else{
                                     echo" <i class='fa fa-$row[facility_icon]'></i>";
                                }
									echo"<a href='#' class='txt27'>
										$row[facility_name]
									</a>
								</li>";

								}
                                }
                                 ?>
							</ul>


							<h4 class="txt33 bo5-b p-b-35 p-t-58">
								Rules
							</h4>

							<ul>
                                <?php $facility="SELECT tbl_pgrules.*,tbl_rule.* FROM tbl_pgrules INNER JOIN   tbl_rule ON tbl_pgrules.rule_id WHERE tbl_pgrules.rule_id=tbl_rule.id AND tbl_pgrules.pg_id='$id' ";
                                 $result= mysqli_query($con, $facility);
                        if(mysqli_num_rows($result)>0)
                        {

                            while ($row=mysqli_fetch_assoc($result))
                            {

								echo"<li class='bo5-b p-t-8 p-b-8'>
                                   <i class='fa fa-check'></i>

                              <a href='#' class='txt27'>
										$row[name]
									</a>
								</li>";

								}
                                }
                                 ?>
							</ul>
						</div>

						<!-- Most Popular -->
						<div class="popular">


							<ul>
                            <?php

                                $nearby= "SELECT * FROM tbl_pg WHERE locality_id= '$locality'";
                                 $result= mysqli_query($con, $nearby);
                        if(mysqli_num_rows($result)>0)
                        {
                            echo"<h4 class='txt33 p-b-35 p-t-58'>
								Near by Pg's
							</h4>";
                            while ($row=mysqli_fetch_assoc($result))
                            {


                                echo"
								<li class='flex-w m-b-25'>
									<div class='size16 bo-rad-10 wrap-pic-w of-hidden m-r-18'>
										<a href='pg.php?id=".$row['id']."' >
											<img src='$row[img]'>
										</a>
									</div>

									<div class='size28'>
										<a href='#' class='dis-block txt28 m-b-8'>
										$row[pg_title]
										</a>

										<span class='txt14'>
												Rs $row[budget_per_month]
										</span>
									</div>
								</li>";
                            }}

?>






							</ul>




<?php

include 'script.php';

?>
