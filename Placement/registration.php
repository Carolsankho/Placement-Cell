<?php
include "includes/header.php";
if(isset($_SESSION['admin'])){
    header("Location: dashboard.php");
}
if(isset($_SESSION['name'])&&isset($_SESSION['email']))
    header("Location: home.php");

$set_value = 0;
$error = '0';
    if(isset($_REQUEST['name'])&&isset($_REQUEST['email'])&&isset($_REQUEST['pass'])){
        $name = trim($_REQUEST['name']);
        $email = trim($_REQUEST['email']);
        $pass = md5(trim($_REQUEST['pass']));
        $result = "INSERT INTO users (user_name,user_email,user_pass) values('$name','$email','$pass')";
        if(mysqli_query($con, $result)){
            $sql = "SELECT *
               FROM users
               WHERE user_email='$email'
               AND user_pass='$pass'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($result);
            $id = $row['user_id'];
            $sql = "INSERT INTO profile (uid) values($id)";
            $result = mysqli_query($con, $sql);
            header("Location: login.php");
        } else{
            $set_value = 1;
            $error = "Database Error Could not able to execute". $result." ".mysqli_error($con);
        }
    }
?>
    <div class="col-md-9 main" style="width: 80%; padding-right: 20px">
        <!-- register -->
        <div class="sign-up-form">
            <h3 class="tittle" id = "signup">Registration <i class="glyphicon glyphicon-file"></i></h3>
            <p id = "signup_instructions">Having hands on experience in creating innovative designs,I do offer design
                solutions which harness</p>
            <?php
                if($set_value==1){
                    echo '<div id="error" style="display: block;">
                    <div class="alert alert-danger" role="alert"">
                    <i class="glyphicon glyphicon-lock"></i>
                    <strong>Error! : </strong> <span id="error_message">'.$error.'</span>
                    </div>';
                }
            ?>

        </div>
        <div id ="form-area" style="display: block">
            <form  id = "form" action="registration.php" method="post">
                <div class="sign-up">
                    <h3 class="tittle reg">Personal Information <i class="glyphicon glyphicon-user"></i></h3>
                    <div class="sign-u">

                        <div class="sign-up1">
                            <h4 class="a">Full Name* :</h4>
                        </div>

                        <div class="sign-up2">
                                <input type="text" name="name" id="name" class="text" value="" placeholder="Full Name">
                    </div>

                        <div class="clearfix"> </div>

                    </div>

                    <div class="sign-u">

                        <div class="sign-up1">
                            <h4 class="c">Email Address* :</h4>
                        </div>

                        <div class="sign-up2">
                                <input type="text" name="email" class="text" id="input-email" value="" placeholder="Email Address">
                        </div>

                        <div class="clearfix"> </div>

                    </div>

                    <h3 class="tittle reg">Login Information <i class="glyphicon glyphicon-off"></i></h3>
                    <div class="sign-u">

                        <div class="sign-up1">
                            <h4 class="d">Password* :</h4>
                        </div>

                        <div class="sign-up2">
                                <input type="password" name="pass" id="input-pass" class="Password" value="" onkeyup="var passstr = $('#confirm-pass').val(); if (this.value != passstr){$('#error_password_message').text('Password must be match'); $('#error_password_message').css('display','block');} else{$('#error_password_message').css('display','none');}" placeholder="Create Password" required>
                        </div>

                        <div class="clearfix"> </div>

                    </div>

                    <div class="sign-u">

                        <div class="sign-up1">
                            <h4>Confirm Password* :</h4>
                        </div>

                        <div class="sign-up2">
                            <input type="password" id="confirm-pass" class="Password" value="" onkeyup="var passstr = $('#input-pass').val(); if (this.value != passstr){$('#error_password_message').text('Password must be match'); $('#error_password_message').css('display','block');} else {$('#error_password_message').css('display','none');}" placeholder="Confirm Password" required>
                        </div>

                        <div class="clearfix"> </div>

                        <div class="sign-up2">
                            <div id="error" style="display: block">
                                <span id="error_password_message" style="color: #c9302c; display: none;">Password does not match</span>
                            </div>
                        </div>

                        <div class="clearfix"> </div>

                    </div>

                        <input type="submit" value="Submit" id="input-submit" style="display: block">
                        <button type="submit"  id="button-submit" disabled style="display: none">
                            <img src= "images/ajaxload.gif" style="height: auto; width: 20px"> Signing up
                        </button>

                    <h4><a href="login.php">Already have an account?</a></h4>
                </div>
            </form>
        </div>
    </div>
        <!-- //register -->
        <!-- //login-page -->
    <div class="clearfix"> </div>
<?php
include "includes/footer.php";
?>