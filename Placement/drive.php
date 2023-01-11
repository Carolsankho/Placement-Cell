<?php
include "includes/header.php";


if(!isset($_SESSION['name'])&&!isset($_SESSION['email'])){
    header("Location: profile.php");
}
$done =1;
if(isset($_GET['id'])){
    $get_id = trim($_GET['id']);
    $user_id = trim($_SESSION['id']);
    $sql = "SELECT * FROM drive,company WHERE drive.company_id=company.company_id AND drive_id='$get_id'";
    $result = mysqli_query($con, $sql);
    if($row = mysqli_fetch_assoc($result)) {
        $drive_id = trim($row['drive_id']);
        $drive_title = trim($row['drive_title']);
        $company_name = trim($row['company_name']);
        $company_branch = trim($row['company_branch']);
        $company_url = trim($row['company_url']);
        $position = trim($row['job_position']);
        $job_profile = trim($row['job_profile']);
        $job_profile = htmlspecialchars(str_replace("'"," ",$job_profile));
        $dod = trim($row['dod']);
        $salary = trim($row['salary']);
        $ssc_result = trim($row['ssc_result']);
        $hsc_result = trim($row['hsc_result']);
        $graduation_result = trim($row['graduation_result']);
    }else{
        header("Location: dashboard.php");
    }
    $sql = "SELECT * FROM enrolled_students WHERE user_id=$user_id AND drive_id=$get_id";
    $result = mysqli_query($con, $sql);
    if($row = mysqli_fetch_assoc($result)) {
        $done = 0;
    }

}else{
    header("Location: dashboard.php");
}

?>
    <div class="col-md-9 main">
    <!--banner-section-->
    <div class="banner-section">
        <h3 class="tittle"><a href="home.php"><span class="glyphicon glyphicon-arrow-left"></span> </a> Apply Now
            <!--/top-currents-->
        <div class="top-news">
            <div class="top-inner">
                <?php
                echo '
                        <div class="col-md-6 top-text" style="border: #d58512 solid 1px; padding: 20px">
                                <img src="company_image.php?name='.$company_name.'&branch='.$company_branch.'&salary='.$salary.'&date='.$dod.'"
                                 class="img-responsive btn-social"  alt="">
                        </div>
                        <div class="col-md-6 top-text" style="padding: 20px">
                                <h3 class="top">'.$drive_title.'</h3>
                                    <p>On '.$dod.'<a class="span_link"></a></p><br><br>
                                    <h4>Eligibility Criteria:</h4>
                                    <div style="font-size: medium;font-weight: initial;padding: 10px;">
                                        <p>Minimum SSC %: '.$ssc_result.'</p>
                                        <p>Minimum hSC %: '.$hsc_result.'</p>
                                        <p>Minimum graduation %: '.$graduation_result.'</p>
                                    </div>
                        </div>
                        <div class="col-md-8 top-text" style="padding: 20px">
                                    <h4>Job Profile:</h4>
                                    <div style="font-size: medium;font-weight: initial;padding: 10px;">
                                        <p>'.nl2br($job_profile).'</p>
                                    </div>
                        </div>
                        <div class="col-md-4 top-text" style="padding: 20px">
                                    <h4>Company Detail:</h4>
                                    <div style="font-size: medium;font-weight: initial;padding: 10px;">
                                        <p>Company Name: '.$company_name.'</p>
                                        <p>Company Branch %: '.$company_branch.'</p>
                                        <h4 style="color: #d58512"><u><i><a href="http://'.$company_url.'" target="_blank"> '.$company_url.'</a></u></i></h4>
                ';
                if($done==1)
                echo '
                                        <div style="font-size:25px;font-weight: initial;padding-top: 25px;">
                                            <button class="btn-info"><a href="apply_now.php?id='.$drive_id.'">Enroll Now</a></button>
                                        </div>
                ';
                else
                    echo "<h5 style='padding-top: 20px'>You are Enrolled </h5>";

                echo '
                                    </div>
                                </div>
                ';
                ?>
            </div>
            <div class="clearfix"> </div>
        </div>
        <!--//top-current-->
    </div>
    <!--//banner-section-->
    <div class="banner-right-text">
        <h3 class="tittle">Top-Compannies</h3>
        <!--/general-news-->
        <div class="general-news">
            <div class="general-inner">
                <div class="edit-pics">
                    <?php
                    $sql = "SELECT *
                                    FROM company,drive 
                                    WHERE company.company_id=drive.company_id
                                    GROUP BY drive.company_id
                                    ORDER BY count(drive.company_id) desc
                                    LIMIT 5";
                    $result = mysqli_query($con, $sql);
                    while($row = mysqli_fetch_assoc($result)) { {
                        $id = $row['company_id'];
                        $name = $row['company_name'];
                        $branch = $row['company_branch'];
                        $url = $row['company_url'];

                        echo '
                                    <div class="editor-pics">
                                        <div class="col-md-10 item-details" style="border: #14bcd5 solid 1px; padding: 10px">
                                    <h4 class="inner two"><a href="view_company.php?id='.$id.'">'.$name.'</a>
                                    </h4>
                                    <h5>&nbspBranch: '.$branch.'&nbsp&nbsp&nbsp
                                    <a href="http://'.$url.'" target="_blank">'.$url.'</a>
                                    </h5>
                                </div>
                                    <div class="clearfix"></div>
                                    ';
                    }
                    }
                    ?>
                </div>
                </div>

                </div>
            </div>
        </div>
        <!--/companies-->
    </div>
    </div>
    </div>
    <div class="clearfix"> </div>
    <!--/footer-->
<?php
include "includes/footer.php";
?>