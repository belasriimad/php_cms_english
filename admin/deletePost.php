<?php
include('../database/connection.php');
if(!isset($_SESSION['admin'])){
    header("location:login.php");
}
$id = mysqli_escape_string($con,$_GET['id']);
$query = "DELETE  FROM articles WHERE id='$id'";
if(mysqli_query($con,$query)){
    mysqli_query($con,$query);
    header("location:posts.php?deleted");
}