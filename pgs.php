<?php

include 'header.php';
        $sql= "SELECT * FROM tbl_pg WHERE status=1 ORDER BY created_at DESC";
    $result= mysqli_query($con, $sql);
    if(mysqli_num_rows($result)>0)
    {
      echo"<br><br><br><br><br><br><hr><center><h1 class='p-3 mb-2 bg-dark text-white'><b>AVAILABLE PG'S/ROOMS</b></h1></centere><div class='row'>";
        while ($row=mysqli_fetch_assoc($result))
        {


            echo"<div class='col-md-2 p-t-30 p-l-50'>
<!-- Block1 -->
<div class='blo1'>
<div class='wrap-pic-blo bo-rad-10 hov-img-zoom max-auto'>
<a href='#'><img src='$row[img]' alt='IMG-INTRO'></a>
</div>

<div class='wrap-text-blo1 p-t-35'>
<a href=''#'><h4 class='  bg-danger text-dark txt5 color0-hov trans-0-4 m-b-13'>
$row[pg_title]
<h3  class='p-3 mb-2 bg-warning text-dark txt4 color0-hov trans-0-4 m-b-13'><i class='fa fa-inr'></i><b><u>$row[budget_per_month]</u></b>  P/M</h3>

<!--p class='m-b-20'>
Phasellus lorem enim, luctus ut velit eget, con-vallis egestas eros.
</p-->
            <div class='row'>
        <div class='col-md-12'><br>
<a href='pglist.php?id=".$row['id']."'  class='txt4 bg-secondary text-white''>
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

include "script.php";
include "footer.php";

?>
