<?php
include('database/connection.php');
$errors =[];
if(empty($_POST['name'])){
    $errors = "The name field is required";
}else if(empty($_POST['email'])){
    $errors = "The email field is required";
}else if(empty($_POST['comment'])){
    $errors = "The comment field is required";
}
if(!empty($errors)){
    echo '<div class="alert alert-danger">
            '.$errors.'
        </div><br>';
}else{
    $name = mysqli_escape_string($con,$_POST['name']);
    $email = mysqli_escape_string($con,$_POST['email']);
    $comment = mysqli_escape_string($con,$_POST['comment']);
    $created = date('Y-m-d H:s:m');
    $post_id = mysqli_escape_string($con,$_POST['post_id']);
    $query = "INSERT INTO comments (name,email,comment,created,post_id) values('$name','$email','$comment','$created','$post_id')";
    if(mysqli_query($con,$query)){
        echo $message = '<div class="alert alert-success">
                   Comment added and waiting to be approved
              </div>';
    }else{
         echo '<div class="alert alert-danger">Une erreur est survenue'.mysqli_error($con).'</div>';
    }
}
?>