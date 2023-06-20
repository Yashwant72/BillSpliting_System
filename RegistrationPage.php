<?php
session_start();
require 'connection.php';
//die("test") ;
//print_r($_SESSION);
if (isset($_SESSION['isLoggedInAdmin']) && $_SESSION['isLoggedInAdmin'] == 1) {
    $heading = "Member  Details";
    if (isset($_SESSION['isLoggedInAdmin']) && $_SESSION['isLoggedInAdmin'] == 1) {
        $member_id = $_SESSION['member_id'];
        $name = $_SESSION['name'];
        $mesg = "Details of " . $name . ".";
        $sql_member_details = "SELECT * FROM members WHERE member_id='$member_id'";
    }
    $button_value = "UPDATE";
    $button_name = "update";

    //echo $sql_patient_details;
    $result = mysqli_query($con, $sql_member_details);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        //$patient_id=$row['patient_id'];
        $email = $row['email'];
        $name = $row['name'];
        $date_of_birth = $row['date_of_birth'];
        $mobile_number = $row['mobile_number'];
        $group_name = $row['group_name'];
        $gender = $row['gender'];
        $mesg = "Details of " . $name . ".";
    }
} else {
    $heading = "Registration Form";
    $mesg = "";
    $button_value = "REGISTER";
    $button_name = "register";
    $email = "";
    $name = "";
    $gender = "";
    $date_of_birth = "";
    $mobile_number = "";
    $group_name = "";
}

if (isset($_POST['register']) && $_POST['register'] == "REGISTER") {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $date_of_birth = "2000-08-02";
    $mobile_number = $_POST['mobile_number'];
    $password = $_POST['password'];
    $gender = "male";
    $group_name = $_POST['group_name'];

    $sql_insert_member = "INSERT INTO members(name,email,gender,date_of_birth,group_name,password,mobile_number) VALUES('$name','$email','$gender','$date_of_birth','$group_name','$password','$mobile_number')";
    echo $sql_insert_member;
    if (mysqli_query($con, $sql_insert_member) === true) {
        echo "<script>alert('Member Record inserted successfully.')</script>";
        echo "<meta http-equiv='refresh' content='0;URL=RegistrationPage.php'>";
    } else {
        echo "<script>alert('ERROR!!. Member Record not inserted successfully.')</script>";
        echo "<meta http-equiv='refresh' content='0;URL=RegistrationPage.php'>";
    }
}


if (isset($_POST['delete']) && $_POST['delete'] == "DELETE") {
    $email = $_POST['email'];
    $sql_delete_member = "DELETE FROM members WHERE email='$email'";
    if (mysqli_query($con, $sql_delete_member)) {
        echo "<script>alert('Member Record deleted successfully.')</script>";
        echo "<meta http-equiv='refresh' content='0;URL=adminLoginPage.php'>";
    } else {
        echo "<script>alert('ERROR!!. Member Record not deleted successfully.')</script>";
        echo "<meta http-equiv='refresh' content='0;URL=adminLoginPage.php'>";
    }
}


if (isset($_POST['update']) && $_POST['update'] == "UPDATE") {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $date_of_birth = $_POST['date_of_birth'];
    $mobile_number = $_POST['mobile_number'];
    $group_name = $_POST['group_name'];
    $gender = $_POST['gender'];

    $sql_member_update = "UPDATE members SET name='$name',email='$email',gender='$gender',date_of_birth='$date_of_birth',group_name='$group_name',mobile_number=$mobile_number WHERE member_id=$member_id ";
    echo $sql_member_update;
    if (mysqli_query($con, $sql_member_update)) {
        echo "<script>alert('Member Record updated successfully.')</script>";
        echo "<meta http-equiv='refresh' content='0;URL=RegistrationPage.php'>";
    } else {
        echo "<script>alert('Member Record not updated successfully.')</script>";
        echo "<meta http-equiv='refresh' content='0;URL=RegistrationPage.php'>";
    }
}


?>

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Popup Login Form Design | CodingNepal</title>
    <link rel="stylesheet" href="regPageF.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
    <div class="center">
        <input type="checkbox" id="show">
        <label for="show" class="show-btn">View Form</label>
        <div class="container">
            <label for="show" class="close-btn fas fa-times" title="close"></label>
            <div class="text">
                <?php echo $heading ?>
            </div>
            <div class="text">
                <?php echo $mesg ?>
            </div>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" autocomplete="on">
                <div class="data">
                    <label>Name</label>
                    <input type="text" name="name" value="<?php echo $name ?>" required>
                </div>
                <div class="data">
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo $email ?>" required>
                </div>
                <div class="data">
                    <label>Mobile</label>
                    <input type="text" name="mobile_number" value="<?php echo $mobile_number ?>" required>
                </div>
                <div class="data">
                    <label>Group Name</label>
                    <input type="text" name="group_name" value="<?php echo $group_name ?>" required>
                </div>
                <?php
                if (!(isset($_SESSION['isLoggedInAdmin']) && $_SESSION['isLoggedInAdmin'] == 1)) {
                ?>
                    <div class="data">
                        <label>Password</label>
                        <input type="password" name="password" required>
                    </div>
                    <div class="data">
                        <label>Confirm Password</label>
                        <input type="password" name="confirmPassword" required>
                    </div>
                <?php
                }
                ?>
                <div class="btn">
                    <div class="inner"></div>
                    <button type="submit" name="<?php echo $button_name ?>" value="<?php echo $button_value ?>">Login</button>
                </div>
                <?php
                if (isset($_SESSION['isLoggedInAdmin']) && $_SESSION['isLoggedInAdmin'] == 1) {
                ?>
                    <div class="btn">
                    <div class="inner"></div>
                    <button type="submit" name = "delete" value = "DELETE">Delete</button>
                </div>
                    
                <?php
                }
                ?>
                <div class="signup-link">
                        <a href="index.html">Back</a>
                    </div>
            </form>
        </div>
    </div>
</body>

</html>