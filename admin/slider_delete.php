<?php
require('db.php');
$id=$_REQUEST['id'];
$query = "DELETE FROM slider WHERE id=$id"; 
$result = mysqli_query($db,$query);
header("Location: slider_list.php"); 
?>