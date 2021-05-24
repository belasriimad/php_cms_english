<?php include('includes/header.php');?>
<?php 
if(!isset($_SESSION['admin'])){
    header("location:login.php");
}
$id = mysqli_escape_string($con,$_GET['id']);
$errors = [];
$message = "";
if(isset($_POST['submit'])){
    if(empty($_POST['name'])){
        $errors = "The name field is required";
    }else{
        $name = mysqli_escape_string($con,$_POST['name']);
        $query = "UPDATE categories SET name = '$name' WHERE id = '$id'";
        if(mysqli_query($con,$query)){
            $message = '<div class="alert alert-success">
                       Category added
                  </div>';
        }else{
             echo '<div class="alert alert-danger">Something went wrong'.mysqli_error($con).'</div>';
        }
    }
}
//get category
$query = "SELECT * FROM categories WHERE id='$id'";
if(mysqli_query($con,$query)){
    $result = mysqli_query($con,$query);
    $categorie = $result->fetch_assoc();
}
?>
<div class="container-fluid">
    <div class="row" style="margin-top: 30px;">
        <div class="col-sm-3 col-md-2 sidebar">
           <?php include('includes/sidebar.php');?>
        </div>
            <div class="col-sm-6 col-md-6 col-md-offset-1 col-sm-offset-1 main">
            <h2 class="sub-header text-primary">Update category</h2>
            <hr>
                <?php
                    if(!empty($errors)){
                        echo '<div class="alert alert-danger">
                                '.$errors.'
                            </div>';
                    }else{
                        echo $message;
                    }
                ?>
                <form action="editCategory.php?id=<?php echo $categorie['id'];?>" method="post">
                    <div class="form-group">
                        <label for="name">Title:</label>
                        <input type="text" class="form-control" name="name" id="name" value="<?php echo $categorie['name'];?>">
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