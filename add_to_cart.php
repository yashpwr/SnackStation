<?php
require('db.php');

$sql = "CREATE TABLE `cart` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `snacks_id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `vendor_id` int(11) NOT NULL,
    `trn_date` datetime NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
  mysqli_query($db, $sql);

$snack_id=$_REQUEST['snackid'];
$vendor_id = $_REQUEST['vendorid'];
$user_id = $_REQUEST['userid'];
$trn_date = date("Y-m-d H:i:s");
$query = "INSERT INTO cart (snacks_id, user_id, vendor_id, trn_date) VALUES('$snack_id','$user_id','$vendor_id', '$trn_date')";
$result = mysqli_query($db,$query);
 if($result){
//header("Location: index.php");
     echo '<link href="assets/css/toastr.min.css" rel="stylesheet">
     	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    	<script src="assets/js/toastr.min.js"></script>
     	<script src="assets/js/toast.js"></script>
     	
     	<script>
      	
      	jQuery(document).ready(function () {
      	Toaster.addtocart(); });
     	
     	</script>';

}
?>