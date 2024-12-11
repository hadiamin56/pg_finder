
<?php $action=(!empty($id) ?'edit_listing.php':'list_pg.php'); ?>
<style>
        input.largerCheckbox {
            width: 20px;
            height: 20px;

        }
    </style>
    <div style="background-color:grey; position:relative; top:50px; ">
<div class="container" >
        <h3 class="tit7 t-center p-b-62 p-t-105">
            List Your PG For Free
        </h3>

        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="wrap-form-reservation size22 m-l-r-auto">
            	<input type="hidden" name="id" value="<?php  if ($action=='edit_listing.php') echo $id; ?>">
                <input type="hidden" name="edit_image" value="<?php  echo($action=='edit_listing.php')?  $image :"" ;?>">
                 <input type="hidden" name="user_id" value="<?php  echo($action=='edit_listing.php')?  $user :"" ;?>">
                 <input type="hidden" name="status" value="<?php  echo($action=='edit_listing.php')?  $status :"" ;?>">
                 <input type="hidden" name="edit_video" value="<?php  echo($action=='edit_listing.php')?  $video :"" ;?>">

            <div class="row">

                    <!-- Name -->

                    <label>NAME</label>

                    <div class="input-container">
                        <i class="fa fa-user icon"></i>
                        <input required class="input-field" type="text" name="title" placeholder="Pg Title"  value="<?php  if ($action=='edit_listing.php') echo $title; ?>">
                    </div>



                    <!-- Email -->
                    <label>ADDRESS</label>
                    <div class="input-container">
                        <i class="fa fa-envelope icon"></i>
                        <input required id="address" class="input-field" type="text" name="address" placeholder="address"  required value="<?php  if ($action=='edit_listing.php') echo $address; ?>">
                        <!--<span class="txt9">
                            <?php  //$email_error; ?>
                        </span>-->
                    </div>
                    <label>CHOOSE A DISPLAY PICTURE</label>
                    <div class="input-container">
                      <i class="	fa fa-image icon"></i>
                      <input type="file" name="image"  class="btn" required >

                    </div>

                    <label>DISTRICT</label>

                  <div class="input-container">

                    <i class="fa fa-wpforms icon"></i>

                    <!-- Select2 -->
                        <select name="district"  class="input-field">
                          <option value="">select district</option>
                          <?php //if ($action=='edit_listing.php'){

                            $q="select * from tbl_district";
                            $result=mysqli_query($con,$q);
                        if(mysqli_num_rows($result)>0){

                                while($row=mysqli_fetch_assoc($result))
                                {
                                  //  $did=$row["id"];
                                  //  $name=$row["name"];
                                    //  $selected="";
                                  //  if($row["id"]===$district){
                                  //  $selected="selected";
                                  //  echo'<option value="'.$did.'". '.$selected.'>'.$name.'</option>';
                                  echo "<option value='".$row['id']."'>".$row['name']."</option>";
                                //}

                    }

                  }// }?>
                        </select>

                  </div>


                    <!-- Phone -->

                    <label>REGION</label>

                    <div class="input-container">

                      <i class="fa fa-wpforms icon"></i>


                                        <select name="region"  class="input-field">
                                        <option value='' >select region</option>
                                        <?php
                                        $q="SELECT  *from tbl_region";
                                        $result=mysqli_query($con,$q);
                                    if(mysqli_num_rows($result)>0){
                                            while($row=mysqli_fetch_assoc($result))
                                            {
                                            //    unset($rid,$name);
                                              //  $rid=$row["id"];
                                                //$name=$row["name"];
                                                  //$selected="";
                                                //if($row["id"]===$region)
                                                //$selected="selected";
                                                echo "<option value='".$row['id']."'>".$row['name']."</option>";                                            //}

                                }

}                                ?>
</select>
                    </div>
                    <label>LOCALITY</label>

                <div class="input-container">

                  <i class="fa fa-wpforms icon"></i>


                                      <select name='locality'  class='input-field'>
                                      <option value='' >select locality</option>
                                      <?php
                                      $q="SELECT  *from tbl_locality";
                                      $result=mysqli_query($con,$q);
                                  if(mysqli_num_rows($result)>0){
                                          while($row=mysqli_fetch_assoc($result))
                                          {
                                              //unset($rid,$name);
                                              //$rid=$row["id"];
                                            //  $name=$row["name"];
                                                //$selected="";
                                              //if($row["id"]===$locality)
                                              //$selected="selected";
                                              echo "<option value='".$row['id']."'>".$row['name']."</option>";                                          //}

                              }
                            }

                              ?>
                            </select>
                  </div>

                  <label>CONTACT</label>

                <div class="input-container">

                  <i class="fa fa-address-card icon"></i>
                        <input required class="input-field" type="text" name="contact" placeholder="Contact" value="<?php  if ($action=='edit_listing.php') echo $contact; ?>">
                    </div>

                    <label>LANDMARK</label>


                                    <div class="input-container">

                                      <i class="fa fa-safari icon"></i>
                         <input required class="input-field" type="text" value="<?php  if ($action=='edit_listing.php') echo $landmark; ?>" name="landmark" placeholder="Nearest landmark">
                      <!--  <span class="txt9">
                            <?php ?>
                        </span>-->
                    </div>


                    <label>MEAL TYPE</label>


            <div class="input-container">
              <i class="	fa fa-cutlery icon"></i>
                        <select name="meal" class="input-field" required>
                            <?php
		 						foreach($m_array as $key=> $value)
		 							{
		 								$selected = (($meal_type== $key)? "selected" : "") ;
		 								echo "<option value= '$key' $selected> $value </option>";
		 							}
		 					?>
                        </select>

                    </div>



                    <label>BUDGET</label>

                    <div class="input-container">
                      <i class="fa fa-inr icon"></i>
                        <input required class="bo-rad-10 sizefull txt10 p-l-20"  min="0" type="number" name="budget"  placeholder="budget" value="<?php  if ($action=='edit_listing.php') echo $budget; ?>" required>
                    </div>

                    <label>PG VEDIO</label>

                    <div class="input-container">
                      <i class="fa fa-file-movie-o icon"></i>
                      <input type="file" name="video" placeholder="Video" class="input-field" required >
                      
                  </div>
 <label>DESCRIPTION</label>

                  <div class="input-container">



                    <i class="fa fa-edit icon"></i>

                  <textarea   class="input-field" name="description" value=" <?php  if ($action=='edit_listing.php') echo $description; ?>"  placeholder="Description">
                      <?php  if ($action=='edit_listing.php') echo $description; ?>
                  </textarea>
                  </div>
                  <div class="col-md-6">
                     <span class="txt9">
                      <u> <b>Pg Rules</b></u>
                    </span><br><br>
        	           <?php
                     $sql_rules="select * from tbl_rule";
                      $result_1=mysqli_query($con,$sql_rules);
                        if(mysqli_num_rows($result_1)>0)
			                     {
  				                       while($row_1=mysqli_fetch_assoc($result_1))
  				                           {
                                       if($action=='edit_listing.php')
                                       {
                                         $pg_rule="SELECT tbl_pgrules.rule_id FROM tbl_pgrules WHERE pg_id='$id'";
                                              $array_1 = array();
                                                $result_2=mysqli_query($con,$pg_rule);
                                                if(mysqli_num_rows($result_2)>0){
                                                  while($row_2 = mysqli_fetch_assoc($result_2)){
                                                    $array_1[] = $row_2;
                                                  }
                                                }
                                                $ruleids = array_column($array_1, 'rule_id');
                                                if(in_array ( $row_1['id'],  $ruleids ,TRUE ))
                                                {

                                                  $checked="checked";
                                                }
                                                else {
                                                  $checked="";
                                                }
                                                echo " <input class='largerCheckbox' type='checkbox' name='rules[]' $checked  value='$row_1[id]'>$row_1[name]</input><br>";
                                              }
                                              else {
                                                echo "<input class='largerCheckbox' type='checkbox' name='rules[]'   value='$row_1[id]'>&nbsp;&nbsp;<b>$row_1[name]</b\></input><br>";
                                              }
        // }}
      //  }
                                              }
                                            }
                                            ?>
                 </div>
                   <div class="col-md-20">
                     <span class="txt9">
                       <u><b>Pg Facilities</b></u>
                    </span><br><br>

			<?php
                $sql_facilite="select * from tbl_facilite";
                $result_3=mysqli_query($con,$sql_facilite);
        if(mysqli_num_rows($result_3)>0)
			 {
  				while($row_3=mysqli_fetch_assoc($result_3))
  				{
              if($action=='edit_listing.php')
              {
                   $query_facility="SELECT tbl_pgfacility.facility_id FROM tbl_pgfacility WHERE pg_id=$id";
                //"SELECT tbl_asset.id FROM  tbl_asset  INNER JOIN tbl_resource_asset ON tbl_asset.id =tbl_resource_asset.asset_id WHERE tbl_resource_asset.room_id='$id'";
                    // set array
            $array_2 = array();
                  // look through query
            $result_4=mysqli_query($con,$query_facility);
        if(mysqli_num_rows($result_4)>0){
            while($row_4 = mysqli_fetch_assoc($result_4)){
                $array_2[] = $row_4;
            }
            }
          $facilityids = array_column($array_2, 'facility_id');
                    if(in_array ( $row_3['id'], $facilityids ,TRUE ))
                {

                    $checked_="checked";
                }
                else {
                    $checked_="";
                  }
                  echo "<input class='largerCheckbox' type='checkbox' name='facilities[]' $checked_  value='$row_3[id]'><b>$row_3[facility_name]</b></input><br>";
              }
                else {
                        echo "<input class='largerCheckbox' type='checkbox' name='facilities[]'   value='$row_3[id]'>&nbsp;<b>$row_3[facility_name]</b></input><br>";
                }
        // }}
      //  }
                }
        }
                    ?>

                 </div>

                    <div class="input-container">
                        <input type="submit" name="submit" id="submit" value="Add" class="btn">
                    </div>



        </form>
</div>
</div>

    </div>

	<div id="dropDownSelect1"></div>

<script>

$( "select[name='region']" ).change(function () {

    var regionID = $(this).val();


    if(regionID) {


        $.ajax({

            url: "ajaxpro.php",

            dataType: 'Json',

            data: {'id':regionID},

            success: function(data) {

                $('select[name="district"]').empty();
								$('select[name="district"]').append('<option value=""> Select District </option>');


                $.each(data, function(key, value) {

                    $('select[name="district"]').append('<option value="'+ key +'">'+ value +'</option>');

                });

            }

        });


    }else{

        $('select[name="district"]').empty();

    }

});

$( "select[name='district']" ).change(function () {

    var districtID = $(this).val();


    if(districtID) {


        $.ajax({

            url: "locality_data.php",

            dataType: 'Json',

            data: {'id':districtID},

            success: function(data) {

                $('select[name="locality"]').empty();

                $.each(data, function(key, value) {

                    $('select[name="locality"]').append('<option value="'+ key +'">'+ value +'</option>');

                });

            }

        });


    }else{

        $('select[name="locality"]').empty();

    }

});


var input = document.getElementById('address');

     var options = {
        types: ['geocode'], //this should work !
          componentRestrictions: {country: "IN"}
      };
autocomplete = new google.maps.places.Autocomplete(input, options);
</script>
