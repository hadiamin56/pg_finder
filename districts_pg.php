<BR><BR><BR><BR><BR><BR><BR><BR><BR>

  <?php
include "header.php";
?>
<section class="section-reservation bg1-pattern p-t-100 p-b-113 a">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 p-b-30">
                <div class="t-center">


                    <h3 class="tit3 t-center m-b-35 m-t-2">
                      Advance Search
                    </h3>
                </div>

                <form class="" method="post" action="index_old.php#pgs">
                    <div class="row">
                        <div class="col-md-2">
                            <!-- Name -->
                            <span class="txt9">
                                Name
                            </span>

                            <div class="wrap-inputname size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                <input class="bo-rad-10 sizefull txt10 p-l-20" type="text" name="pg_title" placeholder="Name">
                            </div>
                        </div>

                        <!--div class="col-md-4">
								< Date>
								<span class="txt9">
									Date
								</span>

								<div class="wrap-inputdate pos-relative txt10 size12 bo2 bo-rad-10 m-t-3 m-b-23">
									<input class="my-calendar bo-rad-10 sizefull txt10 p-l-20" type="text" name="date">
									<i class="btn-calendar fa fa-calendar ab-r-m hov-pointer m-r-18" aria-hidden="true"></i>
								</div>
							</div-->

                        <div class="col-md-2">
                            <!-- Address -->
                            <span class="txt9">
                                Address
                            </span>

                            <div class="wrap-inputname size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                <input class="bo-rad-10 sizefull txt10 p-l-20" type="text" name="address" placeholder="Address">
                            </div>
                        </div>
                        <div class="col-md-2">

                            <span class="txt9">
                                Locality
                            </span>

                            <div class="wrap-inputpeople size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                <!-- Select2 -->
                                <select name="region_id" class="selection-1">

                                    <option value="">--- Select Locality ---</option>
                                    <?php


  $district=$_POST["district_id"];
												$sql = "SELECT * FROM tbl_locality WHERE district_id= '$district'";

												$result = mysqli_query($con,$sql);

												while($row = mysqli_fetch_assoc($result)){

														echo "<option value='".$row['id']."'>".$row['name']."</option>";

												}

										?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <!-- Time -->
                            <span class="txt9">
                                Meal Type
                            </span>

                            <div class="wrap-inputtime size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                <!-- Select2 -->
                                <select name="meal_type" class="selection-1">
                                    <option value="">Please SELECT</option>
                                    <?php
                              foreach($m_array as $key=> $value)
                            {
                              echo "<option value= '$key'> $value </option>";
                            }
                         ?>
                                </select>
                            </div>
                        </div>  <div class="col-md-2">
                              <!-- Name -->
                              <span class="txt9">
                                  Budget
                              </span>

                              <div class="wrap-inputname size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                  <input class="bo-rad-10 sizefull txt10 p-l-20" type="number" min=0 name="budget_per_month" placeholder="budget">
                              </div>
                          </div>

                          <div class="col-md-2">
                              <!-- Name -->
                              <br>
                              <span class="txt9">

                              </span>

                              <div class="wrap-btn-booking flex-c-m m-t-6">
                                  <input type="submit" value="search" name="search" class="btn3 flex-c-m size13 txt11 trans-0-4">
                              </div>
                          </div>






                    </div>

                    <!--div class="row">
                        <div class="col-md-4">

                            <span class="txt9">
                                District
                            </span>

                            <div class="wrap-inputpeople size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                <!-- Select2 >
                                <select name="district_id" class="selection-1">

                                </select>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- People
                            <span class="txt9">
                                Locality
                            </span>

                            <div class="wrap-inputpeople size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                <!-- Select2 >
                                <select name="locality_id" class="selection-1">

                                </select>
                            </div>
                        </div-->







                    </div>


                </form>
            </div>
        </div>
    </div>
</section>

  <section class="section-intro">
    <div class="content-intro bg-white p-t-77 p-b-133">
        <div class="container">
            <div class="row">

<?php
  $district=$_POST["district_id"];

	$query = "SELECT * FROM tbl_pg where district_id='$district' ";
  $result= mysqli_query($con, $query);
if(mysqli_num_rows($result)>0)
{
while ($row=mysqli_fetch_assoc($result))
{
  echo"
    <div class='col-md-3 p-t-30'>
    <div class='blo1'>
      <div class='wrap-pic-blo1 bo-rad-10 hov-img-zoom'>
        <a href='#'><img src='$row[img]' alt='IMG-INTRO'></a>
      </div>
      <div class='wrap-text-blo1 p-t-35'>
        <a href=''#'><h4 class='txt5 color0-hov trans-0-4 m-b-13'>
        $row[pg_title]
          </h4></a>RS: $row[budget_per_month]<sub>per month</sub>

          <div class='row'>
          <div class='col-md-6'><br>
          <a href='pg.php?id=".$row['id']."' class='txt4'>
          More Details
          <i class='fa fa-long-arrow-right m-l-10' aria-hidden='true'></i>
          </a>
          </div>";
  echo" </div>
  </div>
  </div>
  </div>";
}
}
else{
 echo "No Results Found";
}



?>
      </div>
    </div>
  </div>
<div id="dropDownSelect1"></div>
<?php
include "script.php";
include "footer.php";
?>
