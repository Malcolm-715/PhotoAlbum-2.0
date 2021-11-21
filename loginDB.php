<?php
session_start();

$conn = mysqli_connect('localhost', 'root','');
mysqli_select_db($conn,'album_photo');
if(!$conn){
    echo "Connection failed!";
    exit();
}else{
    if(isset($_POST['btn-submit'])){
        $name = $_POST['user_name'];
        $email = $_POST['user_email'];
        $password = $_POST['user_password'];
        $image = $_FILES['user_image']['name'];

        $allowed_extension = array('jpg','jpeg','png','gif');
        $filename = $_FILES["user_image"]["name"];
        $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
        if(!in_array($file_extension, $allowed_extension)){
            $_SESSION['status'] = "ONLY jpg,jpeg,png,gif Files Allowed!";
            header('Location: login.php');
        }else{
            if(file_exists("uploads/".$_FILES["user_image"]["name"])){
                $filename = $_FILES["user_image"]["name"];
                $_SESSION['status'] = "Image Already Exists! ".$filename;
                header('Location: login.php');
            }else{
                $query = "INSERT INTO register(user_name, user_email, user_password, user_image) VALUES('$name',' $email',' $password',' $image')";
                $query_run = mysqli_query($conn, $query);
                
                if($query_run){
                    move_uploaded_file($_FILES["user_image"]["tmp_name"], "uploads/".$_FILES["user_image"]["name"]);
                    $_SESSION['status'] = "Image Successfully Uploaded!";
                    header('Location: login.php');
                }else{
                    $_SESSION['status'] = "Image Not Uploaded!";
                    header('Location: login.php');
                }
            }
        }
    }
}

if(isset($_POST['update_user_image'])){
    // $id = $_POST['user_id'];
    $name = $_POST['user_name'];
    $email = $_POST['user_email'];
    $password = $_POST['user_password'];
    $new_image = $_FILES['user_image']['name'];
    $old_image = $_POST['user_image_old'];

    if($new_image != ''){
        $update_filename = $_FILES['user_image']['name'];
    }else{
        $update_filename = $old_image;
    }
    if($_FILES['user_image']['name']){
        if(file_exists("uploads/".$_FILES["user_image"]["name"])){
            $filename = $_FILES["user_image"]["name"];
            $_SESSION['status'] = "Image Already Exists! ".$filename;
            header('Location: index.php');
        }    
    }else{
        $query = "UPDATE register SET user_name='$name', user_email='$email', user_password='$password', user_image='$update_filename' WHERE user_id ='$id'";
        $query_run = mysqli_query($conn, $query);

        if($query_run){
            if($_FILES['user_image']['name'] != ''){
                move_uploaded_file($_FILES["user_image"]["tmp_name"], "uploads/".$_FILES['user_image']['name']);
                unlink("uploads/".$old_image);
            }
            $_SESSION['status'] = "Data Updated Successfully!";
            header('Location: index.php');
        }else{
            $_SESSION['status'] = "Data Update Not Successfully!";
            header('Location: index.php');
        }
    }
}

if(isset($_POST['delete_user_image'])){
    $id = $_POST['delete_id'];
    $user_image = $_POST['delete_image'];

    $query = "DELETE FROM register WHERE user_id='$id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run){
        unlink("uploads/".$user_image);
        $_SESSION['status'] = "Data Deleted Successfully!";
        header('Location: index.php');
    }else{
        $_SESSION['status'] = "Data Not Deleted!";
        header('Location: index.php');  
    }
}





?>