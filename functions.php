<?php



function userRating($user_id,$pg_id,$con)
{
    $average = 0;
    $avgQuery = "SELECT rating FROM tbl_rating WHERE user_id = '" . $user_id . "' and pg_id = '" . $pg_id . "'";
    $total_row = 0;

    if ($result = mysqli_query($con, $avgQuery)) {
        // Return the number of rows in result set
        $total_row = mysqli_num_rows($result);
    } // endIf

    if ($total_row > 0) {
        foreach ($result as $row) {
            $average = round($row["rating"]);
        } // endForeach
    } // endIf
    return $average;
}
 // endFunction
function totalRating($pg_id,$con)
{
    $rowCount="";
    $totalVotesQuery = "SELECT * FROM tbl_rating WHERE pg_id = '" . $pg_id . "'";

    if ($result = mysqli_query($con, $totalVotesQuery)) {
        // Return the number of rows in result set
        $rowCount = mysqli_num_rows($result);
        // Free result set
        mysqli_free_result($result);
    } // endIf

    return $rowCount;
}//endFunction
?>
