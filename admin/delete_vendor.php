<?php
require('db.php');
$id=$_REQUEST['id'];
$query = "DELETE FROM vendor WHERE id=$id"; 
$result = mysqli_query($db,$query);
header("Location: vendor_list.php"); 
?>