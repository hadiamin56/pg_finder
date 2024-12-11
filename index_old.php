<?php

include 'header.php';
$flag="";
?>
<!-- search -->


<!-- Slide1 -->
<!--section class="section-slide">
		<div class="wrap-slick1">
			<div class="slick1">

				<div class="item-slick1 item3-slick1" style="background-image: url(images/back_ground.jpg);">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						  <div class="row">
                    <!-- Name >
                              <div class="col-md-12">
                                   <span class="txt9">
                                       <b style="font-size: 27px;color: white;">Find Your PG</b>
                                  </span>
                                    <form action="index.php#pgs" method="post" >
                                            <input required class="bo-rad-10  txt30 p-l-20" style="color: black; text-transform: none; " type="text" name="search_" >
                                            <input type="submit" name="search" value="search" class="btn3  size36 txt11 trans-0-3">
                                    </form>
                                  </div>
                        </div>
					</div>
				</div>

			</div>


		</div>
	</section-->
<!-- Reservation -->
<br>
<style>
    .a{
        background-image: url("image3.jpg");
    }
</style>
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
												$sql = "SELECT * FROM tbl_locality ";

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
										if(isset($_POST['search'])){
///												$input = $_POST['name'];
//												 $address = $_POST['address'];
//												 $locality = $_POST['locality'];
//												 $meal_type = $_POST['meal'];
//												 $budget=$_POST['budget'];
												 $fields = array('pg_title', 'address', 'locality_id','region_id','district_id', 'meal_type', 'budget_per_month');
    								 			$conditions = array();
    									foreach($fields as $field){
        									if(isset($_POST[$field]) && $_POST[$field] != '') {
            								$conditions[] = "`$field` LIKE '%" . mysqli_real_escape_string($con,$_POST[$field]) . "%'";
        										}
    									}
    							$query = "SELECT * FROM tbl_pg ";
    					if(count($conditions) > 0) {
        				$query .= "WHERE " . implode (' OR ', $conditions);
    }
	//	echo "$query";


//  $sql= "SELECT * FROM tbl_pg WHERE status=1 AND  `address` LIKE '%$address%'  OR `pg_title` LIKE '%$input%' ";
                        			$result= mysqli_query($con, $query);
                        if(mysqli_num_rows($result)>0)
                        {
                              echo"
                              <div class='col-md-12 col-lg-12' id='pgs'>
                                <div  class='col-md-6 col-lg-6 col-lg-offset-3 col-md-offset-3'>
                                    <b style='font-size: 27px;color: #555609;'>Your search result returns:</b>
                                </div>
															</div><br>";
                            while ($row=mysqli_fetch_assoc($result))
                            {
															echo"
															<div class='col-md-3 p-t-30'>
															<!-- Block1 -->
															<div class='blo1'>
															<div class='wrap-pic-blo1 bo-rad-10 hov-img-zoom'>
															<a href='#'><img src='$row[img]' alt='IMG-INTRO'></a>
															</div>
															<div class='wrap-text-blo1 p-t-35'>
															<a href=''#'><h4 class='txt5 color0-hov trans-0-4 m-b-13'>
															$row[pg_title]
															</h4></a>RS: $row[budget_per_month]<sub>per month</sub>
															<!--p class='m-b-20'>
															Phasellus lorem enim, luctus ut velit eget, con-vallis egestas eros.
															</p-->
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
                     	}
                    else{
                     }



                    ?>





            </div>
        </div>
    </div>
</section>
<div id="dropDownSelect1"></div>

<?php

include 'script.php';

include 'footer.php';
?>
<script>
    $("select[name='region_id']").change(function() {

        var regionID = $(this).val();


        if (regionID) {


            $.ajax({

                url: "ajaxpro.php",

                dataType: 'Json',

                data: {
                    'id': regionID
                },

                success: function(data) {

                    $('select[name="district_id"]').empty();
                    $('select[name="district_id"]').append('<option value=""> Select District </option>');


                    $.each(data, function(key, value) {

                        $('select[name="district_id"]').append('<option value="' + key + '">' + value + '</option>');

                    });

                }

            });


        } else {

            $('select[name="district_id"]').empty();

        }

    });

    $("select[name='district_id']").change(function() {

        var districtID = $(this).val();


        if (districtID) {


            $.ajax({

                url: "locality_data.php",

                dataType: 'Json',

                data: {
                    'id': districtID
                },

                success: function(data) {

                    $('select[name="locality_id"]').empty();

                    $.each(data, function(key, value) {

                        $('select[name="locality_id"]').append('<option value="' + key + '">' + value + '</option>');

                    });

                }

            });


        } else {

            $('select[name="locality_id"]').empty();

        }

    });

</script>
