<?php
include "includes/header.php";

$apply = 0;
$error_fill_form = 0;
if(!isset($_SESSION['name'])&&!isset($_SESSION['email'])){
   // header("Location: profile.php");
}

if(isset($_GET['id'])){
    $get_id = trim($_GET['id']);
    $user_id = trim($_SESSION['id']);
    if(isset($_GET['apply'])) {
        $apply = trim($_GET['apply']);
        if($apply == $get_id){
            $sql = "INSERT INTO enrolled_students VALUES ('$user_id','$get_id')";
            if(mysqli_query($con, $sql)){
                header("Location: drive.php?id=".$get_id);
            }else{
                echo "<script>alert('Error!')</script>";
            }
        }else{
            echo "<script>alert('Error! 1')</script>";
        }
    }
    $sql = "SELECT * FROM drive,company WHERE drive.company_id=company.company_id AND drive_id='$get_id'";
    $result = mysqli_query($con, $sql);
    if($row = mysqli_fetch_assoc($result)) {
        $sql = "SELECT * FROM profile WHERE uid='$user_id'";
        $result1 = mysqli_query($con, $sql);
        $row1 = mysqli_fetch_assoc($result1);
        $resume = trim($row1['resume']);
        $drive_id = trim($row['drive_id']);
        $ssc_result = trim($row['ssc_result']);
        $hsc_result = trim($row['hsc_result']);
        $graduation_result = trim($row['graduation_result']);
        $ssc_marks = trim($row1['ssc_marks']);
        $hsc_marks = trim($row1['hsc_marks']);
        $graduation_marks = trim($row1['graduation_marks']);
        $mobile = $row1['mobile'];
        $dob = $row1['dob'];
        $gender = $row1['gender'];
        $graduation = $row1['graduation'];
        $graduation_discipline = $row1['graduation_discipline'];

        if($resume!=""&&$mobile!=""&&$dob!=""&&$gender!=""&&$graduation!=""&&$graduation_discipline!=""){
            $error_fill_form = 1;
            if($ssc_result<=$ssc_marks&&$hsc_result<=$hsc_marks&&$graduation_result<=$graduation_marks)
                $apply = 1;
        }

        if($resume=="") $resume = "dr.pdf";
    }else{
        header("Location: home.php");
    }
}else{
    header("Location: home.php");
}

?>
    <div class="col-md-9 main">
    <!--banner-section-->
    <div class="banner-section">
        <h3 class="tittle"><a href="drive.php?id=<?php echo $drive_id; ?>"><span class="glyphicon glyphicon-arrow-left"></span> </a> Drive detail
            <!--/top-currents-->
            <div class="top-news">
                <div class="top-inner">
                    <style>
                        .button {
                            background-color: #004A7F;
                            -webkit-border-radius: 10px;
                            border-radius: 10px;
                            border: none;
                            color: #FFFFFF;
                            cursor: pointer;
                            display: inline-block;
                            font-family: Arial;
                            font-size: 20px;
                            padding: 5px 10px;
                            text-align: center;
                            text-decoration: none;
                        }
                        @-webkit-keyframes glowing {
                            0% { background-color: #B20000; -webkit-box-shadow: 0 0 3px #B20000; }
                            50% { background-color: #FF0000; -webkit-box-shadow: 0 0 40px #FF0000; }
                            100% { background-color: #B20000; -webkit-box-shadow: 0 0 3px #B20000; }
                        }

                        @-moz-keyframes glowing {
                            0% { background-color: #B20000; -moz-box-shadow: 0 0 3px #B20000; }
                            50% { background-color: #FF0000; -moz-box-shadow: 0 0 40px #FF0000; }
                            100% { background-color: #B20000; -moz-box-shadow: 0 0 3px #B20000; }
                        }

                        @-o-keyframes glowing {
                            0% { background-color: #B20000; box-shadow: 0 0 3px #B20000; }
                            50% { background-color: #FF0000; box-shadow: 0 0 40px #FF0000; }
                            100% { background-color: #B20000; box-shadow: 0 0 3px #B20000; }
                        }

                        @keyframes glowing {
                            0% { background-color: #B20000; box-shadow: 0 0 3px #B20000; }
                            50% { background-color: #FF0000; box-shadow: 0 0 40px #FF0000; }
                            100% { background-color: #B20000; box-shadow: 0 0 3px #B20000; }
                        }

                        .button {
                            -webkit-animation: glowing 1500ms infinite;
                            -moz-animation: glowing 1500ms infinite;
                            -o-animation: glowing 1500ms infinite;
                            animation: glowing 1500ms infinite;
                        }
                    </style>
                    <?php
                    if($apply == 1)
                    echo '
                        <div class="col-md-12 top-text" style=" padding: 20px">
                            <h4>You Are Eligible to Enroll &nbsp&nbsp<a href="apply_now.php?apply='.$drive_id.'&id='.$drive_id.'"><button class="button">Apply</button></a></h4>
                        </div>';
                    else
                        echo '
                        <div class="col-md-12 top-text" style=" padding: 20px">
                            <h4>Sorry, You Are Not Eligible to Enroll</h4>
                        </div>';

                    if($error_fill_form == 0)
                        echo '
                        <div class="col-md-12 top-text" style="padding: 20px">
                            <h5 >Kindly Update Your Profile</h5>
                        </div>';

                       echo ' <div class="col-md-12 top-text" style="padding: 20px">
                            <center><h3 style="padding-top: 20px">Check Your Resume</h3></center>
                            <iframe src="resume_uploads/'.$resume.'" width="100%" style="height:500px;"></iframe>
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
                                        <div class="col-md-10 item-details" style="border: #14bcd5 solid 1px; padding: 10px;margin: 10px">
                                    <h4 class="inner two"><a href="view_company.php?id='.$id.'">'.$name.'</a>
                                    </h4>
                                    <h5>&nbspBranch: '.$branch.'&nbsp&nbsp&nbsp
                                    <a href="http://'.$url.'" target="_blank">'.$url.'</a>
                                    </h5>
                                </div>
                                    ';
                    }
                    }
                    ?>
                </div>
            </div>
        </div>
        <!--/companies-->
    </div></div></div></div></div>
    <div class="clearfix"> </div>
    <!--/footer-->
<?php
include "includes/footer.php";
?>