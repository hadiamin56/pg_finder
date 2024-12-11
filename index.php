<?php
include "header.php";
?>
<style>
    #search {
        background-color: #f2f2f2;
        height: 100%;

        width: 100%;

    }

</style>
<section id="search" class="section-reservation bg1-pattern p-t-100 p-b-113 a">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 p-b-30"><br>
              <br>
              <br><br>
              <br> <br><br><br>
                <br>
                <div class="t-center">
                    <span class="tit2 t-center">

                    </span>

                    <h3 class="tit3 t-center m-b-35 m-t-2">
                      Find your PG
                    </h3>
                </div>

                <form class="wrap-form-reservation size22 m-l-r-auto" method="post" action="districts_pg.php">
                    <div class="row">
                       <div class="col-md-12">
                          <div class="input-container">
                              <i class="fa fa-search icon"></i>                              <!-- Select2 -->
                              <select name="district_id" class="input-field" onchange="this.form.submit()">
                                    <option value="">Search Pg In</option>
                                    <?php
                                    	$sql = "SELECT * FROM tbl_district";
                                      	$result = mysqli_query($con,$sql);
                                        	while($row = mysqli_fetch_assoc($result)){
                                            	echo "<option value='".$row['id']."'>".$row['name']."</option>";
                                            }
                                              	?>
                                              </select>



                                              </div>
                                            </div>
                                         </div>
                                     </form>
                                 </div>
                               </div>
                           </div>
                 </section>

                 <!--latest pgs section start-->

                 <div class="content-intro">
                   <div class="container  ">
                       <?php
                       $sql= "SELECT * FROM tbl_pg WHERE status=1 ORDER BY created_at DESC LIMIT 6";
                          $result= mysqli_query($con, $sql);
                          if(mysqli_num_rows($result)>0)
                          {
                        echo"<hr><center><h1 class='p-3 mb-2 bg-primary text-white'><b>LATEST  PG's/ROOMS  AVAILABLE</b></h1></centere>";

                              while ($row=mysqli_fetch_assoc($result))
                              {
                                echo"<div class='col-md-4 p-t-20 p-3 border '>
                                <div class='blo1'>
                                <div class='wrap-pic-blo bo-rad-5 hov-img-zoom'>

                                <a href='pglist.php?id=".$row['id']."'><img src='$row[img]' alt='IMG-INTRO'></a>
                                </div>

                                <div class='wrap-text-blo2 p-t-35  '>
                                <a href='pglist.php?id=".$row['id']."'><h4 class='  bg-danger text-dark txt5 color0-hov trans-0-4 m-b-13'>
                                 $row[pg_title]
                                 </h4></a>
                                <h3  class='p-3 mb-2 bg-warning text-dark txt4 color0-hov trans-0-4 m-b-13'><i class='fa fa-inr'></i> <b><u>$row[budget_per_month]</u></b>  P/M</h3>";

                                if(isset($_SESSION["user_id"]))  {
                       echo" <div class='row'>
                            <div class='col-md-12'>
                <br><a href='pglist.php?id=".$row['id']."' class='txt3 p-3 mb-2 bg-success text-dark'>
                more details
                  <i class='fa fa-info-circle m-l-10' aria-hidden='true'></i>
                </a>
                            </div>
                         </div>";
                                }
                                else{
                                  echo"
                                  <div class='row'>
                                        <div class='col-md-12'>

                             <a href='/pg/login.php' class='txt4 bg-secondary text-white' '><i class='fa fa-lock m-l-10' aria-hidden='true'></i>      Login to view </a>
                             </div>
                                    </div>";
                                }

              echo"</div>
            </div>
          </div>";

                        }
                    }

                    ?>

                     </div>
                   </div>
                 </div>


                 <div class="content-intro  p-t-77 p-b-133 ">


                    <div class="container">


                 <!--latest pgs section ends-->

                 <!--highrated pgs starts-->

                 <?php

                 $sql= "SELECT tbl_rating.pg_id, avg( rating ) as avg_rating FROM `tbl_rating` GROUP BY pg_id ORDER by avg_rating DESC  LIMIT 6";
                 $result= mysqli_query($con,$sql);
                 if(mysqli_num_rows($result)>0)
                 {
                   echo"<hr><center><h1 class='p-3 mb-2 bg-dark text-white'><b>HIGH RATED PG'S/ROOMS</b></h1></centere>";

                     while ($row=mysqli_fetch_assoc($result))
                     {
                       $query="SELECT * from tbl_pg WHERE id='$row[pg_id]'";
                       $result_pg=mysqli_query($con,$query);
                       $pg_date=mysqli_fetch_assoc($result_pg);
                       echo"<div class='col-md-4 p-t-20  p-4 border'>
                       <!-- Block1 -->
                       <div class='blo1'>
                       <div class='wrap-pic-blo1 bo-rad-10 hov-img-zoom'>

                       <a href='#'><img src='$pg_date[img]' alt='IMG-INTRO'></a>
                       </div>

                       <div class='wrap-text-blo1 p-t-35'>
                       <a href='pglist.php?id=".$pg_date['id']."'><h4 class='  bg-danger text-dark txt5 color0-hov trans-0-4 m-b-13'>
                       $pg_date[pg_title]
                       </h4></a>
                       <h3  class='p-3 mb-2 bg-warning text-dark txt4 color0-hov trans-0-4 m-b-13'><i class='fa fa-inr'></i> <b><u>$pg_date[budget_per_month]</u></b>  P/M</h3>";
                       if(isset($_SESSION["user_id"]))  {
                     echo" <div class='row'>
                     <div class='col-md-12'>
                     <br><a href='pglist.php?id=".$pg_date['id']."' class='txt3 p-3 mb-2 bg-success text-dark'>
                     more details
                     <i class='fa fa-info-circle m-l-10' aria-hidden='true'></i>
                     </a>
                     </div>
                     </div>";
                       }
                       else{
                         echo"
                         <div class='row'>
                               <div class='col-md-12'>

                     <a href='/pg/login.php' class='txt4 bg-secondary text-white' '><i class='fa fa-lock m-l-10' aria-hidden='true'></i>      Login to view </a>
                     </div>
                           </div>";
                       }

                     echo"</div>
                     </div>
                     </div>";

                     }
                     }

                     ?>

                     </div>
                     </div>


                   </div>
                     <?php
                     include "script.php";
                     include "footer.php";

                     ?>
