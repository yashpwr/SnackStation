<?php
require('db.php');
$id=$_REQUEST['id'];
$query = "DELETE FROM snacks WHERE id=$id"; 
$result = mysqli_query($db,$query);
header("Location: snacks_list.php"); 
?>