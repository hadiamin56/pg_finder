
<?php
    session_start();
include "db_conn.php";
include "functions.php";
include "config.php";
//require_once "pg.php";
// Here the user id is harcoded.
// You can integrate your authentication code here to get the logged in user id

$userId=$_SESSION["user_id"];
//$pgid=$row["id"];
//$id=$mid;
//echo "<script>alert('$id')</script>";
//post comment code

$pid=$_POST['ind'];
$query="SELECT tbl_pg.*,tbl_user.name,tbl_region.name AS 'rname',tbl_locality.name AS 'lname',tbl_district.name AS 'dname' from
	(
      (  ((tbl_pg
	inner join tbl_user on tbl_pg.user_id=tbl_user.id)

	  inner join tbl_region on tbl_pg.region_id=tbl_region.id)
        inner join tbl_locality on tbl_pg.locality_id=tbl_locality.id)
       inner join tbl_district on tbl_pg.district_id=tbl_district.id)

	  where tbl_pg.id='$pid'";
//$query = "SELECT * FROM tbl_pg WHERE id='$pid'";

$result= mysqli_query($con, $query);
			//	$row= $result->fetch_array();

//$result = mysqli_query($con, $query);

$outputString = '';

foreach ($result as $row) {
		$locality=$row['locality_id'];
    $userRating = userRating($userId, $row['id'], $con);
    $totalRating = totalRating($row['id'], $con);
    $outputString .= '
    <div class="container">
<div class="bread-crumb bo5-b p-t-17 p-b-17">
  <div class="container">
    <a href="/pg/index.php" class="txt27">
      Home
    </a>
            <span class="txt29 m-l-10 m-r-10">/</span>

  <span class="txt29">
       '.$row['pg_title'].'
    </span>
  </div>
</div>
<div class="row ">
  <div class="col-md-8 col-lg-9">
    <div class="p-t-30 p-b-124 bo5-r p-r-50 h-full p-r-0-md bo-none-md">
      <!-- Block4 -->
      <div class="blo4 p-b-63">
      <div class=" bg-warning text-dark txt5 ">
        <span class="txt20 m-b-4">
          '.$row['budget_per_month'] .'
          per, month
        </span>
      </div>
        <!-- - -->
        <div class="pic-blo4 hov-img-zoom bo-rad-10 pos-relative">
          <a href="#">
            <img src="'.$row['img'].' " alt="IMG-BLOG">
          </a>


        </div>

        <!-- - -->
        <div class="text-blo4 p-t-33 ">
          <h4 class="p-b-16">
          <u>  <a href="#" class=" bg-warning text-dark txt5 ">'.$row['pg_title'] .'

            </a></u>
          </h4>

          <div class="txt32 flex-w p-b-24">
        <ul>
                            <li>  <span class="bg-primary text-dark txt5">
              OWNER: '.$row['name'].'
                <span class="m-r-6 m-l-4">|</span>
            </span></li>


          <li>  <span class=" text-dark txt5">
              Address: '.$row['address'].'
              <span class="m-r-6 m-l-4">|</span>
            </span></li>


            <li><span class="bg-danger text-dark txt5">
              Locality :'.$row['lname'].'
              <span class="m-r-6 m-l-4">|</span>
            </span></li>

          <li>  <span class=" text-dark txt5">
              District:  '.$row['dname'].'
              <span class="m-r-6 m-l-4">|</span>
            </span></li>

            <li><span class=" bg-success text-dark txt5">
              Region :   '.$row['rname'].'
                                    <span class="m-r-6 m-l-4">|</span>
            </span></li>
                              <li>  <span class=" text-dark txt5">
              Meal type :  ';
                 foreach ($m_array as $key => $value) {
                   $meal=$row['meal_type'];
                   if($key==$meal)
                   $outputString .=' '.$value.'' ;

  }

  $outputString .= ' <span class="m-r-6 m-l-4">|</span>
            </span></li>
                          <li>       <span class="bg-danger text-dark txt5">
              Whatsapp owner :  <a href="https://api.whatsapp.com/send?phone='. $row['contact'].'" target="_blank"><i class="fa fa-whatsapp  "></i></a>
            </span></li>
            </ul>
            </div>
            <hr><br>

                <div class="row">
                <span class="bg-warning text-dark txt5" >Description &nbsp;</span> &nbsp;
              <span class="bg-secondary text-white txt4" align="justify"">

            '. $row['pg_description'].'
              </span>>
              </div>  <h4 class="p-b-16">
              <br<br>
<a href="#" class="tit9">comments</a>
  </h4>';


							 $sql="SELECT tbl_comments.*,tbl_user.name from
                           tbl_comments inner join tbl_user on tbl_comments.user_id where tbl_comments.user_id=tbl_user.id AND  tbl_comments.pg_id='$pid'";
                      $out=mysqli_query($con,$sql);
                  if(mysqli_num_rows($out)>0){


                          while($comm=mysqli_fetch_assoc($out)){

                          $outputString .= '<br><span class=" bg-danger text-white txt5 "> '.$comm['name'].':&nbsp; &nbsp;</span><span class=" bg-secondary text-dark txt5">'.$comm['comment'].'</span> ';

                      }
                  }


    $outputString .= '  <!-- Leave a comment -->
   <form action="" method="post" class="leave-comment p-t-10">

        <textarea class="bo-rad-10 size29 bo2 txt10 p-l-20 p-t-15 m-b-10 m-t-40" name="comment" required placeholder="Comment..." ></textarea>
        <!-- Button3 -->
        <input type="submit" name="post_comment" value="Post Comment" class="btn flex-c-m size100 txt11 trans-0-4">


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
              <source src="'. $row['video'].'"  >
        </video>
        <h4 class="txt33 bo5-b p-b-35 p-t-58">
          Facilities
        </h4>

        <ul>';
         $facility="SELECT tbl_pgfacility.*,tbl_facilite.* FROM tbl_pgfacility INNER JOIN   tbl_facilite ON tbl_pgfacility.facility_id WHERE tbl_pgfacility.facility_id=tbl_facilite.id AND tbl_pgfacility.pg_id='$pid' ";
               $result= mysqli_query($con, $facility);
                  if(mysqli_num_rows($result)>0)
                  {

                      while ($rowf=mysqli_fetch_assoc($result))
                      {

          $outputString .= '<li class="bo5-b p-t-8 p-b-8">';
                             if(empty($rowf['facility_icon'])){
                              $outputString .= '<i class="fa fa-check"></i>';
                             }
                             else{
                                 $outputString .= ' <i class="fa fa-'.$rowf['facility_icon'].'"></i>';
                          }
           $outputString .= '<a href="#" class="txt27">
              '.$rowf['facility_name'].'
            </a>
          </li>';

          }
                          }

         $outputString .= '</ul>


        <h4 class="txt33 bo5-b p-b-35 p-t-58">
          Rules
        </h4>

        <ul>';
        $facility="SELECT tbl_pgrules.*,tbl_rule.* FROM tbl_pgrules INNER JOIN   tbl_rule ON tbl_pgrules.rule_id WHERE tbl_pgrules.rule_id=tbl_rule.id AND tbl_pgrules.pg_id='$pid' ";
                           $result= mysqli_query($con, $facility);
                  if(mysqli_num_rows($result)>0)
                  {

                      while ($rowr=mysqli_fetch_assoc($result))
                      {

           $outputString .= '<li class="bo5-b p-t-8 p-b-8">
                             <i class="fa fa-check"></i>

                        <a href="#" class="txt27">
              '.$rowr['name'].'
            </a>
          </li>';

          }
                          }

      $outputString .= '</ul>
      </div>

      <!-- Most Popular -->
      <div class="popular">


        <ul>';


                          $nearby= "SELECT * FROM tbl_pg WHERE locality_id= '$locality'";
                           $result= mysqli_query($con, $nearby);
                  if(mysqli_num_rows($result)>0)
                  {
                      $outputString.='<h4 class="txt33 p-b-35 p-t-58">
          Near by Pgs
        </h4>';
                      while ($rown=mysqli_fetch_assoc($result))
                      {



      $outputString.=' <li class="flex-w m-b-25">
            <div class="size16 bo-rad-10 wrap-pic-w of-hidden m-r-18">
              <a href="pglist.php?id='.$rown['id'].'" >
                <img src='.$rown['img'].'>
              </a>
            </div>

            <div class="size28">
              <a href="#" class="dis-block txt28 m-b-8">
              '.$rown['pg_title'].'
              </a>

              <span class="txt14">
                  Rs '.$rown['budget_per_month'].'
              </span>
            </div>
          </li>';
                      }
										}

                  		$outputString .= '

										<div class="row-title"> Rating </div> <div class="response" id="response-' . $row['id'] . '"></div>
										<ul class="list-inline"  onMouseLeave="mouseOutRating(' . $row['id'] . ',' . $userRating . ');"> ';

										for ($count = 1; $count <= 5; $count ++) {
												$starRatingId = $row['id'] . '_' . $count;

												if ($count <= $userRating) {

														$outputString .= '<li value="' . $count . '" id="' . $starRatingId . '" class="star selected">&#9733;</li>';
												} else {
														$outputString .= '<li value="' . $count . '"  id="' . $starRatingId . '" class="star" onclick="addRating(' . $row['id'] . ',' . $count . ');" onMouseOver="mouseOverRating(' . $row['id'] . ',' . $count . ');">&#9733;</li>';
												}
										} // endFor

										$outputString .= '
										</ul>
										 <p class="review-note">Total Reviews: ' . $totalRating . '</p>

										';
                      $outputString .='</ul>
      </div>
      <!-- Archive -->
    </div>
  </div>
</div>
</div>';
}

echo $outputString;
?>
