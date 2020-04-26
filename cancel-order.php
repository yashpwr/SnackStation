<?php
require('db.php');
$id=$_REQUEST['id'];
$query = "UPDATE order_details SET status = 'canceled' Where id = $id"; 
$result = mysqli_query($db,$query);
header("Location: order-details.php"); 
?>