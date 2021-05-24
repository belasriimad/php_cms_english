<?php 
include('includes/header.php');
$errors =[];
$message = "";
if(isset($_POST['submit'])){
    $name = mysqli_escape_string($con,$_POST['name']);
    $email = mysqli_escape_string($con,$_POST['email']);
    $password = mysqli_escape_string($con,sha1($_POST['password']));
    $created = date('Y-m-d H:s:m');
    if(empty($_POST['name'])){
        $errors = "The name field is required";
    }else if(empty($_POST['email'])){
        $errors = "The email field is required";
    }else if(empty($_POST['password'])){
        $errors = "The password field is required";
    }else{
        $query = "INSERT INTO users (name,email,password,created) values('$name','$email','$password','$created')";
        if(mysqli_query($con,$query)){
             $message = '<div class="alert alert-success">
                    Account created
                </div>';
        }else{
            echo '<div class="alert alert-danger">Something went wrong'.mysqli_error($con).'</div>';
        }
    }
}
?>
<div class="container">
    <div class="row" style="margin-top:50px">
        <div class="col-md-6 col-md-offset-3">
            <?php 
                if(!empty($errors)){
                    echo '<div class="alert alert-danger">
                            '.$errors.'
                        </div><br>';
                }else{
                    echo $message;
                }
            ?>
            <div class="panel panel-default" style="padding:10px;">
            <h3 class="text-info">Register</h3>
            <hr>
                <form  method="post" action="register.php">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Entrer votre nom">
                    </div>
                    <div class="form-group">
                        <label for="name">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Entrer votre email">
                    </div>
                    <div class="form-group">
                        <label for="name">Password:</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Entrer votre mot de passe">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success" name="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php');?>