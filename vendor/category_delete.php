<?php
require('db.php');
$id=$_REQUEST['id'];
$query = "DELETE FROM snacks_category WHERE id=$id"; 
$result = mysqli_query($db,$query);
header("Location: category_list.php"); 
?>