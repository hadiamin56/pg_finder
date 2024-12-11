<?php

include "header.php";
if(!isset($_SESSION["user"]))
    {
       // mysql_close($connection); // Closing Connection
       // header('Location: login.php'); // Redirecting To Home Page
      echo"<script>location.replace('login.php')</script>";
    }
if(isset($_POST['post_comment']))
{
	 // $user_id=$_POST["user"];
		$comment=$_POST["comment"];
		//$user_id=$user_id;

    $id= isset($_GET['id'])? $_GET['id']: '';
     if(isset($_SESSION["user_id"])){
                      $user_id=$_SESSION["user_id"];
                  }



		$sql_insert="INSERT INTO tbl_comments(user_id,pg_id,comment) VALUES('$user_id','$id','$comment')";
		$sql_result=mysqli_query($con,$sql_insert);
		if($sql_result){
			//echo"comment Added";

		}
}

      /*  $sql= "SELECT * FROM tbl_pg WHERE status=1 ORDER BY created_at DESC";
    $result= mysqli_query($con, $sql);
    if(mysqli_num_rows($result)>0)
    {
  echo"<br><br><br><br><div class='row'>";
        while ($row=mysqli_fetch_assoc($result))
        {


            echo"<div class='col-md-4 p-t-30'>
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
    echo"</div>";
}
*/?>
<style>


li.star {
    list-style: none;
    display: inline-block;

    cursor: pointer;
    color: #9E9E9E;
    font-size: 30px;
}

li.star.selected {
    color: yellow;
}

.row-title {
    font-size: 20px;
    color: #00BCD4;
}

.review-note {
    font-size: 12px;
    color: #999;
    font-style: italic;
}

p.text-address {
    font-size: 12px;
}
</style>

<?php
include 'script.php';
?><br>
<br>
<br>
<br>
<br>

<body onload="showRestaurantData('getRatingData.php')">
    <div class="container">
        <span id="restaurant_list"></span>
    </div>
<script type="text/javascript">

    function showRestaurantData(url)
    {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200)
            {
                document.getElementById("restaurant_list").innerHTML = this.responseText;
            }
        };
        xhttp.open("POST", url, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var parameters = "ind=" + <?php echo "$_GET[id]"; ?> + "&pg_id=" + 1;
        xhttp.send(parameters);
      //  xhttp.open("GET", url, true);
        //xhttp.send();

    }

    function mouseOverRating(pg_id, rating) {

        resetRatingStars(pg_id)

        for (var i = 1; i <= rating; i++)
        {
            var ratingId = pg_id + "_" + i;
            document.getElementById(ratingId).style.color = "#ff6e00";

        }
    }

    function resetRatingStars(pg_id)
    {
        for (var i = 1; i <= 5; i++)
        {
            var ratingId = pg_id + "_" + i;
            document.getElementById(ratingId).style.color = "#9E9E9E";
        }
    }

   function mouseOutRating(pg_id, userRating) {
	   var ratingId;
       if(userRating !=0) {
    	       for (var i = 1; i <= userRating; i++) {
    	    	      ratingId = pg_id + "_" + i;
    	          document.getElementById(ratingId).style.color = "#ff6e00";
    	       }
       }
       if(userRating <= 5) {
    	       for (var i = (userRating+1); i <= 5; i++) {
	    	      ratingId = pg_id + "_" + i;
	          document.getElementById(ratingId).style.color = "#9E9E9E";
	       }
       }
    }

    function addRating (pg_id, ratingValue) {
            var xhttp = new XMLHttpRequest();

            xhttp.onreadystatechange = function ()
            {
                if (this.readyState == 4 && this.status == 200) {

                    showRestaurantData('getRatingData.php');

                    if(this.responseText != "success") {

                     alert(this.responseText);
                    	  // alert(this.responseText);
                    }
                }
            };

            xhttp.open("POST", "insertRating.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var parameters = "index=" + ratingValue + "&pg_id=" + pg_id;
            xhttp.send(parameters);
    }
</script>
<?php
include 'footer.php';
 ?>
