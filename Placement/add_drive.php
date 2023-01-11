<?php
include "includes/header.php";

if(isset($_SESSION['name'])&&isset($_SESSION['email'])){
    header("Location: profile.php");
}

$set_value = 0;
$error = '0';
if(isset($_REQUEST['drive_title'])&&isset($_REQUEST['company_id'])&&
    isset($_REQUEST['position'])&&isset($_REQUEST['job_profile'])&&
    isset($_REQUEST['dod'])&&isset($_REQUEST['salary'])&&
    isset($_REQUEST['ssc_result'])&&isset($_REQUEST['hsc_result'])&&
    isset($_REQUEST['graduation_result'])){
    $drive_title = trim($_REQUEST['drive_title']);
    $company_id = trim($_REQUEST['company_id']);
    $position = trim($_REQUEST['position']);
    $job_profile = trim($_REQUEST['job_profile']);
    $job_profile = htmlspecialchars(str_replace("'"," ",$job_profile));
    $dod = trim($_REQUEST['dod']);
    $salary = trim($_REQUEST['salary']);
    $ssc_result = trim($_REQUEST['ssc_result']);
    $hsc_result = trim($_REQUEST['hsc_result']);
    $graduation_result = trim($_REQUEST['graduation_result']);
    $sql = "INSERT INTO drive
            (drive_title, company_id, job_position, job_profile, dod, salary,
             ssc_result, hsc_result, graduation_result)
             VALUES ('$drive_title', '$company_id', '$position', '$job_profile', '$dod',
             '$salary', '$ssc_result', '$hsc_result', '$graduation_result')";
    if ($result = mysqli_query($con, $sql)) {
        echo "<script>alert('Success!');</script>";
        header("Location: profile.php");
    }else
        $error = mysqli_error($con);
        echo "<script>alert('1');</script>";
}
?>
<div class="col-md-9 main">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li><a href="dashboard.php">All Drives</a></li>
                <li class="active"><a href="add_drive.php">Add Drive</a></li>
                <li><a href="add_company.php ">Add Company</a></li>
                <li><a href="all_student.php">All Students</a></li>
            </ul>
        </div>
    </nav>
    <div class="clearfix"> </div>

    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="col-md-1">
        </div>
        <div class="col-md-8"">
        <h4>General Information</h4>
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
            }
            textarea {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                resize: none;
                width: 100%;}
        </style>
        <form method="post" action="add_drive.php" id="add_drive_form">
            <table border="3px" width="100%">
                <tr>
                    <th>Title</th>
                    <td><input type="text" name="drive_title" required></td>
                </tr>
                <tr>
                    <th>Company</th>
                    <td>
                        <select class="form-control" name="company_id" required>
                            <option value=''>Select Company</option>
                            <?php
                            $sql = "SELECT * FROM company ORDER BY company_id DESC ";
                            $result = mysqli_query($con, $sql);
                            while($row = mysqli_fetch_assoc($result)) {
                                $id = $row['company_id'];
                                $name = $row['company_name'];
                                echo "<option value='$id'>$name</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Position</th>
                    <td><input type="text" name="position" required></td>
                </tr>
                <tr>
                    <th>Job Profile</th>
                    <td><textarea rows="9" form="add_drive_form" name="job_profile" required></textarea></td>
                </tr>
                <tr>
                    <th>Date Of Drive</th>
                    <td><input type="date" name="dod"required></td>
                </tr>
                <tr>
                    <th>Salary</th>
                    <td><input type="number" name="salary" required></td>
                </tr>
            </table>
            <br>
            <h4>Criteria</h4>
            <table border="3px" width="100%">
                <tr>
                    <th>SSC Result (in %)</th>
                    <td><input type="number" step="any" name="ssc_result" min="0" max="100" required></td>
                </tr>
                <tr>
                    <th>HSC Result (in %)</th>
                    <td><input type="number" step="any" name="hsc_result" min="0" max="100" required></td>
                </tr>
                <tr>
                    <th>In Graduation (% or cgpa)</th>
                    <td><input type="number" step="any" name="graduation_result" min="0" max="100" required></td>
                </tr>
            </table>
            <br><br><center><a href="edit_profile.php"><input type="submit" value="Save" class="btn-info"></a>
                </center></a><br>
        </form>
    </div>
    <div class="col-md-1"></div>
</div>
<!-- //main -->
<div class="clearfix"> </div>
