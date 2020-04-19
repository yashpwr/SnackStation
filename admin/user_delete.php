<?php
require('db.php');
$id=$_REQUEST['id'];
$query = "DELETE FROM users WHERE id=$id"; 
$result = mysqli_query($db,$query);
header("Location: user_list.php"); 
?>