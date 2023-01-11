<?php
session_start();
$con = mysqli_connect("localhost","root","","trinfosoft_entertainment");
if(isset($_SESSION['name'])) {
    $user_id = $_SESSION['id'];
    $target_dir = "image_uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $image_name = "img_".$user_id;
// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "<script>alert('File is not an image'); </script>";
            $uploadOk = 0;
        }
    }
// Check if file already exists
    if (file_exists($target_file)) {
        echo "<script>alert('Sorry, file already exists'); </script>";
        unlink($target_file);
        $uploadOk = 1;
    }
// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "<script>alert('Sorry, your file is too large'); </script>";
        $uploadOk = 0;
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.'); </script>";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<script>alert('Sorry, Your file is not uploaded'); </script>";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "image_uploads/".$image_name.".".$imageFileType)) {
            $result = "UPDATE profile
                       SET profile_image='$image_name.$imageFileType'
                       WHERE uid=$user_id";
            if (mysqli_query($con, $result)) ;
               header("Location: profile.php");
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file'); </script>";
        }
    }
}
?>