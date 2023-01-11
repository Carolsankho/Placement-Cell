<?php
include "includes/header.php";
$set_value = 1;
$error = '0';

    if(isset($_REQUEST['name'])) {

        $id = trim($_SESSION['id']);
        $name = trim($_REQUEST['name']);
        $email = trim($_REQUEST['email']);
        $email = trim($_REQUEST['email']);
        $mobile = trim($_REQUEST['mobile']);
        $dob = trim($_REQUEST['dob']);
        if($dob!="") {
            $dob = DateTime::createFromFormat('Y-m-d', $dob);
            $dob = $dob->format('d/m/Y');
        }
        $gender= trim($_REQUEST['gender']);

        if(trim($_REQUEST['ssc_marks'])=="")
            $ssc_marks = 0;
        else
            $ssc_marks = trim($_REQUEST['ssc_marks']);

        if(trim($_REQUEST['hsc_marks'])=="")
            $hsc_marks = 0;
        else
            $hsc_marks = trim($_REQUEST['hsc_marks']);
        $graduation = trim($_REQUEST['graduation']);
        $graduation_discipline = trim($_REQUEST['graduation_discipline']);

        if(trim($_REQUEST['graduation_marks'])=="")
            $graduation_marks = 0;
        else
            $graduation_marks = trim($_REQUEST['graduation_marks']);

        $post_graduation = trim($_REQUEST['post_graduation']);
        $post_graduation_discipline = trim($_REQUEST['post_graduation_discipline']);

        if(trim($_REQUEST['post_graduation_marks'])=="")
            $post_graduation_marks = 0;
        else
            $post_graduation_marks = trim($_REQUEST['post_graduation_marks']);

        $result = "UPDATE users
                   SET user_name='$name', user_email ='$email' 
                   WHERE user_id='$id'";

        $result1 = "UPDATE profile
                   SET mobile='$mobile', dob ='$dob', gender = '$gender',
                       ssc_marks = $ssc_marks, hsc_marks = $hsc_marks,
                       graduation = '$graduation', graduation_discipline = '$graduation_discipline',
                       graduation_marks = $graduation_marks, post_graduation = '$post_graduation',
                       post_graduation_discipline = '$post_graduation_discipline',
                       post_graduation_marks = $post_graduation_marks
                   WHERE uid=$id";
        if (mysqli_query($con, $result)) {
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            if (mysqli_query($con, $result1)) {
                echo "<script>alert('Success!');</script>";
                header("Location: profile.php");
            }else
                echo "<script>alert('". $result." ".mysqli_error($con) ."');</script>";
            //header("Location: login.php");
        } else {
            echo "<script>alert('Errors are encountered!');</script>";
        }
    }
if(!(isset($_SESSION['name'])&&isset($_SESSION['email'])))
    header("Location: login.php");
else {
    $id = trim($_SESSION['id']);
    $sql = "SELECT *
               FROM profile
               WHERE uid='$id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $name = $_SESSION['name'];
    $email = $_SESSION['email'];

    if($row['profile_image']=="")
        $profile_image = 'co.png';
    else
        $profile_image = $row['profile_image'];

    if($row['resume']=="")
        $resume = 'dr.pdf';
    else
        $resume = $row['resume'];

    if($row['mobile']=="")
        $mobile = '';
    else
        $mobile = $row['mobile'];

    if($row['dob']=="")
        $dob = '';
    else {
        $dob = $row['dob'];
        $dob = DateTime::createFromFormat('d/m/Y', $dob);
        $dob = $dob->format('Y-m-d');
    }

    if($row['ssc_marks']=="")
        $ssc_marks = '';
    else
        $ssc_marks = $row['ssc_marks'];

    if($row['hsc_marks']=="")
        $hsc_marks = '';
    else
        $hsc_marks = $row['hsc_marks'];

    if($row['graduation']=="")
        $graduation = '';
    else
        $graduation = $row['graduation'];

    if($row['graduation_discipline']=="")
        $graduation_discipline = '';
    else
        $graduation_discipline = $row['graduation_discipline'];

    if($row['graduation_marks']=="")
        $graduation_marks = '';
    else
        $graduation_marks = $row['graduation_marks'];

    if($row['post_graduation']=="")
        $post_graduation = '';
    else
        $post_graduation = $row['post_graduation'];

    if($row['post_graduation_discipline']=="")
        $post_graduation_discipline = '';
    else
        $post_graduation_discipline = $row['post_graduation_discipline'];

    if($row['post_graduation_marks']=="")
        $post_graduation_marks = '';
    else
        $post_graduation_marks = $row['post_graduation_marks'];

    if($row['gender']=="")
        $gender = '';
    else
        $gender = $row['gender'];
}
?>
    <div class="col-md-12 main" style="padding-top: 20px;">
        <!-- login-page -->
        <div class="col-md-3" >
            <center>
                <img src="image_uploads/<?php echo $profile_image; ?>" width="150px" class="img-responsive" alt="profile-Image">
                <br>
                <form action="image_upload.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="fileToUpload" accept="image/jpeg" id="fileToUpload"  class="btn-primary" style="width: 100%">
                    <input type="submit" value="Upload Your Profile image" name="submit"  class="btn-info">
                </form>
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
                        <div class="col-md-6">
                            <form method="post" action="resume_upload.php" enctype='multipart/form-data'>
                                <p>New Upload
                                    <input type="file" name="fileToUpload" accept="application/pdf" class="btn-primary" id="fileToUpload">
                                    <input type="submit" value="Upload Resume" name="submit" class="btn-info">
                                </p>
                            </form>
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
            input[type="text"] {
                width: 100%;
                box-sizing: border-box;
                -webkit-box-sizing:border-box;
                -moz-box-sizing: border-box;
            }
            input[type=date] {
                             height: 35px;
                             margin: 0 auto;
                             width: 100%;
                             font-family: arial, sans-serif;
                             font-size: 18px;
                             font-weight: bold;
                             text-transform: uppercase;
                             outline: none;
                             border: 0;
                             border-radius: 3px;
                             padding: 0 3px;
                             color: #748b88;
                         }/* Radio */

            input[type="radio"] {
                background: #ddd -webkit-linear-gradient(0deg, transparent 20%, hsla(0, 0%, 100%, .7), transparent 80%),
                -webkit-linear-gradient(90deg, transparent 20%, hsla(0, 0%, 100%, .7), transparent 80%);
                border-radius: 10px;
                box-shadow: inset 0 1px 1px hsla(0,0%,100%,.8),
                0 0 0 1px hsla(0,0%,0%,.6),
                0 2px 3px hsla(0,0%,0%,.6),
                0 4px 3px hsla(0,0%,0%,.4),
                0 6px 6px hsla(0,0%,0%,.2),
                0 10px 6px hsla(0,0%,0%,.2);
                cursor: pointer;
                display: inline-block;
                height: 15px;
                margin-right: 15px;
                position: relative;
                width: 15px;
                -webkit-appearance: none;
            }
            input[type="radio"]:after {
                background-color: #444;
                border-radius: 25px;
                box-shadow: inset 0 0 0 1px hsla(0,0%,0%,.4),
                0 1px 1px hsla(0,0%,100%,.8);
                content: '';
                display: block;
                height: 7px;
                left: 4px;
                position: relative;
                top: 4px;
                width: 7px;
            }
            input[type="radio"]:checked:after {
                background-color: #f66;
                box-shadow: inset 0 0 0 1px hsla(0,0%,0%,.4),
                inset 0 2px 2px hsla(0,0%,100%,.4),
                0 1px 1px hsla(0,0%,100%,.8),
                0 0 2px 2px hsla(0,70%,70%,.4);
            }
        </style>
        <form method="post" action="edit_profile.php">
        <table border="3px" width="100%">
            <tr>
                <th>Name</th>
                <td><input type="text" name="name" value="<?php echo $name; ?>"></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><input type="text" name="email" value="<?php echo $email; ?>"></td>
            </tr>
            <tr>
                <th>Mobile No.</th>
                <td><input type="text" name="mobile" value="<?php echo $mobile; ?>" min="7099999999" max="9999000000"  maxlength="10"></td>
            </tr>
            <tr>
                <th>Date Of Birth</th>
                <td><input type="date" name="dob" value="<?php echo $dob; ?>"></td>
            </tr>
            <tr>
                <th>Gender</th>
                <td>
                    <?php
                        if($gender=="Male")
                            echo '<input type="radio" name="gender" value="Male" checked> Male<br>';
                        else
                            echo '<input type="radio" name="gender" value="Male"> Male<br>';
                        if($gender=="Female")
                            echo '<input type="radio" name="gender" value="Female" checked> Female<br>';
                        else
                            echo '<input type="radio" name="gender" value="Female"> Female<br>';
                        if($gender=="Other")
                            echo '<input type="radio" name="gender" value="Other" checked> Other<br>';
                        else
                            echo '<input type="radio" name="gender" value="Other"> Other<br>';
                    ?>
                </td>
            </tr>
        </table>
        <br>
        <h4>Educational Detail</h4>
        <table border="3px" width="100%">
            <tr>
                <th>SSC marks</th>
                <td><input type="number" step="any" name="ssc_marks" value="<?php echo $ssc_marks; ?>" min="0" max="100"></td>
            </tr>
            <tr>
                <th>HSC Marks</th>
                <td><input type="number" step="any" name="hsc_marks" value="<?php echo $hsc_marks; ?>" min="0" max="100"></td>
            </tr>
            <tr>
                <th>Graduation</th>
                <td><input type="text" name="graduation" value="<?php echo $graduation; ?>"></td>
            </tr>
            <tr>
                <th>&nbsp&nbsp&nbsp&nbsp&nbspGraduation Discipline</th>
                <td><input type="text" name="graduation_discipline" value="<?php echo $graduation_discipline; ?>"></td>
            </tr>
            <tr>
                <th>&nbsp&nbsp&nbsp&nbsp&nbspIn Graduation (% or cgpa)</th>
                <td><input type="number" step="any" name="graduation_marks" value="<?php echo $graduation_marks; ?>" min="0" max="100"></td>
            </tr>
            <tr>
                <th>Post Graduation (Optional)</th>
                <td><input type="text" name="post_graduation" value="<?php echo $post_graduation; ?>"></td>
            </tr>
            <tr>
                <th>&nbsp&nbsp&nbsp&nbsp&nbspPost Graduation Discipline</th>
                <td><input type="text" name="post_graduation_discipline" value="<?php echo $post_graduation_discipline; ?>"></td>
            </tr>
            <tr>
                <th>&nbsp&nbsp&nbsp&nbsp&nbspIn Post Graduation (% or cgpa)</th>
                <td><input type="number" step="any" name="post_graduation_marks" value="<?php echo $post_graduation_marks; ?>" min="0" max="100"></td>
            </tr>
        </table>
        <br><br><center><a href="edit_profile.php"><input type="submit" value="Save" class="btn-info"></a>
       <a href="profile.php"><input type="button" value="Back to profile" class="btn-info"></center></a><br>
        </form>
    </div>
    </div>
    <div class="clearfix"></div>
    </div>
    </div>
    <!-- //login-page -->
    <div class="clearfix"> </div>
<?php
include "includes/footer.php";
?>