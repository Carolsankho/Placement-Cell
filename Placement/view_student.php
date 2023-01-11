<?php
include "includes/header.php";

if(isset($_SESSION['name'])&&isset($_SESSION['email'])){
    header("Location: profile.php");
}

    if(isset($_GET['id'])) {
        $get_id = $_GET['id'];
    }else{
        header("Location: home.php");
    }
?>
<div class="col-md-9 main">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li class="active"><a href="dashboard.php">All Drives</a></li>
                <li><a href="add_drive.php">Add Drive</a></li>
                <li><a href="add_company.php ">Add Company</a></li>
                <li><a href="all_student.php">All Students</a></li>
            </ul>
        </div>
    </nav>
    <div class="clearfix"> </div>

    <div class="col-md-1"></div>
    <div class="col-md-10">
        <h3>Enrolled Students:</h3>
        <?php
        $sql = "SELECT * FROM users,enrolled_students 
                WHERE enrolled_students.drive_id='$get_id' AND enrolled_students.user_id=users.user_id";
        $result = mysqli_query($con, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $id = $row['user_id'];
            $name = $row['user_name'];
            $email = $row['user_email'];
            echo '
                            <div class="editor-pics">
                                <div class="col-md-10 item-details" style="border: #14bcd5 solid 1px; padding: 10px">
                                    <h3 class="inner two"><a href="student_profile.php?id='.$id.'">'.$name.'</a>
                                    </h3>
                                    <p>&nbspEmail: '.$email.'</p>
                                </div>
                            </div>
                        ';
        }
        ?>
    </div>
    <div class="col-md-1"></div>
</div>
<!-- //main -->
<div class="clearfix"> </div>
