<?php
include "includes/header.php";
$set_value = 1;
$error = '0';
if(isset($_GET['id'])){
    $id = trim($_GET['id']);
    $sql = "SELECT *
               FROM users,profile
               WHERE user_id='$id' AND user_id=uid";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $name = $row['user_name'];
    $email = $row['user_email'];

    if($row['resume']=="")
        $resume = 'dr.pdf';
    else
        $resume = $row['resume'];

    if($row['profile_image']=="")
        $profile_image = 'co.png';
    else
        $profile_image = $row['profile_image'];

    if($row['mobile']=="")
        $mobile = 'Incomplete profile';
    else
        $mobile = $row['mobile'];

    if($row['dob']=="")
        $dob = 'Incomplete profile';
    else
        $dob = $row['dob'];

    if($row['ssc_marks']==0)
        $ssc_marks = 'Incomplete profile';
    else
        $ssc_marks = $row['ssc_marks'];

    if($row['hsc_marks']==0)
        $hsc_marks = 'Incomplete profile';
    else
        $hsc_marks = $row['hsc_marks'];

    if($row['graduation']=="")
        $graduation = 'Incomplete profile';
    else
        $graduation = $row['graduation'];

    if($row['graduation_discipline']=="")
        $graduation_discipline = 'Incomplete profile';
    else
        $graduation_discipline = $row['graduation_discipline'];

    if($row['graduation_marks']==0)
        $graduation_marks = 'Incomplete profile';
    else
        $graduation_marks = $row['graduation_marks'];

    if($row['post_graduation']=="")
        $post_graduation = '-';
    else
        $post_graduation = $row['post_graduation'];

    if($row['post_graduation_discipline']=="")
        $post_graduation_discipline = '-';
    else
        $post_graduation_discipline = $row['post_graduation_discipline'];

    if($row['post_graduation_marks']==0)
        $post_graduation_marks = '-';
    else
        $post_graduation_marks = $row['post_graduation_marks'];

    if($row['gender']=="")
        $gender = 'Incomplete profile';
    else
        $gender = $row['gender'];
}
?>
    <div class="col-md-12 main" style="padding-top: 20px;">
        <!-- login-page -->
        <div class="col-md-3" >
            <center>
                <img src="image_uploads/<?php echo $profile_image; ?>" width="150px" class="img-responsive" alt="profile-Image">
            </center>
        </div>
        <div class="col-md-5">
            <div class="outer">
                <div class="middle">
                    <div class="inner">
                        <h1><?php echo $name; ?></h1>
                        <p><?php echo $email; ?></p>
                        <br>
                        <div class="col-md-6">
                            <h4><a href="resume_uploads/<?php echo $resume; ?>" target="_blank"><u><i class="glyphicon glyphicon-file"></i>View Resume</u></a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="col-md-12 main" style="padding-top: 20px;">
        <div class="col-md-1">
        </div>
        <div class="col-md-8"">
        <h4>Personal Detail</h4>
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }

            th, td {
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even){background-color: #f2f2f2}

            th {
                background-color: rgba(18, 149, 201, 0.69);
                color: white;
            }
        </style>
        <table border="3px" width="100%">
            <tr>
                <th>Name</th>
                <td><?php echo $name; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $email; ?></td>
            </tr>
            <tr>
                <th>Mobile No.</th>
                <td><?php echo $mobile; ?></td>
            </tr>
            <tr>
                <th>Date Of Birth</th>
                <td><?php echo $dob; ?></td>
            </tr>
            <tr>
                <th>Gender</th>
                <td><?php echo $gender; ?></td>
            </tr>
        </table>
        <br>
        <h4>Educational Detail</h4>
        <table border="3px" width="100%">
            <tr>
                <th>SSC marks</th>
                <td><?php echo $ssc_marks; ?></td>
            </tr>
            <tr>
                <th>HSC Marks</th>
                <td><?php echo $hsc_marks; ?></td>
            </tr>
            <tr>
                <th>Graduation</th>
                <td><?php echo $graduation; ?></td>
            </tr>
            <tr>
                <th>&nbsp&nbsp&nbsp&nbsp&nbspGraduation Discipline</th>
                <td><?php echo $graduation_discipline; ?></td>
            </tr>
            <tr>
                <th>&nbsp&nbsp&nbsp&nbsp&nbspIn Graduation (% or cgpa)</th>
                <td><?php echo $graduation_marks; ?></td>
            </tr>
            <tr>
                <th>Post Graduation (Optional)</th>
                <td><?php echo $post_graduation; ?></td>
            </tr>
            <tr>
                <th>&nbsp&nbsp&nbsp&nbsp&nbspPost Graduation Discipline</th>
                <td><?php echo $post_graduation_discipline; ?></td>
            </tr>
            <tr>
                <th>&nbsp&nbsp&nbsp&nbsp&nbspIn Post Graduation (% or cgpa)</th>
                <td><?php echo $post_graduation_marks; ?></td>
            </tr>
        </table>
        <br><br>
    </div>
<div class="clearfix"></div>
    <div class="col-md-1"></div>
    <div class="col-md-10">
    <h4>Companies that are enrolled</h4>
        <?php
        $sql = "SELECT * FROM company 
                WHERE company_id IN 
                (
                  SELECT company_id
                  FROM drive
                  WHERE drive_id IN 
                  (
                    SELECT drive_id
                    FROM enrolled_students
                    WHERE user_id='$id'
                  )
                )";
        $result = mysqli_query($con, $sql);
        while($row = mysqli_fetch_assoc($result)){
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
                            </div><br><br>
                        ';
        }
        ?>
    </div>
    <div class="col-md-1"></div>
<div class="clearfix"></div>
    </div>
    </div>
    <!-- //login-page -->
    <div class="clearfix"> </div>