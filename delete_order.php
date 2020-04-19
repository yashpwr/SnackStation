<?php
require('db.php');
$id=$_REQUEST['id'];
$query = "DELETE FROM cart WHERE id=$id"; 
$result = mysqli_query($db,$query);
//header("Location: checkout.php"); 
 if($result){
//header("Location: index.php");
     echo '<link href="assets/css/toastr.min.css" rel="stylesheet">
     	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    	<script src="assets/js/toastr.min.js"></script>
     	<script src="assets/js/toast.js"></script>
     	
     	<script>
      	
      	jQuery(document).ready(function () {
      	Toaster.removefromcart(); });
     	
     	</script>';

}
?>