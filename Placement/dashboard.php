<?php
include "includes/header.php";

if(isset($_SESSION['name'])&&isset($_SESSION['email'])){
    header("Location: home.php");
}

$set_value = 0;
$error = '0';
if(isset($_REQUEST['email'])&&isset($_REQUEST['pass'])){
    $email = trim($_REQUEST['email']);
    $pass = md5(trim($_REQUEST['pass']));
    $sql = "SELECT *
               FROM users
               WHERE user_email='$email'
               AND user_pass='$pass'";
    $result = mysqli_query($con, $sql);
    $num_rows = mysqli_num_rows($result);
    if($num_rows>0){
        $row = mysqli_fetch_array($result);
        $_SESSION['id'] = $row['user_id'];
        $_SESSION['name'] = $row['user_name'];
        $_SESSION['email'] = $row['user_email'];
        header("Location: profile.php");
    } else{
        $set_value = 1;
        $error = "Invalid Email or Password";
    }
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
            <?php
            $sql = "SELECT * FROM drive,company WHERE drive.company_id=company.company_id";
            $result = mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                $drive_id = trim($row['drive_id']);
                $drive_title = trim($row['drive_title']);
                $company_name = trim($row['company_name']);
                $company_branch = trim($row['company_branch']);
                $company_url = trim($row['company_url']);
                $position = trim($row['job_position']);
                $job_profile = trim($row['job_profile']);
                $dod = trim($row['dod']);
                $salary = trim($row['salary']);
                $ssc_result = trim($row['ssc_result']);
                $hsc_result = trim($row['hsc_result']);
                $graduation_result = trim($row['graduation_result']);
                echo '<div class="col-md-3 top-text" style="border: #000000 solid 2px; padding: 5px;  margin:20px;">
                                <a href="view_drive.php?id='.$drive_id.'">
                                <img src="company_image.php?name='.$company_name.'&branch='.$company_branch.'&salary='.$salary.'&date='.$dod.'"
                                 class="img-responsive" class="btn-social"  alt=""></a>
                                <h5 class="top"><a href="view_drive.php?id='.$drive_id.'">'.substr($drive_title,0,18).'..</a></h5>
                                <p>'.$dod.'<a class="span_link" href="#">
                                <!--p>'.nl2br($job_profile).'<a class="span_link" href="#"-->
                            </div>';
            }
            ?>
        </div>
        <div class="col-md-1"></div>
    </div>
    <!-- //main -->
    <div class="clearfix"> </div>
