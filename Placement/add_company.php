<?php
include "includes/header.php";

if(isset($_SESSION['name'])&&isset($_SESSION['email'])){
    header("Location: profile.php");
}
if(isset($_REQUEST['name'])&&isset($_REQUEST['branch'])&&isset($_REQUEST['url'])){
    $name = trim($_REQUEST['name']);
    $branch = trim($_REQUEST['branch']);
    $url =trim($_REQUEST['url']);
    $result = "INSERT INTO company (company_name,company_branch,company_url) values('$name','$branch','$url')";
    if(mysqli_query($con, $result)){
        echo "<script>alert('Company Added Successfully')</script>";
        header("Location: add_company.php");
    } else{
        echo "<script>alert('Database Error Could not able to execute')</script>";
    }
}
    if(isset($_GET['delete'])){
    $id = trim($_GET['delete']);
    $sql = "DELETE FROM enrolled_students
            WHERE drive_id IN 
            (
              SELECT drive_id
              FROM drive
              WHERE company_id = '$id'
            )";
    if(mysqli_query($con, $sql)) {
        $result = "DELETE FROM drive WHERE company_id = '$id'";
        if(mysqli_query($con, $result)) {
            $result = "DELETE FROM company WHERE company_id = '$id'";
            if(mysqli_query($con, $result)) {
                echo "<script>alert('Company Deleted Successfully')</script>";
                header("Location: add_company.php");
            }else{
                echo "<script>alert('Database Error Could not able to execute')</script>";
            }
        }else{
            echo "<script>alert('Database Error Could not able to execute')</script>";
        }
    } else{
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
                <li class="active"><a href="add_company.php ">Add Company</a></li>
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
        <h4>Company Detail</h4>
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
        </style>
        <form method="post" action="add_company.php" id="add_drive_form">
            <table border="3px" width="100%">
                <tr>
                    <th>Name</th>
                    <td><input type="text" name="name" required></td>
                </tr>
                <tr>
                    <th>Branch</th>
                    <td><input type="text" name="branch" required></td>
                </tr>
                <tr>
                    <th>URL</th>
                    <td><input type="text" name="url" required></td>
                </tr>
            </table>
            <br><br><center><a href="edit_profile.php"><input type="submit" value="Save" class="btn-info"></a>
                </center></a><br>
        </form>
    </div>
    <div class="col-md-1"></div>
    <div class="clearfix"></div>
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <h3>Companies:</h3>
            <?php
                $sql = "SELECT * FROM company ORDER BY company_id DESC ";
                $result = mysqli_query($con, $sql);
                while($row = mysqli_fetch_assoc($result)){
                    $id = $row['company_id'];
                    $name = $row['company_name'];
                    $branch = $row['company_branch'];
                    $url = $row['company_url'];
                   echo '
                            <div class="editor-pics">
                                <div class="col-md-10 item-details" style="border: #14bcd5 solid 1px; padding: 10px">
                                    <h3 class="inner two"><a href="view_company.php?id='.$id.'">'.$name.'</a>
                                    &nbsp&nbsp&nbsp<a href="add_company.php?delete='.$id.'"><i class="glyphicon glyphicon-trash"></a></i>
                                    </h3>
                                    <p>&nbspBranch: '.$branch.'</p>
                                    <div class="td-post-date two">URL: '.$url.'</div>
                                </div>
                            </div>
                        ';
                }
            ?>
    </div>
    <div class="col-md-1"></div>
    <div class="clearfix"></div>
</div>
<!-- //main -->
<div class="clearfix"> </div>
