<?php include('includes/header.php');?>
<?php 
if(!isset($_SESSION['admin'])){
    header("location:login.php");
}
$errors = [];
$message = "";
if(isset($_POST['submit'])){
    if(empty($_POST['title'])){
        $errors = "The title field is required";
    }else if(empty($_POST['body'])){
        $errors = "The body field is required";
    }else if(empty($_POST['categorie'])){
        $errors = "The category field is required";
    }else{
        $title = mysqli_escape_string($con,$_POST['title']);
        $body = mysqli_escape_string($con,$_POST['body']);
        $categorie = mysqli_escape_string($con,$_POST['categorie']);
        $image = mysqli_escape_string($con,$_FILES['image']["name"]);
        //upload image to images
        $directory = "images/";
        $file = $directory.basename($_FILES["image"]["name"]);
        $author =  $_SESSION['admin_name'];    
        $created = date('Y-m-d H:s:m');
        $query = "INSERT INTO articles (title,body,image,author,category_id,created) values('$title','$body','$image','$author','$categorie','$created')";
        if(mysqli_query($con,$query)){
            move_uploaded_file($_FILES["image"]["tmp_name"], $file);
            $message = '<div class="alert alert-success">
                       Post Added
                  </div>';
        }else{
             echo '<div class="alert alert-danger">Something went wrong'.mysqli_error($con).'</div>';
        }
    }
}
?>
<div class="container-fluid">
    <div class="row" style="margin-top: 30px;">
        <div class="col-sm-3 col-md-2 sidebar">
           <?php include('includes/sidebar.php');?>
        </div>
            <div class="col-sm-6 col-md-6 col-md-offset-1 col-sm-offset-1 main">
            <h2 class="sub-header text-primary">Add new post</h2>
            <hr>
                <?php
                    if(!empty($errors)){
                        echo '<div class="alert alert-danger">
                                '.$errors.'
                            </div><br>';
                    }else{
                        echo $message;
                    }
                ?>
                <form action="addPost.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="categorie">Category:</label>
                        <select name="categorie" id="categorie" class="form-control">
                            <option  selected="" disabled>Choose a category</option>
                            <?php
                                $query = "SELECT * FROM categories";
                                if(mysqli_query($con,$query)):
                                    $result = mysqli_query($con,$query);
                                    while($row = $result->fetch_assoc()):
                            ?>
                                <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                            <?php
                                endwhile;
                                endif;
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label for="body">Body:</label>
                        <textarea  class="form-control" rows="5" cols="30" name="body" id="body" placeholder="Body"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Photo:</label>
                        <input type="file" class="form-control" name="image" id="image">
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