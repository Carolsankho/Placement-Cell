<?php
include "includes/header.php";

if(isset($_SESSION['name'])&&isset($_SESSION['email'])){
    header("Location: profile.php");
}
if(isset($_GET['delete'])){
    $id = trim($_GET['delete']);
    $result = "DELETE FROM profile WHERE uid = '$id'";
    if(mysqli_query($con, $result)) {
        $result = "DELETE FROM enrolled_students WHERE user_id = '$id'";
        if(mysqli_query($con, $result)) {
            $result = "DELETE FROM users WHERE user_id = '$id'";
            if (mysqli_query($con, $result)) {
                echo "<script>alert('User Deleted Successfully')</script>";
                header("Location: all_student.php");
            } else {
                echo "<script>alert('Database Error Could not able to execute')</script>";
            }
        }else {
            echo "<script>alert('Database Error Could not able to execute')</script>";
        }
    }else {
        echo "<script>alert('Database Error Could not able to execute')</script>";
    }
}
?>
<div class="col-md-9 main">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li><a href="dashboard.php">All Drives</a></li>
                <li><a href="add_drive.php">Add Drive</a></li>
                <li><a href="add_company.php ">Add Company</a></li>
                <li class="active"><a href="all_student.php">All Students</a></li>
            </ul>
        </div>
    </nav>
    <div class="clearfix"> </div>

    <div class="col-md-1"></div>
    <div class="col-md-10">
        <h3>All Students:</h3>
        <?php
        $sql = "SELECT * FROM users ";
        $result = mysqli_query($con, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $id = $row['user_id'];
            $name = $row['user_name'];
            $email = $row['user_email'];
            echo '
                            <div class="editor-pics">
                                <div class="col-md-10 item-details" style="border: #14bcd5 solid 1px; padding: 10px">
                                    <h5  class="inner two"><a href="student_profile.php?id='.$id.'">'.$name.'</a>
                                    &nbsp&nbsp&nbsp<a href="all_student.php?delete='.$id.'"><i class="glyphicon glyphicon-trash"></a></i>
                                    </h5>
                                </div>
                            </div>
                        ';
        }
        ?>
    </div>
    </div>
    <div class="col-md-1"></div>
</div>
<!-- //main -->
<div class="clearfix"> </div>
