<?php
 $g_array= array( "0"=>"--select gender--", "1"=> "Male", "2"=> "Female", "3"=> "Other");



  $s_array= array( "0"=> " --select status--", "1"=> "Active", "2"=> "Inactive");

  $m_array= array( "0"=> "Only Veg", "1"=> "Only Non-Veg", "2"=> "Both Veg and Non-Veg");




  $user_type_array= array("0"=> "--select user type--", "1"=>"Admin","2"=>"general user" );



  $furnishing_type=array("0"=>"Fully Furnished","1"=>"Semi-Furnished","2"=>"UnFirnished");



  function user_input($input)
  {
  	$input= trim($input);
  	$input= stripslashes($input);
  	$input= htmlspecialchars($input);
  	return $input;
  }

 function GetImageExt($imagetype)
{
	if(empty($imagetype))
		return false;
	switch ($imagetype) {
		case 'image/bmp':
			return '.bmp';
			break;
		case 'image/jpeg':
			return '.jpeg';
			break;
		case 'image/jpg':
			return '.jpg';
			break;
		case 'image/png':
			return '.png';
			break;
		default:
			return false;
			break;
	}
}

?>
