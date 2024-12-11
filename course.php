		<?php
		include('header.php');
		include 'script.php';
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
				$course_id=$id;
				$sql_insert="INSERT INTO course_comments(user_id,course_id,comment) VALUES('$user_id','$course_id','$comment')";
				$sql_result=mysqli_query($con,$sql_insert);
				if($sql_result){
					echo"comment Added";
				}
			}
		  // post recomendation code
		 if(isset($_POST['recomend']))
			{
				$student=$_POST["student_id"];
				//$user_id=$user_id;
				$course_id=$id;
				$mentor_id=$user_id;
				$sql_insert_="INSERT INTO recomendation(mentor_id,course_id,student_id) VALUES('$mentor_id','$course_id','$student')";
				$sql_result_=mysqli_query($con,$sql_insert_);
				if($sql_result_){
					echo" <br><br><center><h4>Course Recommended</h4><center> ";
				}
			 else{
				 echo"failed".mysqli_query($con);
			 }
			}
			  // post recomendation code ends here
			$select_query="SELECT * from courses WHERE id=$id";
		   $result= mysqli_query($con, $select_query);
					$row= $result->fetch_array();
							 if(isset($_POST['addtowishlist']))
							 {
								   $course_id= $_POST['id'];
							   $query = "select * from wishlist where  course_id='$course_id' AND user_id='$user_id'";
								 $output= mysqli_query($con,$query);
								 $rows = mysqli_num_rows($output);
								 if ($rows == 1){
									 echo"<center><strong>Course already exist in your wish list</strong></center>";
								  }
								 else{
								   $q= "INSERT INTO wishlist(course_id,user_id)VALUES('$course_id',$user_id)";
								   $r= mysqli_query($con, $q);
								 if($r)
								   echo "<h3 class='tit7 t-center p-b-62 p-t-105'>
										added to wishlist
										</h3>";
								else
									   echo "<h3 class='tit7 t-center p-b-62 p-t-105'> problem in creaing wishlist </h3>";
								}
							 }
		?>
		<style>
		.content{
	border: 0px solid black;
	border-radius: 3px;
	padding: 5px;
	margin: 0 auto;
	width: 50%;
}

.post{
	border-bottom: 1px solid black;
	padding: 10px;
	margin-top: 10px;
	margin-bottom: 10px;
}
.post:last-child{
	border: 0;
}

.post h1{
	font-weight: normal;
	font-size: 30px;
}

.post a.link{
	text-decoration: none;
	color: black;
}
.post-text{
	letter-spacing: 1px;
	font-size: 15px;
	font-family: serif;
	color: gray;
	text-align: justify;
}
.post-action{
	margin-top: 15px;
	margin-bottom: 15px;
}

.like,.unlike{
	border: 0;
	background: none;
	letter-spacing: 1px;
	color: lightseagreen;
}

.like,.unlike:hover{
	cursor: pointer;
}


/* media query */
@media (max-width: 800px){
	.content{
			width: 95%;
	}
}



		</style>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/fontawesome-stars-o.min.css">
			<link href='jquery-bar-rating-master/dist/themes/fontawesome-stars-o.css' rel='stylesheet' type='text/css'>

			<!-- Script -->
			<script src="jquery-3.0.0.js" type="text/javascript"></script>
			<script src="jquery-bar-rating-master/dist/jquery.barrating.min.js" type="text/javascript"></script>

			<script type="text/javascript">
			$(function() {
					$('.rating').barrating({
							theme: 'fontawesome-stars-o',
							onSelect: function(value, text, event) {
								//alert('hi');

									// Get element id by data-id attribute
									var el = this;
									var el_id = el.$elem.data('id');
								//	alert(el_id);
								//	$(this).data("id");
									// rating was selected by a user
									if (typeof(event) !== 'undefined') {


											var split_id = el_id.split("_");


										  var courseId = split_id[1];
											  // postid
										//	alert(courseId);
											// AJAX Request


												$.ajax({

														url: "rating_ajax.php",
														type: "POST",
														data: {courseId:courseId,rating:value},
														dataType: "json",
														success: function(data){
															 $('#avgrating_'+courseId).html(data);
																// Update average
																	//alert(courseId);
																var average = data['averageRating'];
																$('#avgrating_'+courseId).text(average);
														}
												});

									}
							}
					});
			});


						</script>

	<!-- Main menu -->
	<section class="section-mainmenu p-t-110 p-b-70 bg1-pattern">
		<div class="container">
		<h3 class="tit-mainmenu tit10 p-b-25">
							<?php  echo"$row[course_name]"; ?>
						</h3>
						<h6> <?php  echo"$row[offered_by]"; ?> ( <?php  echo"$row[field]"; ?> )</h6><hr>
			<div class="row">
				<div class="col-md-10 col-lg-6 p-r-35 p-r-15-lg m-l-r-auto">
					<div class="wrap-item-mainmenu p-b-22">
						<?php  if (!empty($row['effort_per_week'])) {
									# code...
								 ?>
						<div class="item-mainmenu m-b-36">
							<div class="flex-w flex-b m-b-3">

								<a href="#" class="name-item-mainmenu txt21">
									Effort
								</a>
								<div class="line-item-mainmenu bg3-pattern"></div>
								<div class="price-item-mainmenu txt22">
									<?php echo"$row[effort_per_week]"; ?>
								</div>
							</div>
						</div>
						<?php } ?>
						<div class="item-mainmenu m-b-36">
							<?php if (!empty($row['price'])) {
									# code...
								 ?>
							<div class="flex-w flex-b m-b-3">

								<a href="#" class="name-item-mainmenu txt21">
									Fee
								</a>
								<div class="line-item-mainmenu bg3-pattern"></div>
								<div class="price-item-mainmenu txt22">
									<?php echo"$row[price]"; ?>
								</div>
							</div>
							<span class="info-item-mainmenu txt23" >
							</span>
							<?php } ?>
						</div>

						<div class="item-mainmenu m-b-36">
							<div class="flex-w flex-b m-b-3">
								<a href="#" class="name-item-mainmenu txt21">
									Course Type
								</a>
								<div class="line-item-mainmenu bg3-pattern"></div>
								<div class="price-item-mainmenu txt22">
									<?php echo"$row[course_type]"; ?>
								</div>
							</div>
							<span class="info-item-mainmenu txt23" >
							</span>
						</div>
					</div>
				</div>
				<div class="col-md-10 col-lg-6 p-l-35 p-l-15-lg m-l-r-auto">
					<div class="wrap-item-mainmenu p-b-22">
					<div class="item-mainmenu m-b-36">
							<div class="flex-w flex-b m-b-3">
								<a href="#" class="name-item-mainmenu txt21">
									Course Duration
								</a>
								<div class="line-item-mainmenu bg3-pattern"></div>
								<div class="price-item-mainmenu txt22">
									<?php echo"$row[length]"; ?>
									</div>
								</div>
								<span class="info-item-mainmenu txt23" >
								</span>
							</div>
								<div class="price-item-mainmenu txt22 t-center">
									<?php echo"$row[start_date]"; ?>
								</div>
								<center>
									<i class="fa fa-clock-o fa-3x " style='color: green;'></i>
								</center>

								<div class="price-item-mainmenu txt22 t-center">
									<?php echo"$row[end_date]"; ?>
								</div>


						<div class="item-mainmenu m-b-36">
							<span class="info-item-mainmenu txt23" >
							</span>
						</div>
					</div>
				</div>
			</div>
						<div class="item-mainmenu m-b-36">
							<h3 class="tit-mainmenu tit10 p-b-25">
								Description
							</h3>
							<span class="info-item-mainmenu txt23" style="font-size: 18px; text-align:justify;">
								<p align="justify"><?php echo"$row[short_description]"; ?></p>
								<p align="justify"><?php echo"$row[course_description]"; ?></p?\>
							</span>
						</div>
						<div class="item-mainmenu m-b-36">
							<?php if (!empty($row['Prerequisites'])) {
								# code...
							?>
							<h3 class="tit-mainmenu tit10 p-b-25">
								Prerequisites
							</h3>
							<span class="info-item-mainmenu txt23" style="font-size: 18px;">
								<?php echo"$row[Prerequisites]"; ?><br>
							</span>
							<?php } ?>
						</div>
						<div class="item-mainmenu m-b-36">
								<?php if (!empty($row['to_learn'])) {
								# code...
							?>
							<h3 class="tit-mainmenu tit10 p-b-25">
								What you will learn
							</h3>
							<span class="info-item-mainmenu txt23" style="font-size: 18px;">
								<?php echo"$row[to_learn]"; ?><br>
							</span>
							<?php  }?>
						</div>
						<div class="item-mainmenu m-b-36">
							<?php if (!empty($row['notes'])) {
								# code...
							?>
							<h3 class="tit-mainmenu tit10 p-b-25">
								Notes
							</h3>
							<span class="info-item-mainmenu txt23" style="font-size: 18px;">
								<?php echo"$row[notes]"; ?><br>
							</span>
							<?php } ?>
						</div>
						<div class="item-mainmenu m-b-36">
							<h3 class="tit-mainmenu tit10 p-b-25">
								Source
							</h3>
							<span class="info-item-mainmenu txt23" style="font-size: 18px;">
								<?php echo"$row[source]"; ?><br>
							</span>
						</div>
						<div class="item-mainmenu m-b-36">
							<h3 class="tit-mainmenu tit10 p-b-25">
								Enroll now<?php echo"<a href='$row[web_link]'  class='btn large   ' >Click here</a>"; ?>
							</h3>
							<span class="info-item-mainmenu txt23" style="font-size: 18px;">
								<br>
							</span>
						</div>
						<hr style="height: 2px; background: green; margin-top:0px;">
						<div class="txt32 flex-w p-b-24">
                                <?php
									if(isset($_POST['removewishlist']))
									{
										$id= $_POST['id'];
										$q= "DELETE from wishlist WHERE course_id= '$id'";
										$r= mysqli_query($con, $q);
									if($r)
										echo "<h6 class='btn large'>
												 Removed
											</h3>";
									else
										echo "<h6 class=''> Can't be Removed </h3>";
									}
									 if(isset($_SESSION["user"])){
														  $user_id=$_SESSION["user_id"];
									}
                                     $flag ="";
										if(isset($_SESSION["user_id"]))  {
											$sql_= "SELECT * FROM wishlist WHERE
											course_id=$row[id] AND
											user_id='$user_id'";
													$result_= mysqli_query($con, $sql_);
													if(mysqli_num_rows($result_)>0)
													{
													$flag=true;
													}
										}
										  if(isset($_SESSION["user_id"]) && !$flag){
											  echo"
											  <div class='col-md-6'>
												<form action='' method='post'>
													<input type='hidden' name='id' value='".$row['id']."'>
													<input type='submit' name='addtowishlist' class='btn large '  value='Add to Wishlist' ></i>
												</form>
												</div>";
										  }
										else
										{
											  echo"<form action='' method='post'>
												<input type='hidden' name='id' value='".$row['id']."'>
												<input type='submit' name='removewishlist' value='Remove From Wishlist' class='btn large '>
										</form>";
										}
								?>
                                &nbsp;
								<!--recomendation form  -->
                                <?php
                                  if($_SESSION["user_type"]==3 ){
                                echo"<input id='a' type='button' class='btn large '  value='Recommend' onclick='showDiv()' >";
                                  }
                               ?>
                                    <div id="welcomeDiv"  style="display:none;" class="answer_list" >
                                           <form action="" method="post" class="wrap-form-reservation size22 m-l-r-auto">
                                               <div class="row">
                                                    <div class="col-md-6">
                                                <!-- Name -->
                                                        <div class="wrap-inputname size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                    		                  <?php
                                                                  $q="select * from user  WHERE user_type='2'";
                                                                  $result=mysqli_query($con,$q);
                                                                  if(mysqli_num_rows($result)>0){
                                                                    echo"<select name='student_id' class='bo-rad-10 sizefull txt10 p-l-20'>";
                                                                    while($row=mysqli_fetch_assoc($result))
                                                                    {
                                                                      $studentid=$row["id"];
                                                                      $name=$row["name"];
                                                                      echo'<option value="'.$studentid.'" >'.$name.'</option>';
                                                                    }
                                                                    echo"</select>";
                                                                  }
                                                                ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="submit" name="recomend"  value="submit" class="btn large">
                                                   </div>
                                               </div>
                                        </form>
                                </div>
                                  <!--recomendation form ends here -->
							</div>
					</div>
			</section>
	<!-- Content page -->
	<section>
		<div class="container">
			<div class="row ">
				<div class="col-md-12 col-lg-6">
					<div class="">
                        <h4 class="p-b-16">
									<a href="" class="tit9">comments</a>
								    </h4>
                                    <?php
											$sql="select course_comments.*,user.name from
											 course_comments inner join user on course_comments.user_id where course_comments.user_id=user.id AND  course_comments.course_id='$id'";
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
									<h5 class="">
										Leave a Comment
									</h5>
									<textarea class="bo-rad-10 size29 bo2 txt10 p-l-20 p-t-15 m-b-10 m-t-40" name="comment" placeholder="Comment..." ></textarea>
									<!-- Button3 -->
									<input type="submit" name="post_comment" value="Post Comment" class="btn large pull-right">
								</form>
							</div>
						</div>
						<!--Ratings-->
					<div class="col-md-12 col-lg-6 pull-right">

						<?php
						// User rating
							$c_id= isset($_GET['id'])? $_GET['id']: '';
							if(isset($_SESSION["user_id"])){
											 $userid=$_SESSION["user_id"];
										 }
										 // User rating
					                     $query = "SELECT * FROM ratings WHERE course_id=".$c_id." and user_id=".$userid;
					                     $userresult = mysqli_query($con,$query) or die(mysqli_error());
					                     $fetchRating = mysqli_fetch_array($userresult);
					                     $rating = $fetchRating['rating'];

					                     // get average
					                     $query = "SELECT ROUND(AVG(rating),1) as averageRating FROM ratings WHERE course_id=".$c_id;
					                     $avgresult = mysqli_query($con,$query) or die(mysqli_error());
					                     $fetchAverage = mysqli_fetch_array($avgresult);
					                     $averageRating = $fetchAverage['averageRating'];

					                     if($averageRating <= 0){
					                         $averageRating = "No rating yet.";
					                     }


						 ?>
						 <div class="post pull-right">
									 <h1><a href='' class='link' target='_blank'></a></h1>
									 <div class="post-text">
										  </div>
									 <div class="post-action">
											 <!-- Rating -->
											 <select class='rating' id='rating_<?php echo $c_id; ?>' data-id='rating_<?php echo $c_id; ?>'>
													 <option value="1" >1</option>
													 <option value="2" >2</option>
													 <option value="3" >3</option>
													 <option value="4" >4</option>
													 <option value="5" >5</option>
											 </select>
											 <div style='clear: both;'></div>
											 Average Rating : <span id='avgrating_<?php echo $c_id; ?>'><?php echo $averageRating; ?></span>

											 <!-- Set rating -->
											 <script type='text/javascript'>
											 $(document).ready(function(){
													 $('#rating_<?php echo $c_id; ?>').barrating('set',<?php echo $rating; ?>);
											 });

											 </script>
									 </div>
							 </div>
							 <?php
// PHP program to find intersection of
// two sorted arrays

/* Function prints Intersection
of arr1[] and arr2[] m is the
number of elements in arr1[]
n is the number of elements
in arr2[] */


// Driver Code
$arr1 = array(1, 2, 4, 5, 6);
$arr2 = array(2, 3, 5, 7);

$m = count($arr1);
$n = count($arr2);

// Function calling
findCommon	($arr1, $arr2, $m, $n);

// This code is contributed by anuj_67.
?>



					</div>
					</div>
				</div>
				<br>
			</section>

<script>function showDiv() {
   document.getElementById('welcomeDiv').style.display = "block";
         document.getElementById('a').style.display = "none";
}
/*
$(document).ready(function(){
    $("#a").click(function(){
        $("a").hide();
    });

});*/


</script>
<?php



include 'footer.php';
?>
